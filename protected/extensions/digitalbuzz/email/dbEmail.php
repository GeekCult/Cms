<?php

/*
 * This Class is used to send an (simple) email based on a text or html template
 * @author Mauro Marchiori Neto
 *
 * Usage Notes
 *
 * $email = new dbEmail();
 *
 * $email->header(html ou text);  //defaults to text
 * $email->recipient(email);
 * $email->subject(subject);
 * $email->loadTemplate(template location);
 * $email->replace(var name, valor);
 * $email->send();

 */

class dbEmail {

    var $headers = "";
    var $email = "";
    var $message = "";
    var $subject = "";
    var $from = "";
    var $from_name = "";
    var $return_path = "";
    var $layout_folder = "protected/views/templates/layout/";
    var $content_folder = "protected/views/templates/";

    // Generate a boundary string
    var $separator = "";


    /*
     * This static Method is used to send a simple html formatted email, with mail_tpl as template and the predefined from-address.
     * For more advanced emails with attachments, other template, or other from address, use the functions in this file one by one instead.
     *
     * Example:
     * dbEmail::sendSimpleEmail($adminuser->email, "Nova conta criada", "adminuser_created", array(array("username", $adminuser->email),
     *                                                                                             array("password", $pw)));
     *
     * $to => recipient
     * $subject => subject of email
     * $contentfile => the content of the email that will be sent. The header/footer template that will be used is always mail_tpl
     * $replaceArray => array with arrays to replace keywords in content.
     */
    public static function sendSimpleEmail($to, $subject, $contentfile, $replaceArray){

        $email = new dbEmail();

        $email->header("html");
        $email->recipient($to);
        $email->subject($subject);

        $email->loadLayout("mail_tpl");
        $email->setContent($contentfile);

        foreach($replaceArray as $replace){
            $email->replace($replace[0], $replace[1]);
        }

        $email->send();
    }


    /*
     * With this method the returnpath can be altered
     */
    //NOTE!! it needs to be called before the header function to be set correctly!!
    public function setReturnPath($returnPath){
        $this->return_path = $returnPath;
    }

    /*
     * With this method the from can be altered
     */
    //NOTE!! it needs to be called before the header function to be set correctly!!
    public function setFrom($fromemail, $user){
        $this->from = $fromemail;
        $this->from_name = $user;
    }



    /*
     * This Method is used to define the header type, currently it only supports text/html emails
     */
    public function header($type = "plain", $filename = false, $folder = 'pdf') {
        
        $this->headers = "From: " . $this->from_name . " <" . $this->from . ">" . "\n"; // remetente
        $this->headers .= "Return-Path: " . $this->return_path . "\n"; // return-path
        //$this->headers .= "Bcc: contato@purplepier.com.br"; // bcc
        $this->headers .= "MIME-Version: 1.0\n";
        $this->headers .= "Reply-to: $this->from\n"; 

        if($type == "mixed"){
            
            $path = "media/user/{$folder}/";
            $fileatt = $path . $filename;

            // handles mime type for better receiving
            $ext = strrchr( $fileatt , '.');
            $ftype = "";
            if ($ext == ".doc") $ftype = "application/msword";
            if ($ext == ".jpg") $ftype = "image/jpeg";
            if ($ext == ".gif") $ftype = "image/gif";
            if ($ext == ".zip") $ftype = "application/zip";
            if ($ext == ".pdf") $ftype = "application/pdf";
            if ($ftype=="") $ftype = "application/octet-stream";

            // read file into $data var
            $file = fopen($fileatt, "rb");
            $data = fread($file,  filesize( $fileatt ) );
            fclose($file);

            // split the file into chunks for attaching
            $content = chunk_split(base64_encode($data));
            $uid = md5(uniqid(time()));

            // build the headers for attachment and html

            $this->headers .= "MIME-Version: 1.0\r\n";
            $this->headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            //$this->headers .= "Content-Type: multipart/alternative; boundary='outer-boundary'\r\n\r\n";
            $this->headers .= "This is a multi-part message in MIME format.\r\n";
            $this->headers .= "--".$uid."\r\n";
            $this->headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
            $this->headers .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $this->headers .= $this->message."\r\n\r\n";
            $this->headers .= "--".$uid."\r\n";
            $this->headers .= "Content-Type: ".$ftype."; name=\"".basename($fileatt)."\"\r\n";
            $this->headers .= "Content-Transfer-Encoding: base64\r\n";
            $this->headers .= "Content-Disposition: attachment; filename=\"".basename($fileatt)."\"\r\n\r\n";
            $this->headers .= $content."\r\n\r\n";
            $this->headers .= "--".$uid."--";

        }else{

            $this->headers .= "Content-type: text/" . $type . "; charset=utf-8\n";
        }
      
    }

