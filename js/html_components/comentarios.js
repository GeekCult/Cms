/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){            
        initListenersSubmitButtons();
        initListenerLikeButtons();
    }
);

/*
 * It applies the main listeners for like, unlike e repley
 * It's used into all general_contents
 * 
 * PS: It's called from a request javascript inside the comment
 * item view
 *
 */
function initListenerLikeButtons(){

      $(".container_comment :button, .container_buttons_reviews :button, .container_buttons_reviews2 :button").on('click', function(){ 

          switch(this.className){
            case "bt_like":
                reviewForm(this.className, this.id, this.alt);
                break;

            case "bt_unlike":
                reviewForm(this.className, this.id, this.alt);
                break;

            default:                    
                replyForm(this.id);
                break;
            }                
      }); 
      
      
      //loadComments($("#id_general").val(), $("#id_general").attr('rel'));
}

/*
 * It shows the fieldset to submit a reply.
 *
 * @param number id
 *
 */
function replyForm(id){
    $("#reply" + id).animate({height: "toggle", opacity: "toggle"});        
}

/*
 * Launches the comment form
 * Initialises listeners for the comment form
 *  
 * @param number
 * 
 */
function loadComments(id, tipo){

    $("#loaderComment").hide();
    $.post("/site/comentarios/carregar_comentarios", {                 
            id: id,
            tipo: tipo
    },function(data){                    
        $("#loaderComment").append(data);
        setTimeout("showLoaderLoaded()",500);                
    });
}

/*
 * Just shows the loader comment after few minutes.
 */
function showLoaderLoaded(){
    $("#loaderComment").fadeIn("slow");
}

/*
 * Launches the comment form
 * Initialises listeners for the comment form
 *  
 * @param number
 * 
 */
function loadCommentsMultiple(id, tipo){

    $("#loaderComment_"+id).hide();
    $.post("/site/comentarios/carregar_comentarios", {                 
            id: id,
            tipo: tipo
    },function(data){                    
        $("#loaderComment_"+id).append(data);
        setTimeout("showLoaderLoadedMultiple("+id+")",500);                
    });
}

/*
 * Just shows the loader comment after few minutes.
 */
function showLoaderLoadedMultiple(id){
    $("#loaderComment_"+id).fadeIn("slow");
}

/*
 * Launches the review
 * It gets the bt pressed and updates the value
 * related.
 *  
 * @param string
 * 
 */
function reviewForm(tipo, id, action){
    
    $("#bt_review_"+id).css("display", 'none');
    
    $.post("/site/comentarios/" + action,{
            id: id,
            tipo: tipo,
            local: action
        },function(data){ 

           var jsonObject = eval('(' + data + ')');

           if(jsonObject['tipo'] == 'bt_like'){ 
               $("#phrase_like"+jsonObject['id']).text(jsonObject['phrase']);
               $("#phrase_like"+jsonObject['id']).css("display", "block");
           };

           if(jsonObject['tipo'] == 'bt_unlike'){
               $("#phrase_unlike"+jsonObject['id']).text(jsonObject['phrase']);
               $("#phrase_unlike"+jsonObject['id']).css("display", "block");
           } 
           
    });
}

/*
 *
 * Launches the comment form
 * Initialises listeners for the comment form
 *
 *
 */
function initListenersSubmitButtons(){

    $('.submit_comment').click(function(){
        
        var comment_name = $(".comment_name" + this.id).val();
        var comment_email = $(".comment_email" + this.id).val();
        var comment_message = $(".comment_message" + this.id).val();
        var comment_checkbox = $("input[name='no_email']:checked").val();
        var id_general = this.id;
        var tipo = $("#helper_tipo").val();
         
        $('#output_contact').empty().append("<p class='output_message bg-info'>Enviando...</p>");
         
        if(comment_message != ''){
            $.post("/site/comentarios/cadastrar",{
             
                id_general: id_general,
                title: comment_name,
                nome: comment_name,
                email: comment_email,
                comentario: comment_message,
                checkbox: comment_checkbox,
                tipo: tipo

            },function(data){
                var jsonObject = eval('(' + data + ')');
                if(jsonObject['result'] == 1){
                    $('#output_contact').empty().append("<p class='output_message bg-success'><span>" + jsonObject['MESSAGE'] + "</span></p>");
                }else{
                    $('#output_contact').empty().append("<p class='output_message bg-danger'><span>" + jsonObject['MESSAGE'] + "</span></p>");
                }

            });
        }

    });   
    
    $('#submit_comment').click(function(){

        var comment_name = $(".comment_name").val();
        var comment_email = $(".comment_email").val();
        var comment_message = $(".comment_message").val();
        var comment_checkbox = $("input[name='no_email']:checked").val();
        var id_general = $("#id_general").val();
        var tipo = $("#helper_tipo").val();
         
        $('#output_contact').empty().append("<p class='output_message bg-info'>Enviando...</p>");

        $.post("/site/comentarios/cadastrar",{

            id_general: id_general,
            title: comment_name,
            nome: comment_name,
            email: comment_email,
            comentario: comment_message,
            checkbox: comment_checkbox,
            tipo: tipo

        },function(data){
            var jsonObject = eval('(' + data + ')');
            if(jsonObject['result'] == 1){
                $('#output_contact').empty().append("<p class='output_message bg-success'><span>" + jsonObject['MESSAGE'] + "</span></p>");
            }else{
                $('#output_contact').empty().append("<p class='output_message bg-danger'><span>" + jsonObject['MESSAGE'] + "</span></p>");
            }
        });

    });

    /*
     * Submit Reply default
     * 
     *
     */
    $('.submit_reply').on("click", function(){

        var comment_name = $(".comment_name" + this.id).val();
        var comment_email = $(".comment_email" + this.id).val();
        var comment_message = $(".comment_message" + this.id).val();
        var reply_to = $("#helper_comment" + this.id).text();
        var id_general = $("#id_general").val();
        var id_comment = this.id;
        var tipo = $("#helper_tipo_reply").val();      

        $("#item_comment_reply_" + this.id).animate({height: "hide"}, "slow");

        $.post("/site/comentarios/cadastrar_reply",{

            id_general: id_general,
            nome: comment_name,
            email: comment_email,
            comentario: comment_message,
            id_comment: id_comment,
            reply_to: reply_to,
            tipo: tipo,
            tipo_comentario: tipo

        },function(data){
            var jsonObject = eval('(' + data + ')');
            
        });
    });            
}