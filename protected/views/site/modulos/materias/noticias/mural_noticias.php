<?php if ($materias) { ?>
<div id="mural_noticias_<?php echo $id ?>" class="fullCP">
    <div class="container fullCT">
        <div class="row-fluid">
            <div class="span12">
                <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                    <div class="ctnArtTxt">
                        <h1><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h1>
                        <div class="clear"></div>
                        <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                        <div class="clear"></div>
                        <p class="lead tP"><?php if($texto_1 != ""){echo $texto_1;}else{if(isset($isAdmin))echo C::TEXT_LOREM;} ?></p>
                    </div>
                </div>            
            </div>
       </div>
       <div class="row-fluid">
            <div class="span12">
                <table class="table table-hover">
                    <tbody>
                    <?php $i = 0; foreach($materias as $values){if($i < 4){ ?>
                        <tr>
                            <td>
                                <div class="nowrap small-text"><i class="fa fa-quote-left fa-icon-big cIM"></i></div>
                            </td>
                            <td>
                                <i class="fa fa-comments-alt">&nbsp;</i>
                            </td>
                            <td class="hNews">
                                <a href="/noticias/listar/<?php echo $values['id'] ?>"> 
                                    <strong class='cTM'><?php echo $values['titulo'] ?></strong> 
                                    <div class="italic cDM"><?php echo $values['subtitulo'] ?></div>
                                </a>
                            </td>
                        </tr>
                    <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>