    /*
     * this methods sets the recipient email
     */

    public function recipient($email) {
        $this->email = $email;
    }

    /*
     * this methods sets the recipient email
     */

    public function subject($subject) {
        $this->subject = $subject;
    }

    /*
     * this method loads the layout on the $layout_folder folder, you only need to provide the layout name
     */

    public function loadLayout($layout) {
        $this->message = file_get_contents($this->layout_folder . $layout . ".html");
    }

    /*
     * this method replaces the {content} string in the layout message,
     * with the whole content of a file in the $content_folder folder.
     * You only need to provide the file name.
     * Ex:
     * ...
     *  $email->loadLayout("mail_tpl");
     * 	$email->setContent("cupom");
     * ...
     */
    public function setContent($content) {
        
        if($content == '') $content == 'content_general';        
        
        $contentFile = $this->content_folder . $content . ".html";
        $fileHandle = fopen($contentFile, 'r');
        $theData = fread($fileHandle, filesize($contentFile));
        fclose($fileHandle);
        $this->message = str_replace("{content}", $theData, $this->message);
    }
    
    /*
     * this method replaces the {content} string in the layout message,
     * with the whole content of a file in the $content_folder folder.
     * You only need to provide the file name.
     * Ex:
     * ...
     *  $email->loadLayout("mail_tpl");
     * 	$email->setContent("cupom");
     * ...
     */
    public function setRenderPartial($data) {
        
        $this->message = $data['view'];
    }

    /*
     * this method replaces values on the template message.
     */
    public function replace($var_name, $value) {
        $this->message = str_replace("{" . $var_name . "}", $value, $this->message);
    }

    /*
     * method that sends the email
     */
    public function send() {
        
        try{
            if(Yii::app()->params['hostname'] == 'Rackspace'){

                require_once "Mail.php";
                require_once "Mail/mime.php";
                
                $from = "Acic <noreply@acic.bz>";

                $host = "smtp.emailsrvr.com";
                $username = "noreply@acic.bz";
                $password = "rscAC1C2cam3";
                $crlf = "\n";

                // create a new Mail_Mime for use
                $mime = new Mail_mime($crlf); 
                $mime->setHTMLBody($this->message);

                $headers = array ('From' => $from,
                  'To' => $this->email,
                  'Subject' => $this->subject);

                $smtp = Mail::factory('smtp',
                array ('host' => "mail.emailsrvr.com",
                    'auth' => true,
                    'username' => 'noreply@acic.bz',
                    'password' => 'rscAC1C2cam3'));
                
                $mimeparams['text_encoding']="8bit";
                $mimeparams['text_charset']="UTF-8";
                $mimeparams['html_charset']="UTF-8";
                $mimeparams['head_charset']="UTF-8";
                
                $body = $mime->get($mimeparams);
                $headers = $mime->headers($headers); 
                
                $mail = $smtp->send($this->email, $headers, $body);
 
                if(PEAR::isError($mail)) {
                  return $mail->getMessage();
                  
                }else{
                  return true;
                 
                }

            }else{
                
                if(Yii::app()->params['revenda'] == 'Plesk11.5'){
                    //return mail($this->email, $this->subject, strip_tags($this->message), str_replace("\r\n","\n",$this->headers), "-r". $this->from);
                    return mail($this->email, $this->subject, $this->message, $this->headers, "-r". $this->from);
                }else{
                    return mail($this->email, $this->subject, $this->message, $this->headers);
                }
              
            }
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: dbEmail - send() " . $e->getMessage();
        }
    }
    
    /*
     * method that sends the email via Plesk 8
     */
    public function sendPlesk8(){
        
        try{ 
            return mail($this->email, $this->subject, strip_tags($this->message), str_replace("\r\n","\n",$this->headers));             
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: dbEmail - send() " . $e->getMessage();
        }
    }
    
    /*
     * method that shows the email
     */
    public function mostrar() {
        echo $this->message;
    }

}

?>
