/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

    $(".md_artigo_charlotte" ).each(function( index ) {
        //console.log( index + ": " + $( this ).attr('data-id') );
        showAnimationArtigoCharlotte($( this ).attr('data-id'));
    });
    
    $('#bt_test_show').on('click', function(){        
        showAnimationArtigoCharlotte($(this).attr('data-id'));
    });
    $('#bt_test_hide').on('click', function(){        
        hideAnimationArtigoCharlotte($(this).attr('data-id'));
    });
});

function showAnimationArtigoCharlotte(id){
    $("#artigo_charlotte_" + id + " .bgArtCh").removeClass('animeDecreaseWidth').addClass('animeIncreaseWidth');
    $("#artigo_charlotte_" + id + " .textoCh, #artigo_charlotte_" + id + " .bgArtCh, #artigo_charlotte_" + id + " .bgArtC.textoCh, #artigo_charlotte_" + id + " .bgArtCh3, #artigo_charlotte_" + id + " .txtFinal").off();
    
    $("#artigo_charlotte_" + id + " .bgArtCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_charlotte_" + id + " .bgArtCh").css('width', '100%');
        $("#artigo_charlotte_" + id + " .textoCh").removeClass('aBounceOut').addClass('aBounceIn');
        $("#artigo_charlotte_" + id + " a.info").removeClass('aBounceOut').addClass('aBounceIn');
        $("#artigo_charlotte_" + id + " .bgArtCh2").removeClass('animeDecreaseWidth').addClass('animeIncreaseWidth');
    });
    
    $("#artigo_charlotte_" + id + " .textoCh, #artigo_charlotte_" + id + " a.info").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {$("#artigo_charlotte_" + id + " .textoCh, #artigo_charlotte_" + id + " a.info").css('opacity', '1');});
    $("#artigo_charlotte_" + id + " .bgArtC.textoCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {$("#artigo_charlotte_" + id + " .bgArtC.textoCh").css('width', '100%');});
    
    setTimeout(function(){hideAnimationArtigoCharlotte(id);},10000);
}

function hideAnimationArtigoCharlotte(id){
    $("#artigo_charlotte_" + id + " .textoCh, #artigo_charlotte_" + id + " .bgArtCh, #artigo_charlotte_" + id + " .bgArtC.textoCh, #artigo_charlotte_" + id + " .bgArtCh3, #artigo_charlotte_" + id + " .txtFinal").off();
    $("#artigo_charlotte_" + id + " .textoCh, #artigo_charlotte_" + id + " a.info").removeClass('aBounceIn').addClass('aBounceOut');
    
    $("#artigo_charlotte_" + id + " .textoCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        
        $("#artigo_charlotte_" + id + " .bgArtCh").removeClass('animeIncreaseWidth').addClass('animeDecreaseWidth');
        $("#artigo_charlotte_" + id + " .bgArtCh2").removeClass('animeIncreaseWidth').addClass('animeDecreaseWidth');
    });
    
  
    $("#artigo_charlotte_" + id + " .bgArtCh, #artigo_charlotte_" + id + " .bgArtC.textoCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        
        hideAnimationArtigoCharlotte2(id);
    });
    
    
}

function hideAnimationArtigoCharlotte2(id){
    $("#artigo_charlotte_" + id + " .textoCh, #artigo_charlotte_" + id + " .bgArtCh, #artigo_charlotte_" + id + " .bgArtC.textoCh, #artigo_charlotte_" + id + " .bgArtCh3, #artigo_charlotte_" + id + " .txtFinal").off();
    $("#artigo_charlotte_" + id + " .bgArtCh3").removeClass('animeDecreaseHeight').addClass('animeIncreaseHeight');
    
    
    $("#artigo_charlotte_" + id + " .bgArtCh3").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
       
        $("#artigo_charlotte_" + id + " .txtFinal").removeClass('aFadeOut').addClass('aFadeIn');
    });

    setTimeout(function(){hideAnimationArtigoCharlotte3(id)},6000);
}

function hideAnimationArtigoCharlotte3(id){
    $("#artigo_charlotte_" + id + " .textoCh, #artigo_charlotte_" + id + " .bgArtCh, #artigo_charlotte_" + id + " .bgArtC.textoCh, #artigo_charlotte_" + id + " .bgArtCh3, #artigo_charlotte_" + id + " .txtFinal").off();
    $("#artigo_charlotte_" + id + " .txtFinal").removeClass('aFadeIn').addClass('aFadeOut');
   
    $("#artigo_charlotte_" + id + " .txtFinal").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_charlotte_" + id + " .bgArtCh3").removeClass('animeIncreaseHeight').addClass('animeDecreaseHeight');
    });
    
    $("#artigo_charlotte_" + id + " .bgArtCh3").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        setTimeout(function(){showAnimationArtigoCharlotte(id);},300);
    });
}



