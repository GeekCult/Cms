<?php include Yii::app()->getBasePath() . '/views/site/common/header/site/' . $preferences['topo_tipo'] . '.php'; ?>


<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container">
    
    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    
    <div class="row-fluid">
        <div class="span12">
            <h2>Pesquisa de domínios</h2>
            <div class="divider_horizontal mgB2"></div>
        </div>
    </div>
    
    <?php if(isset($domain_available)){ ?>
    <div class="row-fluid">
        <div class="span12">            
            <?php if($domain_available == 'unavailable'){ ?>
            <div class="bg-danger"><p>Domínio já registrado</p></div>
            <?php } ?>
            <?php if($domain_available == 'available'){ ?>
            <div class="bg-success"><p>Domínio disponível</p></div>
            <?php } ?>
            <?php if($domain_available == 'invalid'){ ?>
            <div class="bg-info"><p>Domínio inválido</p></div>
            <?php } ?>
           <p class="lead"><?php //echo nl2br($domain_info)?></p> 
        </div>        
    </div>
    <?php } ?>
    
    
    
    <div class="row-fluid">   
        <form>
            <div class="span8">
                <div class="input_support_rb">
                    <span class="www_box left">www.</span>
                    <input type="text" placeholder="Insira um nome de domínio" id="dominio_input" class="input_box_sub" value="<?php if(isset($dominio_simples[0])) echo $dominio_simples[0]; ?>">
                </div>                        
            </div>
            <div class="span2">
                <div class="domain-registration-top-level">
                    <select name="domiio_input_sufixo" class="span12" id="dominio_input_sufixo">
                        <option value="com.br" <?php if($extensao === 'com.br'){ echo 'selected';} ?>>.com.br</option>
                        <option value="com" <?php if($extensao === 'com'){ echo 'selected';} ?>>.com</option>
                        <option value="net" <?php if($extensao === 'net'){ echo 'selected';} ?>>.net</option>
                        <option value="org" <?php if($extensao === 'org'){ echo 'selected';} ?>>.org</option>
                        <option value="adm.br" <?php if($extensao === 'adm.br'){ echo 'selected';} ?>>.adm.br</option>
                        <option value="adv.br" <?php if($extensao === 'adv.br'){ echo 'selected';} ?>>.adv.br</option>
                        <option value="agr.br" <?php if($extensao === 'agr.br'){ echo 'selected';} ?>>.agr.br</option>
                        <option value="am.br" <?php if($extensao === 'am.br'){ echo 'selected';} ?>>.am.br</option>
                        <option value="arq.br" <?php if($extensao === 'aqr.br'){ echo 'selected';} ?>>.arq.br</option>
                        <option value="art.br" <?php if($extensao === 'art.br'){ echo 'selected';} ?>>.art.br</option>
                        <option value="ato.br" <?php if($extensao === 'ato.br'){ echo 'selected';} ?>>.ato.br</option>
                        <option value="bio.br" <?php if($extensao === 'bio.br'){ echo 'selected';} ?>>.bio.br</option>
                        <option value="biz" <?php if($extensao === 'biz'){ echo 'selected';} ?>>.biz</option>
                        <option value="blog.br" <?php if($extensao === 'blog.br'){ echo 'selected';} ?>>.blog.br</option>
                        <option value="bmd.br" <?php if($extensao === 'bmd.br'){ echo 'selected';} ?>>.bmd.br</option>
                        <option value="cim.br" <?php if($extensao === 'cim.br'){ echo 'selected';} ?>>.cim.br</option>
                        <option value="cng.br" <?php if($extensao === 'cng.br'){ echo 'selected';} ?>>.cng.br</option>
                        <option value="cnt.br" <?php if($extensao === 'cnt.br'){ echo 'selected';} ?>>.cnt.br</option>
                        <option value="coop.br" <?php if($extensao === 'coop.br'){ echo 'selected';} ?>>.coop.br</option>
                        <option value="ecn.br" <?php if($extensao === 'ecn.br'){ echo 'selected';} ?>>.ecn.br</option>
                        <option value="eco.br" <?php if($extensao === 'eco.br'){ echo 'selected';} ?>>.eco.br</option>
                        <option value="edu.br" <?php if($extensao === 'edu.br'){ echo 'selected';} ?>>.edu.br</option>
                        <option value="eng.br" <?php if($extensao === 'eng.br'){ echo 'selected';} ?>>.eng.br</option>
                        <option value="esp.br" <?php if($extensao === 'esp.br'){ echo 'selected';} ?>>.esp.br</option>
                        <option value="etc.br" <?php if($extensao === 'etc.br'){ echo 'selected';} ?>>.etc.br</option>
                        <option value="eti.br" <?php if($extensao === 'eti.br'){ echo 'selected';} ?>>.eti.br</option>
                        <option value="far.br" <?php if($extensao === 'far.br'){ echo 'selected';} ?>>.far.br</option>
                        <option value="flog.br" <?php if($extensao === 'flog.br'){ echo 'selected';} ?>>.flog.br</option>
                        <option value="fm.br" <?php if($extensao === 'fn.br'){ echo 'selected';} ?>>.fm.br</option>
                        <option value="fnd.br" <?php if($extensao === 'fnd.br'){ echo 'selected';} ?>>.fnd.br</option>
                        <option value="fot.br" <?php if($extensao === 'fot.br'){ echo 'selected';} ?>>.fot.br</option>
                        <option value="fst.br" <?php if($extensao === 'fst.br'){ echo 'selected';} ?>>.fst.br</option>
                        <option value="g12.br" <?php if($extensao === 'g12.br'){ echo 'selected';} ?>>.g12.br</option>
                        <option value="ggf.br" <?php if($extensao === 'ggf.br'){ echo 'selected';} ?>>.ggf.br</option>
                        <option value="gov.br" <?php if($extensao === 'gov.br'){ echo 'selected';} ?>>.gov.br</option>
                        <option value="imb.br" <?php if($extensao === 'imb.br'){ echo 'selected';} ?>>.imb.br</option>
                        <option value="ind.br" <?php if($extensao === 'ind.br'){ echo 'selected';} ?>>.ind.br</option>
                        <option value="inf.br" <?php if($extensao === 'inf.br'){ echo 'selected';} ?>>.inf.br</option>
                        <option value="info" <?php if($extensao === 'info'){ echo 'selected';} ?>>.info</option>
                        <option value="jor.br" <?php if($extensao === 'jor.br'){ echo 'selected';} ?>>.jor.br</option>
                        <option value="lel.br" <?php if($extensao === 'lel.br'){ echo 'selected';} ?>>.lel.br</option>
                        <option value="mat.br" <?php if($extensao === 'mat.br'){ echo 'selected';} ?>>.mat.br</option>
                        <option value="med.br" <?php if($extensao === 'med.br'){ echo 'selected';} ?>>.med.br</option>
                        <option value="mil.br" <?php if($extensao === 'mil.br'){ echo 'selected';} ?>>.mil.br</option>
                        <option value="mus.br" <?php if($extensao === 'mus.br'){ echo 'selected';} ?>>.mus.br</option>
                        <option value="name" <?php if($extensao === 'name'){ echo 'selected';} ?>>.name</option>
                        <option value="net.br" <?php if($extensao === 'net.br'){ echo 'selected';} ?>>.net.br</option>
                        <option value="nom.br" <?php if($extensao === 'nom.br'){ echo 'selected';} ?>>.nom.br</option>
                        <option value="not.br" <?php if($extensao === 'not.br'){ echo 'selected';} ?>>.not.br</option>
                        <option value="ntr.br" <?php if($extensao === 'ntr.br'){ echo 'selected';} ?>>.ntr.br</option>
                        <option value="odo.br" <?php if($extensao === 'odo.br'){ echo 'selected';} ?>>.odo.br</option>
                        <option value="org.br" <?php if($extensao === 'org.br'){ echo 'selected';} ?>>.org.br</option>
                        <option value="ppg.br" <?php if($extensao === 'ppg.br'){ echo 'selected';} ?>>.ppg.br</option>
                        <option value="pro.br" <?php if($extensao === 'pro.br'){ echo 'selected';} ?>>.pro.br</option>
                        <option value="psc.br" <?php if($extensao === 'psc.br'){ echo 'selected';} ?>>.psc.br</option>
                        <option value="psi.br" <?php if($extensao === 'psi.br'){ echo 'selected';} ?>>.psi.br</option>
                        <option value="qsl.br" <?php if($extensao === 'qsl.br'){ echo 'selected';} ?>>.qsl.br</option>
                        <option value="rec.br" <?php if($extensao === 'rec.br'){ echo 'selected';} ?>>.rec.br</option>
                        <option value="slg.br" <?php if($extensao === 'slg.br'){ echo 'selected';} ?>>.slg.br</option>
                        <option value="srv.br" <?php if($extensao === 'srv.br'){ echo 'selected';} ?>>.srv.br</option>
                        <option value="tmp.br" <?php if($extensao === 'tmp.br'){ echo 'selected';} ?>>.tmp.br</option>
                        <option value="trd.br" <?php if($extensao === 'trd.br'){ echo 'selected';} ?>>.trd.br</option>
                        <option value="tur.br" <?php if($extensao === 'tur.br'){ echo 'selected';} ?>>.tur.br</option>
                        <option value="tv.br" <?php if($extensao === 'tv.br'){ echo 'selected';} ?>>.tv.br</option>
                        <option value="vet.br" <?php if($extensao === 'vet.br'){ echo 'selected';} ?>>.vet.br</option>
                        <option value="vlog.br" <?php if($extensao === 'vlog.br'){ echo 'selected';} ?>>.vlog.br</option>
                        <option value="wiki.br" <?php if($extensao === 'wiki.br'){ echo 'selected';} ?>>.wiki.br</option>
                        <option value="zlg.br" <?php if($extensao === 'zlg.br'){ echo 'selected';} ?>>.zlg.br</option>
                    </select>
                </div>
            </div>
            <div class="span2 center">
                <button id="bt_check_domain_whois" class="domain-registration-submit" type="button">Pesquisar</button>
            </div>                    
        </form> 
    </div>
    <hr class="half" />
    <?php if(isset($domain_available)){ ?>
        <?php if($domain_available == 'unavailable'){ ?>    
        <div class="row-fluid">
            <h2>Whois</h2>
            <hr class="half2" />
            <?php echo nl2br($domain_info['content']); ?>
        </div>    
        <?php }else if($domain_available == 'available'){ ?>
         <div class="row-fluid">
            <h2>Clique aqui para pedir o registro</h2>
            <hr class="half2" />
            <a href="/contato">
                <input type="button" class="botao btn-main" value="Pedir"/>
            </a>            
        </div>
        <?php } ?>
    <?php } ?>
    <div class="row-fluid center">
        <hr class="half" />
        <a class="domain-registration-action" href="/registrodominios" target="_blank">Saiba mais sobre domínios</a>
        <div class="clear mgFooter"></div>
    </div>
</div>
<!-- ################ -->
<!-- END: CONTAINER  FEATURE -->
<!-- ################ -->


        

<?php include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php';  ?>