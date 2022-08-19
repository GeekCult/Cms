<div class="container_pan">
    <div class="ctnBody">
        <div class="form-group">
            <h3>XML Dashboard</h3>
            <div class="bug_tracker iframe"></div>
        </div>
        <div class="clear"></div>
        <hr />
        <div class="clear"></div>
        <div class="cflx" style="margin-bottom: 30px;">
            <a href="/admin/xml/dashboard" class="btn btn-main">Dashboard</a>
            <a href="/admin/xml/listar" class="btn btn-main">Outros</a>
        </div>
        <h3>Triggers</h3>
        <hr />
        <div id="output" class="form-group"></div>
        <div class="clear"></div>
        <button type="button" class="btn btn-success bt_request" data-url="/get_xml_request">Get Xml</button>
        <button type="button" class="btn btn-success bt_request" data-url="/get_auto_web">Get AutoWeb</button>
        
        
    </div>
    
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
</div>
<script src="/js/admin/Xml.js"></script>
<script type="text/javascript">Xml.init();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>