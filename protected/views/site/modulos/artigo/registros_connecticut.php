<div id="registros_connecticut_<?php echo $id ?>" class="fullCP">
    <link rel="stylesheet" href="/css/site/modulos/artigo/registros.css" type="text/css" media="screen" />
    <div class="row-fluid">
      <div class="container fullCT">
            <?php if($image_1 != ''){ ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="thumbnails center">
                        <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                        <img id="slot_picture<?php echo $id ?>" src="/media/user/images/original/<?php echo $image_1 ?>" alt="<?php echo $image_1 ?>" />
                        <?php if($link_1 != ''){ ?></a><?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                        <div class="ctnArtTxt">
                            <?php if($titulo_1 != ""){ ?>
                            <h2 class="mainTitle"><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                            <?php } ?>
                            <?php if($subtitulo_1 != ""){ ?>
                            <div class="clear"></div>
                            <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                            <?php } ?>
                            <?php if($texto_1 != ""){ ?>
                            <div class="clear"></div>
                            <p class="tP"><?php if($texto_1 != ""){echo htmlspecialchars_decode(nl2br($texto_1));}else{if(isset($isAdmin))echo nl2br(C::TEXT_LOREM);} ?></p>
                            <?php } ?>
                        </div>
                    </div>            
                </div>        
            </div>
            <div class="row-fluid">
                
                <form>
                    <div class="span8">
                        <div class="input_support_rb">
                            <span class="www_box left">www.</span>
                            <input type="text" placeholder="Insira um nome de domínio" id="dominio_input" class="input_box_sub">
                        </div>                        
                    </div>
                    <div class="span2">
                        <div class="domain-registration-top-level">
                            <select name="input_sufixo" class="span12" id="dominio_input_sufixo">
                                <option value="com.br">.com.br</option>
                                <option value="com">.com</option>
                                <option value="net">.net</option>
                                <option value="org">.org</option>
                                <option value="adm.br">.adm.br</option>
                                <option value="adv.br">.adv.br</option>
                                <option value="agr.br">.agr.br</option>
                                <option value="am.br">.am.br</option>
                                <option value="arq.br">.arq.br</option>
                                <option value="art.br">.art.br</option>
                                <option value="ato.br">.ato.br</option>
                                <option value="bio.br">.bio.br</option>
                                <option value="biz">.biz</option>
                                <option value="blog.br">.blog.br</option>
                                <option value="bmd.br">.bmd.br</option>
                                <option value="cim.br">.cim.br</option>
                                <option value="cng.br">.cng.br</option>
                                <option value="cnt.br">.cnt.br</option>
                                <option value="coop.br">.coop.br</option>
                                <option value="ecn.br">.ecn.br</option>
                                <option value="eco.br">.eco.br</option>
                                <option value="edu.br">.edu.br</option>
                                <option value="eng.br">.eng.br</option>
                                <option value="esp.br">.esp.br</option>
                                <option value="etc.br">.etc.br</option>
                                <option value="eti.br">.eti.br</option>
                                <option value="far.br">.far.br</option>
                                <option value="flog.br">.flog.br</option>
                                <option value="fm.br">.fm.br</option>
                                <option value="fnd.br">.fnd.br</option>
                                <option value="fot.br">.fot.br</option>
                                <option value="fst.br">.fst.br</option>
                                <option value="g12.br">.g12.br</option>
                                <option value="ggf.br">.ggf.br</option>
                                <option value="gov.br">.gov.br</option>
                                <option value="imb.br">.imb.br</option>
                                <option value="ind.br">.ind.br</option>
                                <option value="inf.br">.inf.br</option>
                                <option value="info">.info</option>
                                <option value="jor.br">.jor.br</option>
                                <option value="lel.br">.lel.br</option>
                                <option value="mat.br">.mat.br</option>
                                <option value="med.br">.med.br</option>
                                <option value="mil.br">.mil.br</option>
                                <option value="mus.br">.mus.br</option>
                                <option value="name">.name</option>
                                <option value="net.br">.net.br</option>
                                <option value="nom.br">.nom.br</option>
                                <option value="not.br">.not.br</option>
                                <option value="ntr.br">.ntr.br</option>
                                <option value="odo.br">.odo.br</option>
                                <option value="org.br">.org.br</option>
                                <option value="ppg.br">.ppg.br</option>
                                <option value="pro.br">.pro.br</option>
                                <option value="psc.br">.psc.br</option>
                                <option value="psi.br">.psi.br</option>
                                <option value="qsl.br">.qsl.br</option>
                                <option value="rec.br">.rec.br</option>
                                <option value="slg.br">.slg.br</option>
                                <option value="srv.br">.srv.br</option>
                                <option value="tmp.br">.tmp.br</option>
                                <option value="trd.br">.trd.br</option>
                                <option value="tur.br">.tur.br</option>
                                <option value="tv.br">.tv.br</option>
                                <option value="vet.br">.vet.br</option>
                                <option value="vlog.br">.vlog.br</option>
                                <option value="wiki.br">.wiki.br</option>
                                <option value="zlg.br">.zlg.br</option>
                            </select>
                        </div>
                    </div>
                    <div class="span2 center">
                        <button id="bt_check_domain_whois" class="domain-registration-submit" type="button">Pesquisar</button>
                    </div>                    
                </form> 
                    
                
            </div>
            <div class="row-fluid center">
                <a class="domain-registration-action" href="/registrodominios" target="_blank">Saiba mais sobre domínios</a>
            </div>
           
        </div>
    </div>
</div>