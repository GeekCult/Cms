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
                        'connectionString' => 'mysql:host=localhost;dbname=matrix2;port=8889',
                        'emulatePrepare' => true,
                        'username' => 'root',
                        'password' => 'root',
                        'charset' => 'utf8',
                            
                        ),
                    
                    'db2'=>array(
                            'class' => 'CDbConnection',
                            'connectionString' => 'mysql:host=localhost;dbname=matrix2;port=8889',
                            'emulatePrepare' => true,
                            'username' => 'root',
                            'password' => 'root',
                            'charset' => 'utf8',
                            
                        )
		),

                // application-level parameters that can be accessed
                // using Yii::app()->params['paramName']
                'params'=>array(
                        // this is used in contact page
                        'sessionTimeout' => 3600,
                        
                        'gender'=>'masculino',
                        'ramo' => 'common',
                        'nicho' => 'pf',
                        'id_user' => '1',
                        'pier_layout' => '0',
                        'tecnologia' => '1', //Html5 = 1 ou Comum = 0                        
                        'paginas_avancadas' => '1',
                        'cliente_spring' => 'PurplePier', //nome do cliente em Springloops                       
                        //'directoryUser' => 'ecommerce', remove it
                        'titlePageAdmin' => 'PurplePier Admin',
                        'adminOwner' => 'purplepier',
                        'topo' => 'topo_hostmais',
                        'rodape' => 'rodape_menu_pilha',
                        'email_login' => 'publicidade.exe@gmail.com',
                        'senha_login' => '12345678',
                        'responsivo' => '0',
                        //'pier_produtos' => 1,
                        'token_pp' =>  'Pier2779!hjf@',
                        'serialp' =>  "SHA2('Pier2779!hjf@', 256)",
                ),
	)
);
