/*
    Document   : banner main
    Created on : 16/08/2011, 8:52:00
    Author     : CarlosGarcia
    Description: Javascript main banner controller
    Purpose of the javascript follows.
*/

var num_banners;
var id_banner_current = 1;
var id_banner_next = 2;
var id_banner_bg = 1;
var id_banner_back = 1;
var timerBanners = 8000;
var zBannerindex=0;
var pressedBannerBP = false;
var isNextBtBnPressed = false;
var intervaloBannerMain = null;

/*
 * This method is called form main.js
 * See the file above to see the cosntructor method
 * It's working as purpose because it was not working from here on ready initial method.
 * 
 */
function initBannerMain(banners){

    num_banners = $("#quantidade_banners").val();
    bannerObject = eval('(' + banners + ')');

    if(bannerObject[0]['image'] != '') {
        if(bannerObject[0]['image_type'] == 0) $('#banner_main').css('background', "url(/media/user/images/original/" + bannerObject[0]['image'] + ') center center');
        if(bannerObject[0]['image_type'] == 1) $('#banner_main').css('background', "url(/media/images/textures/site/" + bannerObject[0]['image'] + ') center center');
    }
    
    if(num_banners > 1){
        intervaloBannerMain = setInterval(slideShow, timerBanners);
        createNewBannersVariables(banners);
        
        var callback = $("#banner_loader1 .bannerPAttr").attr('data-callback');
        if (typeof window[callback] === 'function'){
            window[callback](1, 0);
        }
    }
    
    initButtonsBannerListeners();
    setSizeMainBannerResp(1);
}

//It animates the slide show after load a new image from banner 
function slideShow(){

    //alert("Total "+ num_banners + " Current "+ id_banner_current + " Next " + id_banner_next);
    clearInterval(intervaloBannerMain);
    
    //Se veio do slideback verifica se já esta sendo exibido
    if(id_banner_next == id_banner_current) id_banner_next++;
    if(id_banner_next > num_banners) id_banner_next = 1;
    if(id_banner_bg >=  num_banners) id_banner_bg = 0;
    if(id_banner_bg <  0) id_banner_bg = num_banners -1;
    
    if($("#banner_loader" + id_banner_next).attr('id') == undefined){loadNewBanner(id_banner_next);}    
    $("#banner_loader" + id_banner_current).hide();
    $('#banner_loader' + id_banner_current).fadeOut(200, function(){
        
        if(typeof bannerObject[id_banner_bg] != 'undefined'){
            if(bannerObject[id_banner_bg]['image_type'] == 0) $('#banner_main').css('background', "url(/media/user/images/original/" + bannerObject[id_banner_bg]['image'] + ') center center');
            if(bannerObject[id_banner_bg]['image_type'] == 1) $('#banner_main').css('background', "url(/media/images/textures/site/" + bannerObject[id_banner_bg]['image'] + ') center center');
        }
    });
    
    $("#banner_loader" + id_banner_next).fadeIn(300, function(){
        
        $("#banner_loader" + id_banner_next).css("z-index", zBannerindex++);
        
        //Prepara proxima troca de banner
        id_banner_current = id_banner_next;
        id_banner_bg++;
        id_banner_next++;

        intervaloBannerMain = setInterval(slideShow, timerBanners);
        $("#banner_loader" + id_banner_current).show();
        $(".bnOlbM").removeClass('active'); 
        $("#bnOl_" + id_banner_current).addClass('active');
        pressedBannerBP = false;
        
        var callback = $("#banner_loader" + id_banner_current + " .bannerPAttr").attr('data-callback');
        if (typeof window[callback] === 'function'){
            window[callback](1, 0);
            console.log('Here: ' + callback);
        }
        
        setSizeMainBannerResp(id_banner_current);
        
    });

    //$(".bn_shadow").append(id_banner_current + " _  "+ id_banner_next +  "  ");
}

//It animates the slide show to back 
function backslideShow(){
        
    if(id_banner_next == id_banner_current) id_banner_next--;
    if(id_banner_next <= 0) id_banner_next = num_banners;
    if(id_banner_bg < 0) id_banner_bg = num_banners -1;
    if(id_banner_bg >= num_banners) id_banner_bg = 0;

    clearInterval(intervaloBannerMain);  

    //alert(id_banner_back + " - " + $("#banner_loader" + id_banner_back).attr('id'));
    if($("#banner_loader" + id_banner_next).attr('id') != undefined){
        $("#banner_loader" + id_banner_current).hide();
        $("#banner_loader" + id_banner_current).fadeOut(300, function(){
            
            //if(bannerObject[id_banner_bg]['image'] != '') {
                //if(bannerObject[id_banner_bg]['image_type'] == 0) $('#banner_main').css('background', "url(/media/user/images/original/" + bannerObject[id_banner_bg]['image'] + ') center center');
                //if(bannerObject[id_banner_bg]['image_type'] == 1) $('#banner_main').css('background', "url(/media/images/textures/site/" + bannerObject[id_banner_bg]['image'] + ') center center');
            //}
            id_banner_bg--;
        });
        
        $("#banner_loader" + id_banner_next).fadeIn(300, function(){
            pressedBannerBP = false;
            //Prepara proxima troca de banner
            id_banner_current = id_banner_next;
            $(".bnOlbM").removeClass('active'); 
            $("#bnOl_" + id_banner_current).addClass('active');
            

        }).css("z-index", zBannerindex++);

        intervaloBannerMain = setInterval(slideShow, timerBanners);
    }
}

