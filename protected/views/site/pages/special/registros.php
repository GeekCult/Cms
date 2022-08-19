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
    
    <?php if(isset($domain_info->status)){ ?>
    <div class="row-fluid">
        <h4 class="left">Domínio: <span class="texto"><?php echo $domain_info->fqdn ?></span></h4>
    </div>
    <div class="row-fluid">
        <h5 class="left">Query: <span class="texto"><?php echo $domain_info->query_id ?></span></h5>
    </div>
    <div class="clear mgB2"></div>
    <div class="row-fluid">
        <div class="span12">
            <?php if($domain_info->status == 3){ ?>
            <div class="bg-danger"><p>Domínio Indisponível</p></div>
            <?php } ?>
            <?php if($domain_info->status == 2){ ?>
            <div class="bg-danger"><p>Domínio já registrado</p></div>
            <?php } ?>
            <?php if($domain_info->status == 0){ ?>
            <div class="bg-success"><p>Domínio disponível</p></div>
            <?php } ?>
            <?php if($domain_info->status == 4){ ?>
            <div class="bg-danger"><p>Desculpe, ainda não damos suporte a este tipo de domínio</p></div>
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
                <button id="bt_check_domain" class="domain-registration-submit" type="button">Pesquisar</button>
            </div>                    
        </form> 
    </div>
    <div class="row-fluid center">
        <a class="domain-registration-action" href="/registrodominios" target="_blank">Saiba mais sobre domínios</a>
    </div>
    <div class="mgFooter"></div>
</div>
<!-- ################ -->
<!-- END: CONTAINER  FEATURE -->
<!-- ################ -->


        

<?php include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php';  ?>