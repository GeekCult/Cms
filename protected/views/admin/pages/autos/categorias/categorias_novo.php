<?php include Yii::app()->getBasePath() . '/views/admin/common/header/header_g2.php'; ?>


<link href="/css/admin/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
<link href="/css/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
<link href="/css/admin/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
<link href="/css/admin/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<link href="/css/admin/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
<link href="/css/admin/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />

<link href="/css/admin/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="/css/admin/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Autos</li>
        <li><a href="/admin/autos/categorias_listar">listar</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Autos <small><?php echo Yii::t("adminForm", "category_page_title_new") ?></small></h1>
    <!-- end page-header -->

    <!-- end row -->
    <!-- begin row -->
    <div class="row">
        
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">&nbsp;</h4>
            </div>
            <div class="panel-body">
                <form id="contas_pagar">
                    <fieldset>
                        
                        <div class="form-group">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="javascript:;"><?php echo Yii::t("adminForm", "button_common_new") ?></a></li>                                                                                   
                                <li><a href="/admin/autos/categorias_listar"><?php echo Yii::t("adminForm", "button_common_list") ?></a></li>                                                                               
                            </ul>                                                    
                            <hr class="half" />
                        </div>
                        
                        <div class="form-group">
                            
                             <li class="rows"> 
                                 <label><?php echo Yii::t("adminForm", "store_categories_page_label") ?></label>
                                 <div class="row"> 
                                     <div class="col-md-6">
                                         <select name="categoria" id="categoria" size="1" class="form-control">
                                            <?php if(count($categorias) > 0){ foreach ($categorias as $values) { ?>
                                            <option value="<?php echo $values['id_categoria'] ?>" <?php if($values['id_categoria'] == $content['id_page']) echo " selected "; ?>><?php echo $values['categoria_label'] ?></option>
                                            <?php }}else{ ?>
                                            <option value="">Adicione uma categoria</option>  
                                            <?php } ?>
                                        </select>
                                     </div>
                                     <div class="col-md-6">
                                         <a href="javascript:;" id="add_category_store"><span class="badge3"><?php echo Yii::t("adminForm", "button_common_add_category") ?></span></a>
                                     </div>                                    
                                 </div>
                             </li>
                             
                             <li class="rows">                    
                                 <div class="label_text_loja"><?php echo Yii::t("adminForm", "store_subcategories_label") ?></div>
                                  <div class="row"> 
                                     <div class="col-md-6">
                                        <div class="combo_categorias_fotos styled-select" id="loader_combo_subcategorias">
                                            <select name="subcategoria" id="subcategoria" size="1" class="form-control">
                                                <?php if(count($subcategorias) > 0){ foreach ($subcategorias as $values) { ?>
                                                <option value="<?php echo $values['id_subcategoria'] ?>" <?php if($values['id_subcategoria'] == $content['id_page']) echo " selected "; ?>><?php echo $values['subcategoria_label'] ?></option>
                                                <?php }}else{ ?>
                                                <option value="">Adicione subcategoria</option>  
                                                <?php } ?>
                                            </select>
                                        </div>
                                     </div>
                                     <div class="col-md-6">
                                         <a href="javascript:;" id="add_subcategory_store"><span class="badge3"><?php echo Yii::t("adminForm", "button_common_add_subcategory") ?></span></a>
                                     </div>
                                 </div>
                             </li>
                             
                             <li class="rows">
                                <label><?php echo Yii::t("adminForm", "store_item_subcategory_label") ?></label>
                                <div class="row"> 
                                     <div class="col-md-6">
                                        <input id="label_item_subcategoria" type="text" class="form-control" value="<?php //echo $content['categoria_label'] ?>"/>
                                     </div>
                                </div>                                 
                             </li>
                             
                        </div>
                        
                        <hr class="half" />
                        <div class="form-group" id="output"></div>
                        <div class="form-group">        
                            <input type="button" class="btn btn-primary" id="bt_submit_categoria_store" value="<?php if($action == "novo"){echo Yii::t("adminForm", "button_common_submit");}else{echo Yii::t("adminForm", "button_common_update");} ?>"/>
                        </div> 
                        
                        
                     </fieldset>
                     <!-- end row -->
                    <input type="hidden" value="<?php echo $action ?>" id="helper_action"/>
                    <input type="hidden" value="<?php echo $id_album ?>" id="helper_id_categoria"/>
                    <input type="hidden" value="<?php echo $id_subcategoria ?>" id="helper_id_subcategoria"/>
                </form>
            </div>
        </div>
        <!-- end panel -->
       
        <div class="row-fluid">
            <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox_g2.php"; ?>
        </div>
     
    </div>
   
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
<script src="/css/admin/assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="/css/admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/css/admin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="/css/admin/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
<script type="text/javascript" src="/js/admin/categorias.js"></script>
<script src="/css/admin/assets/js/apps.min.js"></script>
<script src="/js/admin/PurplePier.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function () {
        App.init();
        PurplePier.init();
        initLojaCategoriasListeners();
    });
</script>