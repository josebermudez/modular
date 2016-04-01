<?php

class EmpleadoController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST reques
			array('CrugeAccessControlFilter')
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
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{	
		$this->render('view',array(
			'model'=>$this->loadModel(Yii::app()->getSecurityManager()->decrypt(UrlEnDecode::base64UrlDecode($id))),
		));
	}	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionProbando($id)
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
		$model=new Empleado;		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);		
		if(isset($_POST['Empleado']))
		{
			$model->attributes=$_POST['Empleado'];
			$model->setAttribute('emp_emp_codigo',Yii::app()->user->getState('empresa'));
			$model->setAttribute('emp_estado','A');
			$numeroDocumento = $model->getAttribute('emp_numerodocumento');
			
			if ($model->validate()) {
				//agrega el usuario de inicio de sesion
				$usuarioNuevo = Yii::app()->user->um->createBlankUser();
				$strNombre = $model->getAttribute('emp_nombre');
				$strEmail = $model->getAttribute('emp_email');
				$usuarioNuevo->username = $numeroDocumento;
				$usuarioNuevo->email = $strEmail;
				
				if (empty($strEmail)) {
					$usuarioNuevo->email = 'usuario_'.$numeroDocumento.'@modular.com.co';
				}								
				// la establece como "Activa"
				Yii::app()->user->um->activateAccount($usuarioNuevo);				
				
				 // verifica para no duplicar
				if(Yii::app()->user->um->loadUser($usuarioNuevo->username) != null)
				{
					$model->addError('emp_numerodocumento','El empleado ya existe');
				}else{
					
					 // ahora a ponerle una clave
					  Yii::app()->user->um->changePassword(
						$usuarioNuevo,
						$model->getAttribute('emp_numerodocumento')
					   );
					  // IMPORTANTE: guarda usando el API, la cual hace pasar al usuario 
					  // por el sistema de filtros, por eso user->um->save()
					  // 
					  if(Yii::app()->user->um->save($usuarioNuevo)){
						  
						$role = Yii::app()->user->um->getDefaultSystem()->get("defaultroleforregistration");
						if (Yii::app()->user->rbac->getAuthItem($role) != null) {	
							Yii::app()->user->rbac->assign($role, $usuarioNuevo->getPrimaryKey());
						}  						  
						$model->setAttribute('emp_usr_codigo',$usuarioNuevo->primaryKey);
						$model->save();						
						Yii::app()->user->setFlash('success', "<strong>Empleado</strong> agregado <strong>exitosamente</strong>!");				
						$this->redirect(array('admin'));
					  }
					  else{
						$errores = CHtml::errorSummary($usuarioNuevo);
						echo "no se pudo crear el usuario: ".$errores;
					 }										
				}				
			}
		}		
		$this->render('create',array(
			'model'=>$model,
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
		$usuario = Yii::app()->user->um->loadUserById($model->getAttribute('emp_usr_codigo'), true);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Empleado']))
		{
			$model->attributes=$_POST['Empleado'];
			if($model->save()) {
				$strEmail = $model->getAttribute('emp_email');				
				$usuario->email= $strEmail;
				$numeroDocumento = $model->getAttribute('emp_numerodocumento');
				if (empty($strEmail)) {
					$usuario->email = 'usuario_'.$numeroDocumento.'@modular.com.co';
				}	
							
				if(Yii::app()->user->um->save($usuario,'update')) {
					if (isset($_POST['Empleado']['licencia']) && !empty($_POST['Empleado']['licencia'])) {
						$strLicencia = $_POST['Empleado']['licencia'];
						$licencia = Licencia::model()->findByAttributes(array(
							'lic_codigo'=>$strLicencia
						));	
						if ($licencia) {
							$licencia->setAttribute('lic_usr_codigo',$model->getAttribute('emp_usr_codigo'));
							$licencia->save();
						}
					}						
					Yii::app()->user->setFlash('success', Yii::t('general',"<strong>Empleado</strong> editado <strong>exitosamente</strong>!"));				
					$this->redirect(array('admin'));
				}				
					
			}
		}
		$this->render('update',array(
			'model'=>$model,			
			'usuario'=>$usuario,
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
		$codigoUsuario = $model->getAttribute('emp_usr_codigo');
		$codigoEmpresa = $model->getAttribute('emp_emp_codigo');
		$usuario = Yii::app()->user->um->loadUserById($model->getAttribute('emp_usr_codigo'), true);		
		$model->delete();
		$usuario->delete();
		//elimina y crea de nuevo la licencia		
		Yii::app()->user->setFlash('success', Yii::t('general',"<strong>Empleado</strong> eliminado <strong>exitosamente</strong>!"));				
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Empleado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Empleado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Empleado']))
			$model->attributes=$_GET['Empleado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Empleado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Empleado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param Empleado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='empleado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
