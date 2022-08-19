<div class="container_pan">
    <div class="ctnBody">
        <div class="form-group">
            <h3>BK Bank Dashboard</h3>
            <div class="bug_tracker iframe"></div>
        </div>
        <div class="clear"></div>
        <hr />
        <div class="clear"></div>
        <div class="cflx" style="margin-bottom: 30px;">
            <a href="/admin/bkbank/dashboard" class="btn btn-main">Dashboard</a>
            <a href="/admin/bkbank/listar" class="btn btn-main">Compras</a>
        </div>
        <h3>Triggers</h3>
        <hr />
        <div id="output" class="form-group"></div>
        <div class="clear"></div>
        <button type="button" class="btn btn-success bt_request" data-url="/billet">Get Billets</button>
        <button type="button" class="btn btn-success bt_request" data-url="/billet_generate">Generate Billet</button>
        <button type="button" class="btn btn-success bt_request" data-url="/payments">Get Payments</button>
        
    </div>
    
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
</div>
<script src="/js/admin/BkBank.js"></script>
<script type="text/javascript">BkBank.init();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>