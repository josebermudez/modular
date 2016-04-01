<?php

class ExempleadoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Exempleado;
		$modelEmpleado =new Empleado;
		$noExisteEmpleado = false;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Exempleado']))
		{
			$saveModel = false;
			$model->attributes=$_POST['Exempleado'];
			$modelEmpleado->attributes=$_POST['Empleado'];
			$modelEmpleado->setAttribute('emp_emp_codigo',Yii::app()->user->getState('empresa'));
			//verifica si el empleado existe para la empresa actual
			$datosEmpleado = $this->loadModelEmpleado($modelEmpleado->getAttribute('emp_numerodocumento'));
			
			if ($datosEmpleado !== null) {
				$model->setAttribute('exm_emp_codigo',$modelEmpleado->getAttribute('emp_codigo'));
				$saveModel = true;			
				//verifica si el exempleado existe
				$datosExempleado = Exempleado::model()->findByAttributes(
					array('exm_emp_codigo'=>$datosEmpleado->getAttribute('emp_codigo'))
				);
				if($datosExempleado !== null){					
					$modelEmpleado->addError('emp_numerodocumento','El ex-empleado ya existe para esta empresa');
					$saveModel = false;
				}
			}else{
				$noExisteEmpleado = true;
				//agrega el empleado
				//agrega el usuario de inicio de sesion
				$numeroDocumento = $modelEmpleado->getAttribute('emp_numerodocumento');
				$usuarioNuevo = Yii::app()->user->um->createBlankUser();
				$strNombre = $modelEmpleado->getAttribute('emp_nombre');
				$strEmail = $modelEmpleado->getAttribute('emp_email');
				$usuarioNuevo->username = $numeroDocumento;
				
				if (empty($strEmail)) {
					$usuarioNuevo->email = 'usuario_'.$numeroDocumento.'@modular.com.co';
				}								
				// la establece como "Activada"
				Yii::app()->user->um->activateAccount($usuarioNuevo);				
				 // verifica para no duplicar
				if(Yii::app()->user->um->loadUser($usuarioNuevo->username) === null)
				{
					 // ahora a ponerle una clave
					  Yii::app()->user->um->changePassword(
						$usuarioNuevo,
						$numeroDocumento
					   );
					  // IMPORTANTE: guarda usando el API, la cual hace pasar al usuario 
					  // por el sistema de filtros, por eso user->um->save()					  
					  if(Yii::app()->user->um->save($usuarioNuevo)){
							$modelEmpleado->setAttribute('emp_usr_codigo',$usuarioNuevo->primaryKey);
							if ($modelEmpleado->save()) {
								$model->setAttribute('exm_emp_codigo',$modelEmpleado->getAttribute('emp_codigo'));							
								$saveModel = true;
							}							
					  }
				}							
			}
			if ($saveModel && $model->save()) {
				Yii::app()->user->setFlash('success', "<strong>Ex-empleado</strong> agregado <strong>exitosamente</strong>!");				
				$this->redirect(array('admin'));
			}
							
		}
		$this->render('create',array(
			'model'=>$model,
			'noExisteEmpleado' => $noExisteEmpleado,
			'modelEmpleado'=>$modelEmpleado,			 
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$modelEmpleado = Empleado::model()->findByPk($model->getAttribute('exm_emp_codigo'));	
		$usuario = Yii::app()->user->um->loadUserById($modelEmpleado->getAttribute('emp_usr_codigo'), true);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Exempleado']))
		{
			$modelEmpleado->attributes=$_POST['Empleado'];
			$model->attributes=$_POST['Exempleado'];
			if($model->save() && $modelEmpleado->save()) {
				
				$strEmail = $modelEmpleado->getAttribute('emp_email');				
				$usuario->email= $strEmail;
				$numeroDocumento = $modelEmpleado->getAttribute('emp_numerodocumento');
				if (empty($strEmail)) {
					$usuario->email = 'usuario_'.$numeroDocumento.'@modular.com.co';
				}							
				if(Yii::app()->user->um->save($usuario,'update')) {					
					Yii::app()->user->setFlash('success', "<strong>Ex-empleado</strong> editado <strong>exitosamente</strong>!");				
					$this->redirect(array('admin'));
				}	
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'modelEmpleado'=>$modelEmpleado,		
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$modelEmpleado = Empleado::model()->findByPk($model->getAttribute('exm_emp_codigo'));	
		$usuario = Yii::app()->user->um->loadUserById($modelEmpleado->getAttribute('emp_usr_codigo'), true);				
		$model->delete();
		$modelEmpleado->delete();
		$usuario->delete();
		Yii::app()->user->setFlash('success', "<strong>Empleado</strong> eliminado <strong>exitosamente</strong>!");				
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Exempleado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Exempleado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Exempleado']))
			$model->attributes=$_GET['Exempleado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Exempleado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Exempleado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Exempleado the loaded model
	 * @throws CHttpException
	 */
	public function loadModelEmpleado($id)
	{
		$model=Empleado::model()->findByAttributes(
			array(
				'emp_numerodocumento'=>$id,
				'emp_emp_codigo'=>Yii::app()->user->getState('empresa')
			)
		);		
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Exempleado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='exempleado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
