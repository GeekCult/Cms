<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="margin: 0;padding: 0; font-family: Helvetica Neue, Helvetica, Verdana, Arial, sans-serif!important;">
    <head style="margin: 0;padding: 0;font-family: Helvetica, Verdana, Arial, sans-serif!important;">
        <!-- If you delete this tag, the sky will fall on your head -->
        <meta name="viewport" content="width=device-width" style="margin: 0;padding: 0;">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" style="margin: 0;padding: 0;">
        <title style="margin: 0;padding: 0;">PurplePier</title>

        <style type="text/css" style="margin: 0;padding: 0;font-family:Helvetica, Helvetica, Verdana, Arial, sans-serif;">

            /* ------------------------------------------- 
                            PHONE
                            For clients that support media queries.
                            Nothing fancy. 
            -------------------------------------------- */
            @media only screen and (max-width: 600px) {

                a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}

                div[class="column"] { width: auto!important; float:none!important;}

                table.social div[class="column"] {
                    width:auto!important;
                }

            }
        </style>

    </head>
    <body style="margin: 0;padding: 0;font-family: Helvetica, Verdana, Arial, sans-serif!important;-webkit-font-smoothing: antialiased;-webkit-text-size-adjust: none;height: 100%;width: 100%!important;<?php //if($properties['background'] != "" || $properties['background_type'] == 2) if($properties['background_type'] == 0){echo "background: url({$properties['server']}/media/user/images/original/{$properties['background']})";}else if($properties['background_type'] == 2){echo "background: url(http://www.purplepier.com.br/media/images/textures/efeitos/{$properties['background']}); background-color: #{$properties['background_color']}";}else{echo "background: url(http://www.purplepier.com.br/media/images/textures/site/{$properties['background']})";} ?>">

        <!-- BODY -->
        <table class="footer-wrap" style="margin: 0;padding: 0;width: 100%;clear: both!important;">
            <tr style="margin: 0;padding: 0;">
                <td style="margin: 0;padding: 0;"></td>
                <td class="container" style="margin: 0 auto!important;padding: 0;display: block!important;clear: both!important; " align="center">

                    <!-- content -->
                    <div class="content" style="margin: 0 auto!important;display: block; width: 600px!important;">
                        <table width='100%' border='0' align='center' cellpadding='8' cellspacing='0'>
                            <tr>
                                <td background="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/media/images/textures/topo_email/" . $layout_template['textura_topo_email'] ?>" style="background-repeat: no-repeat;">
                                    <div>
                                        <img src="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/media/user/images/original/" . $logo ?>" height="50" alt="logo" />
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table width='100%' border='0' align='center' cellpadding='2' cellspacing='4' style="border: 1px solid #e9e9e9">
                            <tr>
                                <td><br/><br/></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="margin-left: 10px;"><b>Olá</b> <?php echo $nome ?>,</div>
                                </td>
                            </tr>                            
                            <tr>
                                <td>
                                    <div style="margin-left: 10px;"><p>Sua consulta de preço foi recebida com sucesso.</p></div>                                    
                                </td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="margin-left: 10px;"><p>Aguarde que logo entraremos em contato.</p></div>
                                </td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="margin-left: 10px;"><h4>Os produtos que você cotou estão listados abaixo</h4></div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table style="width:100%; border: 1px solid #999; padding: 10px">
                                        <tr style="background: #333">
                                            <td style="width: 40px; color: #fff; font-weight: bold; padding: 10px; text-align: center">Image</td>
                                            <td style="width: 40px; color: #fff; font-weight: bold; padding: 10px; text-align: center">Qtd</td>
                                            <td style="width: 480px; color: #fff; font-weight: bold; padding: 10px">Título</td>                                            
                                        </tr>
                                        <?php if($content){ foreach ($content as $values){ ?>                                        
                                        <tr style="background: #f9f9f9">
                                            <td style="width: 40px; color: #333; padding: 10px; text-align: center"><img src="<?php if(isset($values['product']['image_0'])) echo "http://" . $_SERVER['SERVER_NAME'] . "/media/user/images/thumbs_120/" . $values['product']['image_0'] ?>" alt="<?php echo nl2br($values['nome']) ?>" height="30"/></td>
                                            <td style="width: 40px; color: #333; padding: 10px; text-align: center"><?php echo $values['amount'] ?></td>
                                            <td style="width: 480px; color: #333; padding: 10px"><?php echo nl2br($values['nome']) ?></td>                                           
                                        </tr> 
                                        <?php } } ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td><div style="margin-left: 10px;"><b>Atenciosamente</b></div></td>
                            </tr>
                            <tr>
                                <td><div style="margin-left: 10px; font-size: 0.8em"><?php echo $dados['email_title'] ?></div></td>
                            </tr>
                            <tr>
                                <td><br/></td>
                            </tr>
                            <tr>
                                <td></br></td>
                            </tr>                             
                                                                      
                            <tr>
                                <td></br></td>
                            </tr>
                            <tr>
                                <td></br></td>
                            </tr>
                            
                        </table>
                        <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
                            <tr>
                                <td>
                                    <div>
                                        <img src="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/media/images/textures/rodape_email/" . $layout_template['textura_rodape_email'] ?>" alt="rodape" />
                                    </div>
                                </td>
                            </tr>                                                    
                        </table>
                    </div><!-- /content -->

                </td>
                <td style="margin: 0;padding: 0;"></td>
            </tr>
        </table>
        <!-- /BODY -->


    </body>
</html>

