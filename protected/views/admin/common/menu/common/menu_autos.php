<li id="hide"><a href="#"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_autos") ?></span></a>
    <ul id="bt_abrir_colabore">
         <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_autos_item") ?></span></a>
            <ul id="bt_abrir_admin">
                <li><a id="cadastrar" href="/admin/autos/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                <li><a id="listar" href="/admin/autos/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
            </ul>
        </li>
        
        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_category") ?></span></a>
            <ul id="bt_abrir_admin">
                <li><a id="cadastrar" href="/admin/autos/categorias_novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                <li><a id="listar" href="/admin/autos/categorias_listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
            </ul>
        </li>
        <!--<li class="hide"><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_settings") ?></span></a>
            <ul id="bt_abrir_admin">
                <li><a id="cadastrar" href="/admin/loja/details"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_details") ?></span></a></li>
            </ul>
        </li> -->
        <li><a href="/admin/autos/comentarios"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_comments") ?></span></a></li>
        <li class="hidden"><a href="/admin/autos/estatisticas"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_statistics") ?></span></a></li>
    </ul>
</li>
