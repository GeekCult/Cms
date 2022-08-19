<?php if(isset($link1['src']) &&  $link1['src'] != ''){ ?>
<script src="https://apis.google.com/js/platform.js" async defer>{lang: 'pt-BR'}</script>
<div class="row-fluid">

    <div id="google-badge" style="width: 100%; position: relative; display: table">
        <!-- Posicione esta tag onde você deseja que o widget apareça. -->

        <div class="g-page"  data-href="<?php echo $link1['src'] ?>" data-layout="portrait" data-rel="publisher" data-theme="light" data-width="180"></div>
        <!-- Posicione esta tag onde você deseja que o widget apareça. -->

        <!-- Posicione esta tag depois da última tag do widget. -->
        <script type="text/javascript">
          window.___gcfg = {lang: 'pt-BR'};
          
           // just put this in here
            document.getElementsByClassName('g-page')[0].setAttribute('data-width', document.getElementById('google-badge').clientWidth);

          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/platform.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script> 
    </div>
</div>
<?php } ?>