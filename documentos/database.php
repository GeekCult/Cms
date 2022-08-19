<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),

                        
                        'db'=>array(
                            'class' => 'CDbConnection',
                            'connectionString' => 'mysql:host=localhost;dbname=fortkarc_db;port=3306',
                            'emulatePrepare' => true,
                            'username' => 'fortkarc_user2',
                            'password' => 'F0x#t%4ç=[%$#er@!p89-u$_vK]',
                            'charset' => 'utf8',
                            
                        ),

                        'db2'=>array(
                            'class' => 'CDbConnection',
                            'connectionString' => 'mysql:host=localhost;dbname=purplepi_manager;port=3306',
                            'emulatePrepare' => true,
                            'username' => 'purplepi_user2',
                            'password' => 'purple465&t%4#T123',
                            'charset' => 'utf8',
                        ),
	
                        'db3'=>array(
                            'class' => 'CDbConnection',
                            'connectionString' => 'mysql:host=localhost;dbname=purplepi_manager;port=3306',
                            'emulatePrepare' => true,
                            'username' => 'purplepi_user2',
                            'password' => 'purple465&t%4#T123',
                            'charset' => 'utf8',
                        ),	
                    
                       'db4'=>array(
                            'class' => 'CDbConnection',
                            'connectionString' => 'mysql:host=localhost;dbname=oficialp_db;port=3306',
                            'emulatePrepare' => true,
                            'username' => 'oficialp_user2',
                            'password' => 'Ppurple465$#',
                            'charset' => 'utf8',
                        ),
                      
                      
		),

                // application-level parameters that can be accessed
                // using Yii::app()->params['paramName']
                'params'=>array(
                        // this is used in contact page
                        'sessionTimeout' => 3600,
                        'userName'=>'fortkar',
                        'gender'=>'masculino',
                        'ramo' => 'common',                               
                    
                        'layerslider' => '0',
                        'frete' => '0',
                        'purple' => '0',
                        'nicho' => 'pf',
                        'id_user' => '1',
                        'contratar' => 'contratar',
                        
                        'local' => '0', //Texturas, PurplePier clientes - acervo
                        'hostname' => 'Locaweb',
                        'login_documents' => 0,
                        
                        'revenda' => 'Plesk11.5',
                        
                        'tecnologia' => '1', //Html5 = 1 ou Comum = 0
                        'paginas_avancadas' => '1',
                        
                        //Dominio que dispara os e-mails
                        'dominio_emkt' => 'e.purplepier.com.br',
                        'produtos_tipos' => '0', //Exibe se � Produtos, imagens, cool
                        'produtos_index' => '1', //Exibe tem index para organizar
                        'produto_orcamento_exibir' => '0',//Exibir botao de pedir or�amento
                        'cliente_spring' => 'PurplePier', //nome do cliente em Springloops
                        'mail_host' => 'mail.purplepier.com.br',
                        'pagseguro' => 0,
                        'boleto_proprio' => 0,
                        //'ssl_brand' => 'comodo',
                        'admin_v2' => 1,
                        'admin_versao' => '2',
                        'admin_content' => 'g2/',
                        //'parceiro' => 'connect',
                        //'parceiro_link' => 'http://www.agenciaconnect.net',
                        'dolar' => 3.65,
                        'site_offline' => 0,
                        'api_secret' => 123,
                        'ssl' => false,
                    
                        //Banners
                        'publicidade_online' => 1,
                    
                        //ERP
                        'erp' => '1',
                        'erp_comissao' => '0',
                        'erp_title_client' => "Clientes",
                        'erp_ramo' => 'common',
                        'televendas' => 0,
                        'img_owner' => 0,
                    
                        'id_hangout' => 'clasi-987',
                        'pan_shadow' => 0,
                        
                    
                        //Associa��o
                        'rotina_bancocurriculos' => 1,
                        'user_keywords' => 1,
                        'load_menu_3' => 0,//Se deve adicionar o menu 3 no menu responsivo
                        'licitacao_email_receivers' => '',
                        'email_cotacao' => 0, //Envia cotação para determinado email
                       
                        //'directoryUser' => 'ecommerce', remove it
                        'titlePageAdmin' => 'PurplePier Admin',
                        'adminOwner' => 'purplepier'
                ),
	)
);
