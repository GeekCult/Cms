<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Controle de usuários</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>" />
    </a>
    <a href="javascript:history.go(-1)">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_back") ?>" />
    </a>
    <div class="clear"></div>
    <div class="container_obrigado_user">
        <h2>Parabéns!</h2>                
        <div class="cc-main-content">
            <div class="container_text_obrigado">                        
                <p>&nbsp;</p>
                <p>Olá, o usuário <b><?php echo $usuario_Nome; ?></b> teve seus dados modificados!</p>
                <p>&nbsp;</p>
                <p>Alteração realizada com sucesso!</p>
                <p>Se você  possuir qualquer dúvida sobre sua conta, por favor nos <a href="">contate</a></p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>                                                                  
            </div>
            <div class='clear'></div>
        </div>                
    </div>
    <p>&nbsp;</p> 
    <div class="buttons_right">        
        <a href="/admin/users/<?php echo $type_user ?>/listar_<?php echo $type_user ?>">
            <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list") ?>" />
        </a>       
    </div>
</div>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>
<script type="text/javascript">update(<?php echo json_encode($preferences) ?>);updatePanMain();</script>