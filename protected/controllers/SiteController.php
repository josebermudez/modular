<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function init(){
		Yii::app()->theme = 'home';		
		parent::init();
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    $this->layout='//layouts/404';
		if($error=Yii::app()->errorHandler->error)
		{			    	   
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else {			    
				$this->render('error', array('error'=>$error));
			}
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";
				Yii::log($name.$subject.$headers.$model->body,'contact','system.*');
				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Gracias por contactarnos. Le responderemos lo mas pronto posible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionWelcome()
	{		
		Yii::app()->theme = 'blackboot';		
		//obtiene la lista de empresas del usuario
		$arrListaEmpresas=Empleado::misEmpresas();
		if(count($arrListaEmpresas) > 0){
				$primeraEmpresa = $arrListaEmpresas[0];
				Yii::app()->user->setState('empresa',$primeraEmpresa->getAttribute("emp_codigo"));
		}		
		//de acuerdo al perfil lo redirecciona
		if (Yii::app()->user->checkAccess('centromedico')) {
				$this->redirect(Yii::app()->createUrl('/centromedico/centromedico/panelgestion'));
				die;
		}
		
		if (Yii::app()->user->checkAccess('funcionarios')) {
				$this->redirect(Yii::app()->createUrl('/empleado/empleado/admin'));
				die;
		}
		if (Yii::app()->user->checkAccess('empleado')) {
				$this->redirect(Yii::app()->createUrl('/motivo/motivo/panelgestion'));
				die;
		}
		$this->layout='//layouts/column2';
		$this->render('wellcome');
	}
	/**
	 * Método que cambia la empresa actual
	 */
	public function actionCambiarEmpresa($id)
	{
		if (!empty($id) && $this->_esEmpresaDelUsuario($id)) {
			Yii::app()->user->setState('empresa',$id);
		}
		Yii::app()->theme = 'blackboot';
		$this->render('wellcome');
	}
	/**
	 * Verifica si es una empresa del usuario
	 */
	private function _esEmpresaDelUsuario($codigoEmpresa)
	{
		if (Yii::app()->user->isSuperAdmin === false) {
			$arrListaEmpresas=CHtml::listData(Empleado::misEmpresas(),'emp_codigo','emp_codigo');		
			if (!in_array($codigoEmpresa,$arrListaEmpresas)) {
				return false;
			}
		}
		return true;
		
	}
	
}
