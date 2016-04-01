<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('chartjs', dirname(__FILE__).'/../extensions/yii-chartjs');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Modular (Alfa)',
	  // user language (for Locale)
    'language'=>'es_CO',
     //language for messages and views
    'sourceLanguage'=>'es_co',
    'theme'=>'blackboot',
     // charset to use
    'charset'=>'utf-8',
	// preloading 'log' component
	'preload'=>array(
		'log',
	    'bootstrap',
	    'chartjs'
	),              
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.cruge.components.*',
		'application.modules.cruge.extensions.crugemailer.*',
		'application.modules.ciudad.models.*',
		'application.modules.afiliado.models.*',
		'application.modules.empleado.models.*',
		'application.modules.empresa.models.*',
		'application.modules.licencia.models.*',
		'application.modules.afiliadoxempresa.models.*',
		'application.modules.etiqueta.models.*',
		'application.ext.YiiMailer.YiiMailer.*',		
		'application.modules.notificacion.models.*',
	),
	

	'modules'=>array(
		'yiiseo'=>array(
			'class'=>'application.modules.yiiseo.YiiseoModule',
			'password'=>'s30m0DU14r', // your default password is 111
		 ),
		'cruge'=>array(
				'tableprefix'=>'modul4r_',

				// para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
				//
				// en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
				// para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
				//
				'availableAuthMethods'=>array('default'),

				'availableAuthModes'=>array('username','email'),

                                // url base para los links de activacion de cuenta de usuario
				'baseUrl'=>'http://www.modular.co/',

				 // NO OLVIDES PONER EN FALSE TRAS INSTALAR
				 'debug'=>false,
				 'rbacSetupEnabled'=>true,
				 'allowUserAlways'=>false,

				// MIENTRAS INSTALAS..PONLO EN: false
				// lee mas abajo respecto a 'Encriptando las claves'
				//
				'useEncryptedPassword' => true,

				// Algoritmo de la función hash que deseas usar
				// Los valores admitidos están en: http://www.php.net/manual/en/function.hash-algos.php
				'hash' => 'md5',

				// Estos tres atributos controlan la redirección del usuario. Solo serán son usados si no
				// hay un filtro de sesion definido (el componente MiSesionCruge), es mejor usar un filtro.
				//  lee en la wiki acerca de:
                                //   "CONTROL AVANZADO DE SESIONES Y EVENTOS DE AUTENTICACION Y SESION"
                                //
				// ejemplo:
				//		'afterLoginUrl'=>array('/site/welcome'),  ( !!! no olvidar el slash inicial / )
				//		'afterLogoutUrl'=>array('/site/page','view'=>'about'),
				//
				'afterLoginUrl'=>array('/site/welcome'),
				'afterLogoutUrl'=>null,
				'afterSessionExpiredUrl'=>null,

				// manejo del layout con cruge.
				//
				'loginLayout'=>'//layouts/column2',
				'registrationLayout'=>'//layouts/column2',
				'activateAccountLayout'=>'//layouts/column2',
				'editProfileLayout'=>'//layouts/column2',
				// en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
				// de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
				// requerirá de un portlet para desplegar un menu con las opciones de administrador.
				//
				'generalUserManagementLayout'=>'ui',

				// permite indicar un array con los nombres de campos personalizados, 
				// incluyendo username y/o email para personalizar la respuesta de una consulta a: 
				// $usuario->getUserDescription(); 
				'userDescriptionFieldsArray'=>array('email'), 

			),
	
		// uncomment the following to enable the Gii tool
		 'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'4dm1ni1str4d0r',
            'ipFilters' => array('127.0.0.1', '192.168.33.10', '10.10.10.9','*'),   // EDIT TO TASTE
            'generatorPaths'=>array(
				'ext.gtc',   // Gii Template Collection
			),
            // 'ipFilters'=>array(...a list of IPs...),
            // 'newFileMode'=>0666,
            // 'newDirMode'=>0777,
        ),      
         'administrador',         
         'afiliado',//Modulo de empresas afiliadas a la empresa
         'afiliadoxempresa',
         'carta',
         'empleado',
         'centromedico',
         'exempleado',
         'cartasgeneradas',
         'empresa',
         'formato',
         'motivo',
         'etiqueta',
         'documento',
         'ciudad',
         'licencia',
         'notificacion',
         'importadores',
         'reportes'
	),
	
	// application components
	'components'=>array(	
		'securityManager'=>array(
            'cryptAlgorithm' => 'rijndael-256',
            'encryptionKey' => 'hpeTdgwdLwPZAmfn3caCNHK6',
        ),
		'session' => array(
			'timeout' => 360,
        ),	
		'chartjs' => array('class' => 'chartjs.components.ChartJs'),
		'uimanager' => array(
				'class' => 'application.components.UiManager',
		),		
		'user'=>array(
				'allowAutoLogin'=>true,
				'class' => 'application.modules.cruge.components.CrugeWebUser',
				'loginUrl' => array('/cruge/ui/login'),
		),
		'authManager' => array(
			//class' => 'application.modules.cruge.components.CrugeAuthManager',
			'class' => 'application.components.ModularCrugeAuthManager',
		),
		'crugemailer'=>array(
			'class' => 'application.modules.cruge.components.CrugeMailer',
			'mailfrom' => 'email-desde-donde-quieres-enviar-los-mensajes@xxxx.com',
			'subjectprefix' => 'Tu Encabezado del asunto - ',
			'debug' => true,
		),
		'format' => array(
			'datetimeFormat'=>"d M, Y h:m:s a",
		),   
		
		'bootstrap' => array(
			'class' => 'application.components.Bootstrap'
		),	
		// uncomment the following to enable URLs in path-format
		 'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
				'gii'=>'gii',
				'gii/<controller:\w+>'=>'gii/<controller>',
				'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>'       
			),
        ),	        	        	        	      
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/source.db',
		),*/
		// uncomment the following to use a MySQL database		
		'db'=>array(
			//'connectionString' => 'mysql:host=desarrollo.co6m76wcpiom.us-west-2.rds.amazonaws.com;dbname=modul4r4ppDB',
			'connectionString' => 'mysql:host=127.0.0.1;dbname=modular',
			'emulatePrepare' => true,
			//'username' => 'jbermudez',
			//'password' => 'R87eub%4YEJjXAT',
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'enableParamLogging'=>true,
			'enableProfiling'=>true,

		),		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				 array(
					'class'=>'CFileLogRoute',
					'levels'=>'contact',
					'categories'=>"system.*",
					'logFile'=>'contactLog.log',
				), 
				 array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, rbac',
				),
				'web'=>array(
					'class'=>'CWebLogRoute',
					'levels'=>'trace, info, error, warning',
					'categories'=>'system.db.*',
					'showInFireBug'=>true //true/falsefirebug only - turn off otherwise
				),				
				// uncomment the following to show log messages on web pages				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'jose.bermudez.correa@gmail.com',
		'appEmail'=>'sistema@modular.com.co',
		'appEmailNombre'=>'Administrador',
		'rutaFormulariosMotivos'=>dirname(dirname(__FILE__)).'uploads/formulariomotivos/',
		'rutaContratos' => dirname(dirname(dirname(__FILE__))).'/uploads/contratos',
		'licenciasPorDefecto' => 14,
		'crearLicenciasGratuitasAtomaticas' => true,
		'tiempoLicenciaPorDefecto' => 366,
		'tiempohorasparaenviarrecordatorioempleado'=>6
	),
);
