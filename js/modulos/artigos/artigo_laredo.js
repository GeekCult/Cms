/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

    $(".md_artigo_laredo" ).each(function( index ) {
        //console.log( index + ": " + $( this ).attr('data-id') );
        showAnimationArtigoLaredo($( this ).attr('data-id'));
    });
});

function showAnimationArtigoLaredo(id){
    $("#artigo_laredo_" + id + " .bgArtCh").removeClass('animeDecreaseHeight').addClass('animeIncreaseHeight');
    $("#artigo_laredo_" + id + " .textoCh, #artigo_laredo_" + id + " .bgArtCh, #artigo_laredo_" + id + " .bgArtC.textoCh, #artigo_laredo_" + id + " .bgArtCh2, #artigo_laredo_" + id + " .txtInfo, #artigo_laredo_" + id + " .bgArtCh3, #artigo_laredo_" + id + " .txtFinal").off();
    
    $("#artigo_laredo_" + id + " .bgArtCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_laredo_" + id + " .bgArtCh").css('height', '100%');
        $("#artigo_laredo_" + id + " .textoCh").removeClass('aBounceOut').addClass('aBounceIn');
    });
    
    $("#artigo_laredo_" + id + " .textoCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {$("#artigo_laredo_" + id + " .textoCh").css('opacity', '1');});
    
    setTimeout(function(){hideAnimationArtigoLaredo(id);},10000);
}

function hideAnimationArtigoLaredo(id){
    $("#artigo_laredo_" + id + " .textoCh, #artigo_laredo_" + id + " .bgArtCh, #artigo_laredo_" + id + " .bgArtCh2, #artigo_laredo_" + id + " .txtInfo, #artigo_laredo_" + id + " .bgArtC.textoCh, #artigo_laredo_" + id + " .bgArtCh3, #artigo_laredo_" + id + " .txtFinal").off();
    $("#artigo_laredo_" + id + " .textoCh").removeClass('aBounceIn').addClass('aBounceOut');
    
    $("#artigo_laredo_" + id + " .textoCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_laredo_" + id + " .bgArtCh").removeClass('animeIncreaseHeight').addClass('animeDecreaseHeight')
    });

    $("#artigo_laredo_" + id + " .bgArtCh").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        hideAnimationArtigoLaredo2(id);
    });
    
    
    console.log('hideAnimationArtigoLaredo');
}

function hideAnimationArtigoLaredo2(id){
    $("#artigo_laredo_" + id + " .textoCh, #artigo_laredo_" + id + " .bgArtCh, #artigo_laredo_" + id + " .bgArtCh2, #artigo_laredo_" + id + " .txtInfo, #artigo_laredo_" + id + " .bgArtC.textoCh, #artigo_laredo_" + id + " .bgArtCh3, #artigo_laredo_" + id + " .txtFinal").off();
    $("#artigo_laredo_" + id + " .bgArtCh2").removeClass('animeDecreaseHeight').addClass('animeIncreaseHeight');
    
    
    $("#artigo_laredo_" + id + " .bgArtCh2").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_laredo_" + id + " .txtInfo").removeClass('aBounceOut').addClass('aBounceIn');
    });
    
    $("#artigo_laredo_" + id + " .txtInfo").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {$("#artigo_laredo_" + id + " .txtInfo").css('opacity', '1');});
    setTimeout(function(){hideAnimationArtigoLaredo3(id)},6000);
    console.log('hideAnimationArtigoLaredo2');
}

function hideAnimationArtigoLaredo3(id){
 
    $("#artigo_laredo_" + id + " .textoCh, #artigo_laredo_" + id + " .bgArtCh, #artigo_laredo_" + id + " .bgArtC.textoCh, #artigo_laredo_" + id + " .bgArtCh3, #artigo_laredo_" + id + " .txtFinal, #artigo_laredo_" + id + " .txtInfo").off();
    $("#artigo_laredo_" + id + " .txtInfo").removeClass('aBounceIn').addClass('aBounceOut');
    
    $("#artigo_laredo_" + id + " .txtInfo").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_laredo_" + id + " .bgArtCh2").removeClass('animeIncreaseHeight').addClass('animeDecreaseHeight');
    });
    
    $("#artigo_laredo_" + id + " .bgArtCh2").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_laredo_" + id + " .txtInfo").removeClass('aBounceIn');
        $("#artigo_laredo_" + id + " .txtInfo").css('opacity', '0');
        hideAnimationArtigoLaredo4(id);
    });

    console.log('hideAnimationArtigoLaredo3');
}

function hideAnimationArtigoLaredo4(id){
    $("#artigo_laredo_" + id + " .textoCh, #artigo_laredo_" + id + " .bgArtCh, #artigo_laredo_" + id + " .textoCh, #artigo_laredo_" + id + " .bgArtCh3, #artigo_laredo_" + id + " .txtFinal, #artigo_laredo_" + id + " .txtInfo").off();
    $("#artigo_laredo_" + id + " .bgArtCh3").removeClass('animeDecreaseHeight').addClass('animeIncreaseHeight');
    
    
    $("#artigo_laredo_" + id + " .bgArtCh3").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_laredo_" + id + " .txtFinal").removeClass('aBounceOut').addClass('aBounceIn');
    });
    
    $("#artigo_laredo_" + id + " .txtFinal").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {$("#artigo_laredo_" + id + " .txtFinal").css('opacity', '1');});
    setTimeout(function(){hideAnimationArtigoLaredo5(id)},6000);
    console.log('hideAnimationArtigoLaredo4');

}


function hideAnimationArtigoLaredo5(id){
    $("#artigo_laredo_" + id + " .textoCh, #artigo_laredo_" + id + " .bgArtCh, #artigo_laredo_" + id + " .bgArtC.textoCh, #artigo_laredo_" + id + " .bgArtCh3, #artigo_laredo_" + id + " .txtFinal, #artigo_laredo_" + id + " .txtInfo").off();
    $("#artigo_laredo_" + id + " .txtFinal").removeClass('aBounceIn').addClass('aBounceOut');
   
    $("#artigo_laredo_" + id + " .txtFinal").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        $("#artigo_laredo_" + id + " .bgArtCh3").removeClass('animeIncreaseHeight').addClass('animeDecreaseHeight');
    });
    
    $("#artigo_laredo_" + id + " .bgArtCh3").on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function() {
        setTimeout(function(){showAnimationArtigoLaredo(id);}, 0);
    });
    console.log('hideAnimationArtigoLaredo5');
}



