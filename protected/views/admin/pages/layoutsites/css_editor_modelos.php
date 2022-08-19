<?php include Yii::app()->getBasePath() . '/views/admin/common/header/header_g2.php'; ?>

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">CSS Editor</li>
        <li><a href="javascript"></a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">CSS Editor <small>alterar estilos do seu site</small></h1>
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
                <form action="/" method="POST">
                    <fieldset>
                        <legend>Crie ou edite seus estilos</legend>
                        
                        <div class="form-group">
                            <label for="title">&nbsp;</label>
                            <pre>
/* Define cor do site para laranja */                           
body {
    background: #ff9900;
}


/* Define opções responsivas */ 
@-ms-viewport {
    width: device-width;
}

/* Se a resolução for até 979px de largura aplica os estilos abaixo */ 
@media (min-width: 979px) {
    .brand {margin: -18px -14px; z-index: 1000;}
    .logo_site img, .brand img {height: 110px!important;}    
    .navbar .nav > li > a {padding: 30px 16px!important}    
    .navbar .nav {margin: 0 0px 0 10px!important}
    .mn_posSame {padding-top: 30px!important;}
    .navbar-fixed-top .navbar-inner, .navbar-static-top .navbar-inner {box-shadow: none!important}

}

/* Se a resolução for até 480px (celular) de largura aplica os estilos abaixo */ 
@media (max-width: 480px) {
    .topbar-sidebar {display: none!important}
}
                            </pre>
                        </div>
                        
                        
                    </fieldset>
                    
                    <input type="hidden" id="helper_action" data-js-action="css_editor"/>
                    
                </form>
            </div>
        </div>
        <!-- end panel -->
       
        <div class="row-fluid">
            <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox_g2.php"; ?>
        </div>
     
    </div>
    <!-- end row -->    
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
<script src="/css/admin/assets/js/apps.min.js"></script>
<script src="/js/admin/PurplePier.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    $(document).ready(function () {
        App.init();
        PurplePier.init();
    });
</script>

