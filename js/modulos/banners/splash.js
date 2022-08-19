/*
 * Splash Animation
 * 
 */

function initRolodexBanner(nr){
    //console.log('start: '+ nr);
    animateInSplash(nr, 0);  
}

function animateInSplash(nr, time){
    
    clearInterval(intervaloBannerMain);
    
    $(".ctnRl_" + nr + ", .ctn_iRl_" + nr).show();
    setTimeout(function(){$(".bs_Bg_" + nr).animate({opacity: '1'});}, time); 
    setTimeout(function(){$(".iRl_" + nr).animate({marginTop : '0px', marginBottom : '0px', opacity: '1'});}, time+ 200);
    setTimeout(function(){$(".rlT_" + nr).animate({marginLeft : '20px', opacity: '1'});}, time + 500);
    setTimeout(function(){$(".rlP_" + nr).animate({marginLeft : '20px', opacity: '1'});}, time + 700);
    setTimeout(function(){$(".rlBt_" + nr).animate({marginTop : '-5px', marginBottom : '5px', opacity: '1'});}, time + 900);
    
    var intervalo_animation = $("#banner_loader"+ nr + " .bannerPAttr").attr('data-intervalo-animation') * 1;
    setTimeout(function(){animateOutSplash(nr, 5000);}, intervalo_animation);
    //console.log("In: " + nr);
}

function animateOutSplash(nr, time){
    setTimeout(function(){$(".bs_Bg_" + nr).animate({opacity: '0'});}, time + 800); 
    setTimeout(function(){$(".iRl_" + nr).animate({marginTop : '0px', marginBottom : '0px', opacity: '0'});}, time+ 800);
    setTimeout(function(){$(".rlT_" + nr).animate({marginLeft : '0px', opacity: '0'});}, time + 500);
    setTimeout(function(){$(".rlP_" + nr).animate({marginLeft : '0px', opacity: '0'});}, time + 300);
    setTimeout(function(){$(".rlBt_" + nr).animate({marginTop : '5px', marginBottom : '-5px', opacity: '0'});}, time);

    var nr_anima = $("#banner_loader"+ nr + " .bannerPAttr").attr('data-nr-animation');
    setTimeout(function(){
        
        $(".ctnRl_" + nr+ ", .ctn_iRl_" + nr).hide();
        nr++;
        
        if(nr > (nr_anima * 1) || nr_anima === undefined){
            nr = 1;
            nextslideShow();
        }
        //animateInSplash(nr);
    }, time + 1100);
    
    //console.log("Out: " + nr);
}
   