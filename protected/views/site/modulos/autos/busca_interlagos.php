<div id="busca_interlagos_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
      <div class="<?php if((isset($is_container) && !$is_container) || !isset($is_container)) echo 'container' ?> fullCT">
            <?php if($layout_1 == 'common' || $layout_1 == ''){ ?>
            <div class="squarebox">
                <div class="content">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="ctnArtTxtsAll">            
                                <div class="ctnArtTxt tt_stripes">
                                    <?php if($titulo_1 != ""){ ?>
                                    <h2 class="txt_mark mg0 "><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                                    <div class="clear mgB"></div>
                                    <?php } ?>
                                    <?php if($subtitulo_1 != ""){ ?>
                                    <div class="clear"></div>
                                    <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                                    <?php } ?>
                                    <?php if($texto_1 != ""){ ?>
                                    <div class="clear"></div>
                                    <p class="tP"><?php if($texto_1 != ""){echo htmlspecialchars_decode(nl2br($texto_1));}else{if(isset($isAdmin))echo nl2br(C::TEXT_LOREM);} ?></p>
                                    <?php } ?>
                                    <?php if($titulo_1 != "" || $subtitulo_1 != '' || $texto_1 != ''){ ?>
                                    
                                    <?php } ?>
                                </div>
                            </div>            
                        </div>        
                    </div>
                    <div class="row-fluid">
                        <div class="span9">                
                            <div class="row-fluid">
                                <div class="span4">
                                    <label for="">Fabricante</label>
                                    <select name="marca" id="marca" class="span12">
                                        <option value="0">Selecione</option>
                                        <?php foreach($fabricantes as $values){ ?>
                                        <option value="<?php echo $values['id'] ?>" <?php if(isset($fabricante) && ($fabricante == $values['id'])) echo 'selected'; ?>><?php echo $values['nome'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="span4">
                                    <label for="">Categoria</label>                                                    
                                    <select name="" id="" class="span12">
                                        <option value="0">Selecione</option>
                                        <?php foreach($categorias as $values2){ ?>
                                        <option value="<?php echo $values2['id_categoria'] ?>"><?php echo $values2['categoria_label'] ?></option>
                                        <?php } ?>
                                    </select>                                                                                                      
                                </div>
                                <div class="span2">
                                    <label for="">Valor Mín</label>
                                    <select name="valor_min" id="valor_min" class="span12">
                                        <option value="0" <?php if(isset($valor_min) && ($valor_min == '' || $valor_min == '0')) echo 'selected' ?>>R$0,00</option>
                                        <option value="500" <?php if(isset($valor_min) && $valor_min == '500') echo 'selected' ?>>R$500,00</option>
                                        <option value="1000" <?php if(isset($valor_min) && $valor_min == '1000') echo 'selected' ?>>R$1.000,00</option>
                                        <option value="2000" <?php if(isset($valor_min) && $valor_min == '2000') echo 'selected' ?>>R$2.000,00</option>
                                        <option value="3000" <?php if(isset($valor_min) && $valor_min == '3000') echo 'selected' ?>>R$3.000,00</option>
                                    </select>
                                </div>
                                <div class="span2">
                                    <label for="">Valor Máx</label>
                                    <select name="valor_max" id="valor_max" class="span12">
                                        <option value="0" <?php if(isset($valor_min) && $valor_min == '') echo 'selected' ?>>---</option>
                                        <option value="1000" <?php if(isset($valor_max) && $valor_max == '1000') echo 'selected' ?>>R$1.000,00</option>
                                        <option value="2000" <?php if(isset($valor_max) && $valor_max == '2000') echo 'selected' ?>>R$2.000,00</option>
                                        <option value="3000" <?php if(isset($valor_max) && $valor_max == '3000') echo 'selected' ?>>R$3.000,00</option>
                                        <option value="100000" <?php if(isset($valor_max) && $valor_max == '100000') echo 'selected' ?>>R$100.000,00</option>
                                        <option value="200000" <?php if(isset($valor_max) && $valor_max == '200000') echo 'selected' ?>>R$200.000,00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span4">
                                    <label for="">Modelo</label>
                                    <div id="modelo_loader">                                                            
                                        <select name="modelo" id="modelo" class="span12">                                                                
                                            <option value="0" <?php if(isset($modelo)){if($modelo == 0) echo 'selected';} ?>><?php if(isset($modelo) && $modelo == '0'){ ?>---<?php } ?><?php if(!isset($modelo)){ ?>Selecione Fabricante<?php } ?></option>
                                            <?php if(isset($modelo_veiculos)){  foreach ($modelo_veiculos as $values){  ?>
                                            <option value="<?php echo $values['id'] ?>" <?php if(isset($modelo)){if($values['id'] == $modelo) echo 'selected';} ?>><?php echo $values['nome'] ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="span4">
                                    <label for="">Combustível</label>
                                    <select name="combustivel" id="combustivel" class="span12">
                                        <option value="0" <?php if(isset($combustivel) && $combustivel == '')  echo 'selected' ?>>Selecione</option>
                                        <option value="1" <?php if(isset($combustivel) && $combustivel == '1') echo 'selected' ?>>Gasolina</option>
                                        <option value="2" <?php if(isset($combustivel) && $combustivel == '2') echo 'selected' ?>>Álcool</option>
                                        <option value="3" <?php if(isset($combustivel) && $combustivel == '3') echo 'selected' ?>>Flex</option>
                                        <option value="4" <?php if(isset($combustivel) && $combustivel == '4') echo 'selected' ?>>Diesel</option>
                                        <option value="5" <?php if(isset($combustivel) && $combustivel == '5') echo 'selected' ?>>Híbrido</option>
                                        <option value="0" <?php if(isset($combustivel) && $combustivel == '6') echo 'selected' ?>>Indiferente</option>
                                    </select>
                                </div>
                                <div class="span2">
                                    <label for="">Ano Inicial</label>
                                    <select name="ano_inicial" id="ano_inicial" class="span12">
                                        <option value="2000" <?php if(isset($ano_inicial) && $ano_inicial == '2000') echo 'selected' ?>>2000</option>
                                        <option value="2001" <?php if(isset($ano_inicial) && $ano_inicial == '2001') echo 'selected' ?>>2001</option>
                                        <option value="2002" <?php if(isset($ano_inicial) && $ano_inicial == '2002') echo 'selected' ?>>2002</option>
                                        <option value="2003" <?php if(isset($ano_inicial) && $ano_inicial == '2003') echo 'selected' ?>>2003</option>
                                        <option value="2004" <?php if(isset($ano_inicial) && $ano_inicial == '2004') echo 'selected' ?>>2004</option>
                                        <option value="2005" <?php if(isset($ano_inicial) && $ano_inicial == '2005') echo 'selected' ?>>2005</option>
                                        <option value="2006" <?php if(isset($ano_inicial) && $ano_inicial == '2006') echo 'selected' ?>>2006</option>
                                        <option value="2007" <?php if(isset($ano_inicial) && ($ano_inicial == '2007' || $ano_inicial == '')) echo 'selected' ?>>2007</option>
                                        <option value="2008" <?php if(isset($ano_inicial) && $ano_inicial == '2008') echo 'selected' ?>>2008</option>
                                        <option value="2009" <?php if(isset($ano_inicial) && $ano_inicial == '2009') echo 'selected' ?>>2009</option>
                                        <option value="2010" <?php if(isset($ano_inicial) && $ano_inicial == '2010') echo 'selected' ?>>2010</option>
                                        <option value="2011" <?php if(isset($ano_inicial) && $ano_inicial == '2011') echo 'selected' ?>>2011</option>
                                        <option value="2012" <?php if(isset($ano_inicial) && $ano_inicial == '2012') echo 'selected' ?>>2012</option>
                                        <option value="2013" <?php if(isset($ano_inicial) && $ano_inicial == '2013') echo 'selected' ?>>2013</option>
                                        <option value="2014" <?php if(isset($ano_inicial) && $ano_inicial == '2014') echo 'selected' ?>>2014</option>
                                        <option value="2015" <?php if(isset($ano_inicial) && $ano_inicial == '2015') echo 'selected' ?>>2015</option>
                                    </select>
                                </div>
                                <div class="span2">
                                    <label for="">Ano Final</label>
                                    <select name="ano_final" id="ano_final" class="span12">
                                        <option value="2000" <?php if(isset($ano_final) && $ano_final == '2000') echo 'selected' ?>>2000</option>
                                        <option value="2001" <?php if(isset($ano_final) && $ano_final == '2001') echo 'selected' ?>>2001</option>
                                        <option value="2002" <?php if(isset($ano_final) && $ano_final == '2002') echo 'selected' ?>>2002</option>
                                        <option value="2003" <?php if(isset($ano_final) && $ano_final == '2003') echo 'selected' ?>>2003</option>
                                        <option value="2004" <?php if(isset($ano_final) && $ano_final == '2004') echo 'selected' ?>>2004</option>
                                        <option value="2005" <?php if(isset($ano_final) && $ano_final == '2005') echo 'selected' ?>>2005</option>
                                        <option value="2006" <?php if(isset($ano_final) && $ano_final == '2006') echo 'selected' ?>>2006</option>
                                        <option value="2007" <?php if(isset($ano_final) && $ano_final == '2007') echo 'selected' ?>>2007</option>
                                        <option value="2008" <?php if(isset($ano_final) && $ano_final == '2008') echo 'selected' ?>>2008</option>
                                        <option value="2009" <?php if(isset($ano_final) && $ano_final == '2009') echo 'selected' ?>>2009</option>
                                        <option value="2010" <?php if(isset($ano_final) && $ano_final == '2010') echo 'selected' ?>>2010</option>
                                        <option value="2011" <?php if(isset($ano_final) && $ano_final == '2011') echo 'selected' ?>>2011</option>
                                        <option value="2012" <?php if(isset($ano_final) && $ano_final == '2012') echo 'selected' ?>>2012</option>
                                        <option value="2013" <?php if(isset($ano_final) && $ano_final == '2013') echo 'selected' ?>>2013</option>
                                        <option value="2014" <?php if(isset($ano_final) && $ano_final == '2014') echo 'selected' ?>>2014</option>
                                        <option value="2015" <?php if(isset($ano_final) && $ano_final == '2015') echo 'selected' ?>>2015</option>
                                        <option value="2016" <?php if(isset($ano_final) && ($ano_final == '2016' || $ano_final == '')) echo 'selected' ?>>2016</option>                                                            
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span3 center">
                            <label for="">&nbsp;</label>
                            <button  class="btn btn-main btn-xxlarge mgT">
                                Buscar&nbsp;
                                <i class="fa fa-search"></i>
                            </button>
                            
                        </div>            
                    </div> 
                </div>
            </div>
                     
            
            <?php } ?>
        </div>
    </div>
</div>