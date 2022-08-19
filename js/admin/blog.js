/*
 *
    Document   : download admin
    Created on : 02/01/2011, 16:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*
*/
var i = 2;

$(document).ready(function() {

   
    $("#bt_submit").click(function() {

        submitForm();

    });

    $('#bt_clear').click(function() {

        clearForm();

    });
    

});

/*
 * It sends the values by POST
 *
 */
function submitForm()
{

    var title = $('#title').val();
    var materia = $('#materia').val();

    $.post("cadastrar", {
        
        title: title,
        materia: materia
             
    },

    function(data){
        
        showAlertDim(data);
        clearForm();

    });
}

/*
 * It clears the textfield related
 *
 */
function clearForm()
{

    $('#title').val("");
    $('#materia').val("");

}
