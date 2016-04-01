<?php
class EmpresaController extends Controller
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
		$model=new Empresa;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Empresa']))
		{
			$model->attributes=$_POST['Empresa'];
			$model->setAttribute("emp_usr_codigo",Yii::app()->user->id);
			if($model->save()) {
			    //actualiza el estado de la licencia
			    $licencia = Licencia::model()->findByAttributes(array(
					'lic_codigo'=>$model->getAttribute('emp_lic_codigo')
				));	
			    if($licencia) {
			        $licencia->setAttribute('lic_estaenuso', 1);
			        $licencia->setAttribute('lic_fechaedicion', date('Y-m-d H:i:s'));
			        $licencia->setAttribute('lic_emp_codigo', $model->getAttribute('emp_codigo'));
			        
			        $licencia->save();
			    }			    
				if(!is_array($model->getAttribute('centrosmedicos')))
				{
					$model->setAttribute('centrosmedicos',array($model->getAttribute('centrosmedicos')));
				}
				//almacena los centros médicos
				foreach($model->getAttribute('centrosmedicos') as $codigoAfiliado){
					if((int)$codigoAfiliado > 0) {
						$afiliadoxempresa = new Afiliadoxempresa();
						$afiliadoxempresa->setAttribute('axe_emp_codigo',$model->getAttribute('emp_codigo'));
						$afiliadoxempresa->setAttribute('axe_afi_codigo',$codigoAfiliado);
						$afiliadoxempresa->save();		
					}			
				}
				if ((bool)Yii::app()->params['crearLicenciasGratuitasAtomaticas'] === true) {
					Yii::app()->user->setFlash('success', Yii::t('general',"<strong>Las licencias iniciales</strong> han sido creadas <strong> exitosamente</strong>!"));				
				}
				Yii::app()->user->setFlash('success', Yii::t('general',"<strong>Empresa</strong> agregada <strong>exitosamente</strong>!"));				
				$this->redirect(array('admin'));
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

		if(isset($_POST['Empresa']))
		{
			$model->attributes=$_POST['Empresa'];
			$model->setAttribute("emp_usr_codigo",Yii::app()->user->id);
			if($model->save()) {
				//elimina los formatos
				$this->_eliminarCentrosMedicosAsignados($model);	
				if(!is_array($model->getAttribute('centrosmedicos')))
				{
					$model->setAttribute('centrosmedicos',array($model->getAttribute('centrosmedicos')));
				}
				//almacena los centros médicos
				foreach($model->getAttribute('centrosmedicos') as $codigoAfiliado){
					if((int)$codigoAfiliado > 0) {
						$afiliadoxempresa = new Afiliadoxempresa();
						$afiliadoxempresa->setAttribute('axe_emp_codigo',$model->getAttribute('emp_codigo'));
						$afiliadoxempresa->setAttribute('axe_afi_codigo',$codigoAfiliado);
						$afiliadoxempresa->save();		
					}			
				}
				Yii::app()->user->setFlash('success', "<strong>Empresa</strong> editada <strong>exitosamente</strong>!");				
				$this->redirect(array('admin','id'=>$model->emp_codigo));				
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	private function _eliminarCentrosMedicosAsignados($model)
	{
		//elimina los formatos
		Afiliadoxempresa::model()->deleteAll(array('condition' => 'axe_emp_codigo = :ids', 'params'=> array(':ids' => $model->getAttribute('emp_codigo'))));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$empresa = $this->loadModel($id);
		$empresa->setAttribute('epm_estado', 'C');
		$empresa->save();		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Empresa');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Empresa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Empresa']))
			$model->attributes=$_GET['Empresa'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Empresa the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Empresa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Empresa $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='empresa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
