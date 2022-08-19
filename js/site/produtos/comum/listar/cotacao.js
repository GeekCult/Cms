/*
    Document   : fechamento
    Created on : 20/10/2010, 09:31:00
    Author     : CarlosGarcia
    Description: Js view store_lines
    Purpose of the javascript follows.
*/

var isAmountPressed = false;

$(document).ready(function() {
    initCloseCotacao();
});

function initCloseCotacao(){
    
    $("#bt_goto_step_2").click(function(){
        $("#step_1").hide(); $("#step_2").show();
    });
    
    $("#bt_goto_step_1").click(function(){
        $("#step_2").hide(); $("#step_1").show();
    });
    
    //Botão da tela avisos, chama a view add pedido
    $(".bt_remove_item_fechamento").click(function(){         
        removeItem(this.id);
    });
    
    // Atualiza a quantidade de produtos no fechamento do pagamento
    $(".bt_amount_produtos").click(function(){
        
        var id = this.id.split("_");
        var tipo = this.value;
        var id_pedido = $("#helper_id_pedido").val();     
        
        if(!isAmountPressed){
            isAmountPressed = true;
            $.post("/loja/update_amount",{
                id_pedido: id_pedido,
                tipo: tipo,
                id: id[1]
            },function(data){               
                //It transforms the returned json array in an object
                var jsonObject = eval('(' + data + ')'); 
                $("#amount_item_"+ id[1]).val(jsonObject['amount']);
                $("#valor_total_"+ id[1]).text(jsonObject['valor']);
                $(".total_price_items").text(jsonObject['total']);
                // Update shopping cart
                $("#amount_shopping_cart").empty().text(jsonObject['amount_total']);
                $("#amount_shopping_cart_complete").empty().text(jsonObject['amount_total'][0]['SUM(amount)']+" items(s) - "+ jsonObject['total']);
                isAmountPressed = false;
            });
        }       
    });
    
    // Atualiza a quantidade de produtos no fechamento do pagamento
    $(".field_qtd").change(function(){
        
        var id = $(this).attr('data-id');
        var id_pedido = $("#helper_id_pedido").val();
        var id_estoque = $(this).attr('data-id-estoque');
        var qtd = $(this).val();          
        
        $.post("/loja/estoque_qtd",{id: id_estoque, qtd: qtd}, function(data){
        
            var jsonObject = eval('(' + data + ')');
            
            if(jsonObject['qtd'] > qtd){
                if(!isAmountPressed){
                    isAmountPressed = true;
                    $.post("/loja/update_amount2",{
                        id_pedido: id_pedido,
                        id: id
                    },function(data){               
                        //It transforms the returned json array in an object
                        var jsonObject = eval('(' + data + ')'); 
                        $("#amount_item_"+ id).val(jsonObject['amount']);
                        $("#valor_total_"+ id).text(jsonObject['valor']);
                        $(".total_price_items").text(jsonObject['total']);
                        // Update shopping cart
                        $("#amount_shopping_cart").empty().text(jsonObject['amount_total']);
                        $("#amount_shopping_cart_complete").empty().text(jsonObject['amount_total'][0]['SUM(amount)']+" items(s) - "+ jsonObject['total']);
                        isAmountPressed = false;
                    });
                }               
            }else{
                $("#mdIfoR").text("Só possuímos: " + jsonObject['qtd'] + " item(s) em estoque");
                $('#modal_message_result').modal('show');
                
                //showPopUp("toast", "Só possuímos: " + jsonObject['qtd'] + " item(s) em estoque", 'message_simple', 400, 30, false);
                $("#amount_item_" + id).val(jsonObject['qtd']);
            }
           
        });        
    });
    
    //Send Cotação
    $("#bt_enviar_consulta").click(function(){
        var email = $("#email_sob_consulta").val(); 
        var nome = $("#nome_sob_consulta").val();
        var telefone = $("#telefone_sob_consulta").val(); 
        var cidade = $("#cidade_sob_consulta").val();
        var uf = $("#uf_sob_consulta").val();
        var cnpj = $("#cnpj_sob_consulta").val();
        var empresa = $("#empresa_sob_consulta").val();
        
        $("#output_sob_consulta").empty().append("<div class='bg-info mgB'>Enviando...</div>");
        if(email != '' && nome != '' && telefone != '' && cidade != '' && uf != '' && cnpj != '' && empresa != ''){
           $.post("/submit/sob_consulta",{
                email: email,
                data: $("#formSobConsulta").serialize()
            },function(data){$("#output_sob_consulta").empty().append("<div class='bg-success mgB'>Cotação enviado com sucesso!</div>");}); 
        }else{
            $("#output_sob_consulta").empty().append("<div class='bg-danger mgB'>Todos os campos devem ser preenchidos</div>");
        }
    });
}


/* 
 * Remove shopping cart item
 * 
 */
function removeItem(id){
    //Id name = item_xx para evitar problemas com ids inteiros
    var id_array = id.split("_");
    var id_item = id_array[1];

    $.post("/loja/remove_item",{
        id_item: id_item,
        tipo: "produto"
    },function(data){
        var jsonObject = eval('(' + data + ')');        
        $("#container_produto_" + id_item).fadeOut("fast");
        $("#total_price_items").empty().text(jsonObject['total_format']); 
        if(typeof _gaq !== 'undefined' ) _gaq.push(['_trackPageview', '/site/pagamento/item_removido_do_carrinho']);
        if(typeof dataLayer !== 'undefined' ) dataLayer.push({'event':'sendVirtualPageview','vpv': '/site/pagamento/item_removido_do_carrinho'});
    });
}