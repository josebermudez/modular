<?php

class CentromedicoController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','panelGestion'),
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
		$model=new Afiliado;
		
		if(isset($_POST['Afiliado']))
		{
			$model->attributes=$_POST['Afiliado'];
			$model->setAttribute("afi_tipo",Afiliado::CENTROSMEDICOS);
			if($model->save()) {
				$numeroDocumento = $model->getAttribute('afi_numerodocumento');
				//agrega el usuario de inicio de sesion
				$usuarioNuevo = Yii::app()->user->um->createBlankUser();
				$strNombre = $model->getAttribute('afi_nombre');
				$strEmail = $model->getAttribute('afi_email');
				$usuarioNuevo->username = $numeroDocumento;
				
				if (empty($strEmail)) {
					$usuarioNuevo->email = 'usuario_'.$numeroDocumento.'@modular.com.co';
				}								
				// la establece como "Activada"
				Yii::app()->user->um->activateAccount($usuarioNuevo);				
				
				 // verifica para no duplicar
				if(Yii::app()->user->um->loadUser($usuarioNuevo->username) != null)
				{
					$model->addError('emp_numerodocumento',Yii::t('general','El afiliado ya existe'));
				}else{
					
					 // ahora a ponerle una clave
					  Yii::app()->user->um->changePassword(
							$usuarioNuevo,
							$numeroDocumento
					   );
					  // IMPORTANTE: guarda usando el API, la cual hace pasar al usuario 
					  // por el sistema de filtros, por eso user->um->save()
					  // 
					  if(Yii::app()->user->um->save($usuarioNuevo)){
						  
						$role = "centromedico";
						if (Yii::app()->user->rbac->getAuthItem($role) != null) {	
							Yii::app()->user->rbac->assign($role, $usuarioNuevo->getPrimaryKey());
						}  
						  
						$model->setAttribute('afi_usr_codigo',$usuarioNuevo->primaryKey);
						$model->save();
						Yii::app()->user->setFlash('success', '<strong>'.Yii::t('general','Afiliado').'</strong> '.Yii::t('general','agregado').' <strong>'.Yii::t('general','exitosamente').'</strong>!');				
						$this->redirect(array('admin'));
					  }
					  else{
						$errores = CHtml::errorSummary($usuarioNuevo);
						echo Yii::t('general','no se pudo crear el afiliado').": ".$errores;
					 }										
				}											
				Yii::app()->user->setFlash('success', '<strong>'.Yii::t('general','Centro médico').'</strong> '.Yii::t('general','agregado').' <strong>'.Yii::t('general','exitosamente').'</strong>!');				
				$this->redirect(array('admin','id'=>$model->afi_codigo));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Afiliado']))
		{
			$model->attributes=$_POST['Afiliado'];
			$model->setAttribute("afi_tipo",Afiliado::CENTROSMEDICOS);
			if($model->save()) {
				Yii::app()->user->setFlash('success', '<strong>'.Yii::t('general','Centro médico').'</strong> '.Yii::t('general','editado').' <strong>'.Yii::t('general','exitosamente').'</strong>!');				
				$this->redirect(array('admin','id'=>$model->afi_codigo));
			}
		}

		$this->render('update',array(
			'model'=>$model,
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
		foreach( $model->afiliadosxempresas as $relacion ) {
			if ($relacion->getAttribute('axe_emp_codigo') == Yii::app()->user->getState('empresa')) {
				$relacion->delete();
			}
			
		}	
		Yii::app()->user->setFlash('success', '<strong>'.Yii::t('general','Centro medico').'</strong> '.Yii::t('general','eliminado').' <strong>'.Yii::t('general','exitosamente').'</strong>!');				
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Afiliado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Afiliado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Afiliado']))
			$model->attributes=$_GET['Afiliado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionPanelGestion()
	{
		$dataProvider  = array();
		$model = new Afiliado();	
		if(!isset($_POST['Afiliado']['empleado']) && isset($_GET['numerodocumento']) && !empty($_GET['numerodocumento'])) {
			$_POST['Afiliado']['empleado'] = $_GET['numerodocumento'];			
		}
		if (isset($_POST['Afiliado']['empleado']) && !empty($_POST['Afiliado']['empleado'])) {
			$numeroDocumentoEmleado  = $_POST['Afiliado']['empleado'];
			//obtiene los datos del empleado
			$empleado = Empleado::model()->findByAttributes(
				array("emp_numerodocumento"=>$numeroDocumentoEmleado)
			);			
			//obtiene los datos del afiliado
			$afiliado = Afiliado::model()->findByAttributes(
				array("afi_usr_codigo"=>Yii::app()->user->id)
			);			
			if ($empleado && $afiliado) {
				//busca las cartas generadas del empleado para el centro médico
				$criteria=new CDbCriteria;				
				$criteria->compare('cag_emp_codigo',$empleado->getAttribute('emp_codigo'),true);			
				$criteria->compare('axe_afi_codigo',$afiliado->getAttribute('afi_codigo'),true);						
				$criteria->with = array('empresa', 'empresa.centrosmedicos');
				$criteria->together = true;				
				$dataProvider = new CActiveDataProvider(new Cartasgeneradas(), array(
					'criteria'=>$criteria,
				));
				if(count($dataProvider->getItemCount()) === 0) {
					Yii::app()->user->setFlash('info', '<strong>'.Yii::t('general','No').'</strong> '.Yii::t('general','se encontraron cartas generadas para el empleado').'!');				
				}			
			}else{
				Yii::app()->user->setFlash('error', Yii::t('general','El numero de documento').' <strong>'.$numeroDocumentoEmleado.'</strong> '.Yii::t('general','no se encontro en el sistema').'!');				
			}			
		}		
		$this->render('panelgestion',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Afiliado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Afiliado::model()->with('afiliadosxempresas')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Afiliado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='afiliado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