//It animates the slide show to next item
function nextslideShow(){

    clearInterval(intervaloBannerMain);
    

    //Se veio do slideback verifica se já esta sendo exibido
    if(id_banner_next == id_banner_current)id_banner_next++;
    if(id_banner_next > num_banners) {id_banner_next = 1; id_banner_bg = 0}
    if(id_banner_bg < 0) id_banner_bg = 1;
    
    $("#banner_loader" + id_banner_current).hide();
    $('#banner_loader' + id_banner_current).fadeOut(300, function(){        
        id_banner_bg++;

    });
    
    //Verifica se já está carregado o próximo banner, senão carrega!
    if($("#banner_loader" + id_banner_next).attr('id') == undefined){
        if(id_banner_next <= num_banners) loadNewBanner(id_banner_next);
    }

    $("#banner_loader" + id_banner_next).fadeIn(300, function(){
        pressedBannerBP = false;
        //Prepara proxima troca de banner
        id_banner_current = id_banner_next;
        intervaloBannerMain = setInterval(slideShow, timerBanners);
        isNextBtBnPressed = true;
        $(".bnOlbM").removeClass('active'); 
        $("#bnOl_" + id_banner_current).addClass('active');

        var callback = $("#banner_loader" + id_banner_current + " .bannerPAttr").attr('data-callback');        
        if (typeof window[callback] === 'function'){
            console.log('Next: ' + callback);
            window[callback](1, 0);
        }
        
        setSizeMainBannerResp(id_banner_current); 

    }).css("z-index", zBannerindex++);
}

/*
 * Init the listeners 
 * It prepares the the new action for the banner main 
 * 
 */
function initButtonsBannerListeners(){

    $(".bn_button_left").click(function(){
        if(!pressedBannerBP){
            pressedBannerBP = true;
            id_banner_next--;
            if(id_banner_next <= 0){
                id_banner_next = num_banners;
                id_banner_bg = id_banner_next - 1;
            }
            backslideShow();
        }
    });

    $(".bn_button_right").click(function(){
        if(!pressedBannerBP){
            pressedBannerBP = true;
            id_banner_next++;
            if(id_banner_next > num_banners){
                id_banner_next = 1;
                id_banner_bg = 0;
            }
            nextslideShow();
        }
    });
}

/*
 * Sets the main banner properties.
 * 
 * @param number
 * @param number
 *
 */
function setSizeMainBanner(alt, larg){
    $(".mn_banner_container").css("height", alt + "px");       
    $(".mn_banner_container").css("width", larg + "px");
}

/*
 * Sets the main banner properties.
 * 
 * @param number
 * @param number
 *
 */
function setSizeMainBannerResp(id){
    var bnSupHeight = $("#banner_main_support").attr('data-height');
    
    setTimeout(function(){
        if((bnSupHeight === undefined || bnSupHeight == '') || bnSupHeight < $("#banner_loader" + id).height()){
            $("#banner_main_support").css('height', $("#banner_loader" + id).height() + "px");
            $("#banner_main_support").attr('data-height', $("#banner_loader" + id).height());
        }
    }, 1000);
    
    
}

/*
 * Loads a new banner.
 * 
 * @param number
 *
 */
function loadNewBanner(nextBn){
    
    var idObject = nextBn -1;
    
    //Se for render partial pula
        
    var items_sc = "";            
    items_sc  = "<div id='banner_loader"+nextBn+"'>";
    items_sc += "<div class='canvas_stage"+bannerObject[idObject]['id']+"'></div>";
    items_sc += "</div>";
    $("#banner_main_support").append(items_sc); 

    //This statement is declared inside extremos.js
    isCreateBoard = false;

    if(bannerObject[idObject]['modelo'] != 'render_partial') addBannerHTML(JSON.stringify(bannerObject[idObject]['cool2']), bannerObject[idObject]['id']);
    if(bannerObject[idObject]['modelo'] == 'render_partial') addBannerRenderPartial(JSON.stringify(bannerObject[idObject]['cool3']), bannerObject[idObject]['id'], nextBn);
    //if(bannerObject[idObject]['modelo'] == 'render_partial') $('#banner_loader' + nextBn).empty().append(bannerObject[idObject]['view']);
        
    //setSizeMainBanner(bannerObject[idObject]['altura'], bannerObject[idObject]['largura']); //////CarlosGarcia Mobile testes!
    //if($("#device_stage").val() == "mobile")setMobileStageSize("");   
    
}

/*
 * Loads a new banner.
 * 
 * @param number
 *
 */
function createNewBannersVariables(){    
    if($("#device_stage").val() == "mobile")setMobileStageSize("");
}

/*
 * Loads a new renderpartial view.
 * 
 * @param number
 *
 */
function addBannerRenderPartial(json, id, nextBn){
    
    $.post("/admin/html_renderpartial/load_view",{
        id: id,
        json: json
        
    },function(data){
        $('#banner_loader' + nextBn).empty().append(data);
    });
}