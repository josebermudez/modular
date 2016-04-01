<?php

class ContratoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	private $_strRutaContratos;

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
		return array();		
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
	  * Constructo de la clase 
	  */
	 public function init() {
		 if ( isset(Yii::app()->params['rutaContratos']) ) {
			 $this->_strRutaContratos = Yii::app()->params['rutaContratos'];
		 }        
	 }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Contrato;
		$intCodigoEmpleado = (int)$_GET['empleado'];
		if(isset($_GET['empleado'])) {
			$model->setAttribute('con_emp_id',$intCodigoEmpleado);
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contrato']) && $intCodigoEmpleado > 0) {			
			$model->attributes=$_POST['Contrato'];
			//$model->setAttribute('con_fechacreacion',date('Y-m-d H:i:s'));			
			$model->setAttribute('con_estado','A');						
			$numeroDocumento = $model->getAttribute('emp_numerodocumento');
			$strNombreImagen = CUploadedFile::getInstance($model,'con_documento');
			$model->setAttribute('con_documento',$strNombreImagen);           			
			if ( $model->validate() ) {
				$ds = DIRECTORY_SEPARATOR; 
				$strRutaArchivos = $this->_strRutaContratos.$ds.md5($numeroDocumento);
				$strNombreArchivo = uniqid().'.pdf';
				if (!is_dir($strRutaArchivos)) {					
					mkdir($strRutaArchivos);
				}
				$model->con_documento->saveAs($strRutaArchivos.$ds.$strNombreArchivo);	
				$model->setAttribute('con_documento',$strNombreArchivo);
				$model->setAttribute('con_documentooriginal',$strNombreImagen);
				$model->save();
				$this->redirect(array('admin','id'=>$intCodigoEmpleado));			
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
        if(isset($_POST['Contrato']))
        {
			$intCodigoEmpleado = $model->getAttribute('con_emp_id');
            $_POST['Contrato']['con_documento'] = $model->getAttribute('con_documento');
            $model->attributes=$_POST['Contrato']; 
            $uploadedFile=CUploadedFile::getInstance($model,'con_documento');
            if($model->validate())
            {			                                                
                    if(!empty($uploadedFile))  // check if uploaded file is set or not
                    {
                        $model->setAttribute('con_documento',$uploadedFile);
                        $numeroDocumento = $model->getAttribute('emp_numerodocumento');							
        				$ds = DIRECTORY_SEPARATOR; 
        				$strRutaArchivos = $this->_strRutaContratos.$ds.md5($numeroDocumento);        				
        				if (!file_exists($strRutaArchivos)) {		        				    
        				    mkdir($strRutaArchivos);
        				}        				
        				$strNombreArchivo = uniqid().'.pdf';
        				$model->con_documento->saveAs($strRutaArchivos.$ds.$strNombreArchivo);									
                        if(!empty($uploadedFile))  // check if uploaded file is set or not
                        {                            
                           $uploadedFile->saveAs($strRutaArchivos.$ds.$strNombreArchivo); 
                           $model->setAttribute('con_documento',$strNombreArchivo);
                           $model->setAttribute('con_documentooriginal',$uploadedFile);
                        }
                    }             
                    $model->save();
                $this->redirect(array('admin','id'=>$intCodigoEmpleado));
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
		$usuario = Yii::app()->user->um->loadUserById($model->getAttribute('emp_usr_codigo'), true);		
		$model->delete();
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
		$codigoEmpleado = (int)$_GET['id'];
		$modelEmpleado = Empleado::model()->findByPk($codigoEmpleado);
		if($modelEmpleado) {		
			$model=new Contrato('search');
			$model->setAttribute('con_emp_id',$codigoEmpleado);				
			$this->render('adminempleado',array(
				'model'=>$model,
				'modelEmpleado'=>$modelEmpleado,
			));				
		} else {
			echo Yii::t('general','El empleado no existe');
		}
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
		$model=Contrato::model()->findByPk($id);
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
	
	public function actionTerminar()
	{
		if(isset($_GET['pk']) && isset($_GET['attribute']) && isset($_GET['ajax']) ) {
			$intCodigo = (int)$_GET['pk'];			
			if ($intCodigo > 0) {
				$model = new Contrato();				
				$model = $model->findByPk($intCodigo);				
				if ($model) {
					$model->scenario = 'terminar';
					$esCerrado = (bool)$model->getAttribute('con_terminado');
					if($esCerrado === false) {
						$model->setAttribute('con_terminado',1);
						$model->save();
					}
				}
			}
			
		}		 
	}
	/**
	 * Permite crear un documento
	 * con la notificación de un contrato	 
	 */
	public function crearDocumentoNotificacion()
	{
		if (isset($_GET['id']) ) {			
			$intCodigo = (int)$_GET['id'];
			$objContrato = $this->loadModel($intCodigo);
			if ($objContrato && $objContrato->getAttribute('con_for_id')) {
				
			}
		}
		return true;
	}
	
	public function actionDescargar()
	{	 
	    $codigo = UrlEnDecode::base64UrlDecode($_GET['contrato']);
	    $intCodigo = (int)Yii::app()->getSecurityManager()->decrypt($codigo);	    
	    $objContrato = $this->loadModel($intCodigo);	    
	    if($objContrato && $objContrato->getAttribute('con_documento')) {	        
	        $numeroDocumento = $objContrato->getAttribute('emp_numerodocumento');
	        $ds = DIRECTORY_SEPARATOR;
	        $strRutaArchivos = $this->_strRutaContratos.$ds.md5($numeroDocumento);	        	       
	        Yii::app()->getRequest()->sendFile($objContrato->getAttribute('con_documentooriginal') ,file_get_contents($strRutaArchivos.$ds.$objContrato->getAttribute('con_documento')));
	    }
	    
	}
}
