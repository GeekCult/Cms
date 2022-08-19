<!-- SOCIAL PANEL UNDER MENU-->
<div class="top-soc hidden-phone">
    <div class="container">
        <div class="row">
            <ul class="social-top">                 
                <?php if($preferences['facebook']){ ?>
                <li class="br_icon_social">
                    <a href="http://www.facebook.com.br/<?php echo $preferences['facebook'] ?>" title="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <?php } ?>
                <?php if($preferences['twitter']){ ?>
                <li class="br_icon_social">
                    <a href="http://www.twitter.com.br/<?php echo $preferences['twitter'] ?>" title="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <?php } ?>
               
                <?php if($preferences['google_plus']){ ?>
                <li class="br_icon_social">
                    <a href="http://plus.google.com.br/<?php echo $preferences['google_plus'] ?>" title="GooglePlus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
                <?php } ?>
                <?php if($preferences['site_map']){ ?>
                <li>
                    <a href="/mapasite" title="">
                        <i class="fa fa-sitemap"></i>
                    </a>
                </li>
                <?php } ?>
                <li>
                    <a href="/contato" title="Contato">
                        <i class="fa fa-envelope"></i>
                    </a>
                </li>
                <li>
                    <a href="/rss" title="RssFeeds">
                        <i class="fa fa-rss"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--END SOCIAL PANEL UNDER MENU-->