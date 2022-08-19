<li class="hide"><a href="#"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_product") ?></span></a>
    <ul id="bt_abrir_colabore">
         <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_product_single") ?></span></a>
            <ul id="bt_abrir_admin">
                <li><a id="cadastrar" href="/admin/produtos/novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                <li><a id="listar" href="/admin/produtos/listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
            </ul>
        </li>
        
        <li><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_category") ?></span></a>
            <ul id="bt_abrir_admin">
                <li><a id="cadastrar" href="/admin/produtos/categorias_novo"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_submit") ?></span></a></li>
                <li><a id="listar" href="/admin/produtos/categorias_listar"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_list") ?></span></a></li>
            </ul>
        </li>
        <!--<li class="hide"><a href="#" class="parent"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_settings") ?></span></a>
            <ul id="bt_abrir_admin">
                <li><a id="cadastrar" href="/admin/loja/details"><span><?php echo Yii::t("menuStrings", "widget_menu_ecommerce_details") ?></span></a></li>
            </ul>
        </li> -->
        <li><a href="/admin/produtos/comentarios"><span><?php echo Yii::t("menuStrings", "widget_menu_cat_comments") ?></span></a></li>
        <li class="hidden"><a href="/admin/loja/estatisticas"><span><?php echo Yii::t("menuStrings", "widget_menu_sub_statistics") ?></span></a></li>
    </ul>
</li>
