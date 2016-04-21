<?php

class FormatoController extends Controller
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
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Formato;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Formato']))
		{
			$model->attributes=$_POST['Formato'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', "<strong>Formato</strong> agregado <strong>exitosamente</strong>!");				
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
		$empresa = $model->getAttribute('for_emp_codigo');
		if ($empresa !== Yii::app()->user->getState('empresa')) {
			Yii::app()->user->setFlash('error', "<strong>Acceso</strong> denegado!");	
			$this->redirect(array('admin'));
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Formato']))
		{
			$model->attributes=$_POST['Formato'];
			if($model->save()) {
				Yii::app()->user->setFlash('success', "<strong>Formato</strong> editado <strong>exitosamente</strong>!");				
				$this->redirect(array('view','id'=>$model->for_codigo));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionDescargar($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$archivo = $model->getAttribute('for_archivo');
		$empresa = $model->getAttribute('for_emp_codigo');
		if (file_exists($archivo) && $empresa === Yii::app()->user->getState('empresa')) {
			$infoArchivo = pathinfo($archivo);
			GDownload::send($archivo,md5($model->getAttribute('for_nombrearchivo')).'.'.$infoArchivo['extension']);		
		}    
	}
	
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionActualizarInformacion($id)
	{
		$model=$this->loadModel($id);
		$empresa = $model->getAttribute('for_emp_codigo');
		if ($empresa !== Yii::app()->user->getState('empresa')) {
			Yii::app()->user->setFlash('error', "<strong>Acceso</strong> denegado!");	
			$this->redirect(array('admin'));
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Formato']))
		{			
			$model->setAttribute('for_nombre',$_POST['Formato']['for_nombre']);			
			$model->setAttribute('for_archivo',$model->getAttribute('for_archivo'));						
			if($model->save(false))
				$this->redirect(array('admin'));
		}

		$this->render('actualizarinformacion',array(
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
		$empresa = $model->getAttribute('for_emp_codigo');
		if ($empresa !== Yii::app()->user->getState('empresa')) {
			Yii::app()->user->setFlash('error', "<strong>Acceso</strong> denegado!");	
			$this->redirect(array('admin'));
		}
		$rutaArchivo = $model->getAttribute("for_archivo");
		//elimina los formatosxmotivo
		FormatoMotivo::model()->deleteAll("fxm_for_codigo=".$model->getAttribute("for_codigo"));
		if($model && $model->delete()){
			$this->_borrarArchivo($rutaArchivo);
		}
		Yii::app()->user->setFlash('success', "<strong>Formato</strong> eliminado <strong>exitosamente</strong>!");				
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Formato');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Formato('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Formato']))
			$model->attributes=$_GET['Formato'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Formato the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Formato::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Formato $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSubirArchivo()
	{				
	
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = '..'.$ds.'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'formatos'; 
		if (!empty($_FILES)) {
			$file = $_FILES['Formato'];
			$tempFile = $file['tmp_name']['for_archivo'];
			$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;						
			$infoArchivo = pathinfo($file['name']['for_archivo']);		
			$strId = uniqid();	
			$targetFile =  $targetPath.$strId.'.'.$infoArchivo['extension'];
			if (file_exists($targetPath) == false) {
			    mkdir($targetPath);
			} 
			if( move_uploaded_file($tempFile,$targetFile) )
			{								
				$model=new Formato;
				$model->setAttribute("for_archivo",$targetFile);
				$model->setAttribute("for_nombrearchivo",$file['name']['for_archivo']);
				$model->setAttribute("for_emp_codigo",Yii::app()->user->getState('empresa'));
				$model->setAttribute("for_usu_codigo",Yii::app()->user->id);
				$model->setAttribute("for_archivovalido",true);
				//verifica que se permita convertir a pdf				
				$strNombreArchivo = uniqid("eliminar");
				$strRutaArchivoPdf = dirname(dirname(__FILE__)) . $ds . 
					'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'cartas_generadas' .$ds.$strNombreArchivo.".pdf";
				$model->scenario='subidaarchivo';
				$output = shell_exec('Ted --saveTo '.$targetFile.' '.$strRutaArchivoPdf );				
				if (file_exists($strRutaArchivoPdf) === false) {					
					$model->setAttribute("for_archivovalido",false);
				}else{
					unlink($strRutaArchivoPdf);
				}
				if($model->save()) {
					echo $strId;	
					die;	 
				}				
				$this->render('create',array(
					'model'=>$model,
				));
			}			
		}
		echo "";
	}
	
	public function actionBorrarArchivo()
	{		
		$response = "";
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = '..'.$ds.'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'formatos'; 
		if( !empty($_POST['id']) && !empty($_POST['name'])) {
			$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
			$infoArchivo = pathinfo($_POST['name']);						
			$targetFile =  $targetPath.$_POST['id'].'.'.$infoArchivo['extension'];
			if ($this->_borrarArchivo($targetFile) === true) {	
				
				$model = Formato::model()->findByAttributes(array(
					"for_nombrearchivo"=>$_POST['name'],
					"for_archivo"=>$targetFile
				));
				$empresa = $model->getAttribute('for_emp_codigo');
				if ($empresa !== Yii::app()->user->getState('empresa')) {
					Yii::app()->user->setFlash('error', "<strong>Acceso</strong> denegado!");	
					$this->redirect(array('admin'));
				}
				if($model){
						$model->delete();
				}
				$response = 'ok';
			}
		}
		echo $response;		
	}
	
	protected function _borrarArchivo($rutaArchivo)
	{		
		if (file_exists($rutaArchivo) === true) {
			unlink($rutaArchivo);			
			return true;
		}
		return false;
	}
}
