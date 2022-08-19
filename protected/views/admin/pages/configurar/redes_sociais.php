<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t('adminForm', 'setting_page_title') ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <fieldset class="adminFormContent">
        <ul>
            <h4 class="subtitle_admin"><?php echo Yii::t('adminForm', 'setting_title_network') ?></h4>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_1') ?></div>
                <div class="text">
                    <input id="facebook" type="text" class="form" value="<?php echo $content['facebook'] ?>" placeholder="PurplePier"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_2') ?></div>
                <div class="text">
                    <input id="twitter" type="text" class="form" value="<?php echo $content['twitter'] ?>" placeholder="@PurplePier"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_3') ?></div>
                <div class="text">
                    <input id="orkut" type="text" class="form" value="<?php echo $content['orkut'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_4') ?></div>
                <div class="text">
                    <input id="linkedin" type="text" class="form" value="<?php echo $content['linkedin'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_5') ?></div>
                <div class="text">
                    <input id="google_mais_um" type="text" class="form" value="<?php echo $content['google_mais_um'] ?>" placeholder="https://plus.google.com/u/0/b/115538129867916837009"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_6') ?></div>
                <div class="text">
                    <input id="canal_youtube" type="text" class="form" value="<?php echo $content['canal_youtube'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_7') ?></div>
                <div class="text">
                    <input id="flickr" type="text" class="form" value="<?php echo $content['flickr'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_8') ?></div>
                <div class="text">
                    <input id="instagram" type="text" class="form" value="<?php echo $content['instagram'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'setting_page_label_9') ?></div>
                <div class="text">
                    <input id="pinterest" type="text" class="form" value="<?php echo $content['pinterest'] ?>"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_skype') ?></div>
                <div class="text">
                    <input id="skype" type="text" class="form" value="<?php echo $content['skype'] ?>" placeholder="carlogarcia_nohaw"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_rss') ?></div>
                <div class="text">
                    <input id="rss" type="text" class="form" value="<?php echo $content['rss'] ?>" placeholder="/rss"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_email_contact') ?></div>
                <div class="text">
                    <input id="email" type="text" class="form" value="<?php echo $content['email_contato'] ?>" placeholder="contato@purplepier.com.br"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_phone_contact') ?></div>
                <div class="text">
                    <input id="telefone" type="text" class="form" value="<?php echo $content['telefone'] ?>" placeholder="(19) 9-9991-2345"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin"><?php echo Yii::t('adminForm', 'common_initial_page') ?></div>
                <div class="text">
                    <input id="home" type="text" class="form" value="<?php echo $content['home'] ?>" placeholder="/home"/>
                </div>
            </li>
            <li class="rows">
                <div class="label_text_Admin">Mapa do site</div>
                <div class="text">
                    <input id="site_map" type="text" class="form" value="<?php echo $content['site_map'] ?>" placeholder="/mapa_site"/>
                </div>
            </li>
            <li class="rows">
                </br>
            </li>
            <li class="rows hide">
                <div class="label_text_Admin">Atualizar Posts</div>
                <div class="text">
                    <input id="bt_update_social" type="button" class="botao" value="Atualizar"/>
                </div>
            </li>
        </ul>
    </fieldset>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit_network" value="<?php echo Yii::t('adminForm', 'button_common_update') ?>"/>
    </div>
    <div class="clear height_support"></div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>