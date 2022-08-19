<?php include Yii::app()->getBasePath() . '/views/admin/common/header/header_g2.php'; ?>

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="/css/admin/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Autos</li>
        <li><a href="/admin/autos/categorias_novo">novo</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Autos <small>listagem das categorias</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        
        <!-- begin col-10 -->
        <div class="row-fluid">
            <div class="row-fluid">
            <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Listagem das categorias</h4>
                    </div>

                    <div class="panel-body">
                        
                        <div class="form-group">
                            <ul class="nav nav-tabs gray">                              
                                <li><a href="/admin/autos/categorias_novo" id="bt_videos_product">Novo</a></li>
                                <li class="active"><a href="javascript:;" id="bt_description_main" >Listar</a></li>
                                <li><a href="/admin/autos/categorias_novo" id="bt_videos_product">+</a></li>
                            </ul>                                                    
                            <hr class="half" />
                        </div>

                        <div class="table-responsive table_support">
                            
                            <div class="table_support_ecommerce">
                                
                                <table class="table table-bordered">            
                                    <tr class="title_table">
                                        <td width="5%"  align="center"><?php echo Yii::t("adminForm", "common_id") ?></td>
                                        <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_name_categoria") ?></td>
                                        <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_categoria_url") ?></td>
                                        <td width="5%" ><?php echo Yii::t("adminForm", "common_menu_index") ?></td>
                                        <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                                        <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_delete") ?></td>
                                    </tr>
                                    <?php if(count($categorias) != 0){ ?>
                                    <?php if($categorias[0]['categoria_label'] != ""){ $color = "0"; foreach($categorias as $values){?>
                                    <tr id="item_<?php echo $values['id_categoria'] ?>" class="rows_table_<?php echo $color ?>">
                                        <td align="center"><?php echo $values['id_categoria'] ?></td>
                                        <td><?php echo $values['categoria_label'] ?></td>
                                        <td><?php echo $values['categoria_url'] ?></td>   
                                        <td><?php echo $values['n_index'] ?></td>
                                        <td align="center"><input type="button" id="bt_edit_main" name="<?php echo $values['id_categoria'] ?>" title="editar" class="bt_edit"/></td>
                                        <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id_categoria'] ?>" title="excluir" alt="categoria"/></td>
                                    </tr>
                                    <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }} ?>
                                    <?php } else { ?>
                                    <tr class="rows_table_0">
                                        <td height="30" align="center" colspan="6" class="txt_padrao">
                                            Não existem categorias cadastradas no sistema atualmente.
                                        </td>
                                    </tr>
                                    <?php }  ?>
                                </table>
                                <p>&nbsp;</p>
                                
                                <table class="table table-bordered">            
                                    <tr class="title_table">
                                        <td width="5%"  align="center"><?php echo Yii::t("adminForm", "common_id") ?></td>
                                        <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_name_subcategoria") ?></td>
                                        <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_subcategoria_url") ?></td>
                                        <td width="5%" ><?php echo Yii::t("adminForm", "common_menu_index") ?></td>
                                        <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                                        <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_delete") ?></td>
                                    </tr>
                                    <?php if(count($subcategorias) != 0){ ?>
                                    <?php if($subcategorias[0]['subcategoria_label'] != ""){ $color = "0"; foreach($subcategorias as $values){?>
                                    <tr id="item_<?php echo $values['id_subcategoria'] ?>" class="rows_table_<?php echo $color ?>">
                                        <td align="center"><?php echo $values['id_subcategoria'] ?></td>
                                        <td><?php echo $values['subcategoria_label'] ?></td>
                                        <td><?php echo $values['subcategoria_url'] ?></td>
                                        <td><?php //echo $values['n_index'] ?></td>
                                        <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id_subcategoria'] ?>" title="editar"/></td>
                                        <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id_subcategoria'] ?>" title="excluir" alt="subcategoria"/></td>
                                    </tr>
                                    <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }}  ?>
                                    <?php } else { ?>
                                    <tr class="rows_table_0">
                                        <td height="30" align="center" colspan="6" class="txt_padrao">
                                            Não existem subcategorias cadastradas no sistema atualmente.
                                        </td>
                                    </tr>
                                    <?php }  ?>
                                </table>
                                <p>&nbsp;</p>
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="title_table"> 
                                            <td width="5%"  align="center"><?php echo Yii::t("adminForm", "common_id") ?></td>
                                            <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_name_subitem") ?></td>
                                            <td width="150px" ><?php echo Yii::t("adminForm", "common_menu_subitem_url") ?></td>
                                            <td width="5%" ><?php echo Yii::t("adminForm", "common_menu_index") ?></td>
                                            <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                                            <td width="1%"  align="center"><?php echo Yii::t("adminForm", "common_menu_delete") ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($subitems) != 0){ ?>
                                        <?php if($subitems[0]['subitem_label'] != ""){ $color = "0"; foreach($subitems as $values){?>
                                        <tr id="item_<?php echo $values['id_subitem'] ?>" class="rows_table_<?php echo $color ?>">
                                            <td align="center"><?php echo $values['id_subitem'] ?></td>
                                            <td><?php echo $values['subitem_label'] ?></td>
                                            <td><?php echo $values['subitem_url'] ?></td> 
                                            <td><?php //echo $values['n_index'] ?></td>
                                            <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id_subitem'] ?>" title="editar"/></td>
                                            <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id_subitem'] ?>" title="excluir" alt="subitem"/></td>
                                        </tr>
                                        <?php if($color == "1"){$color = "0"; }else{$color = "1";};  }}  ?>
                                        <?php } else { ?>
                                        <tr class="rows_table_0">  
                                            <td colspan="6"><p class="center">Não existem subitens cadastrados no sistema atualmente.</p></td>                                                        
                                        </tr>
                                        <?php }  ?>
                                    </tbody>                                    
                                </table>
                            </div>                         
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <div id="output"></div>
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->
   <input type="hidden" id="action_helper" value="categorias_listar"/>
</div>
<!-- end #content -->

<?php include Yii::app()->getBasePath() . '/views/admin/common/special/modal.php'; ?>

<!-- ================== BEGIN BASE JS ================== -->
<script src="/css/admin/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="/css/admin/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="/css/admin/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/css/admin/assets/plugins/bootstrap/js/bootstrap.js"></script>
<!--[if lt IE 9]>
        <script src="assets/crossbrowserjs/html5shiv.js"></script>
        <script src="assets/crossbrowserjs/respond.min.js"></script>
        <script src="assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/css/admin/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/css/admin/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/css/admin/assets/js/apps.min.js"></script>
<script src="/js/admin/PurplePier.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function () {
        App.init();
        PurplePier.init();
    });
</script>