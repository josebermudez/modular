<?php

class DocumentoController extends Controller
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
				'actions'=>array('adminEmpleado','adminEmpresaxCentroMedico','admin','delete','descargar','subirArchivo','borrarArchivo','actualizarInformacion'),
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
		$model=new Documento;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Documento']))
		{
			$model->attributes=$_POST['Documento'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->doc_codigo));
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

		if(isset($_POST['Documento']))
		{
			$model->attributes=$_POST['Documento'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->doc_codigo));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Documento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documento']))
			$model->attributes=$_GET['Documento'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdminEmpleado()
	{
		$this->layout='//layouts/nocolumn';
		$model=new Documento('search');
		$model->setAttribute('doc_usu_codigo',$_GET['id']);
		$model->setAttribute('doc_emp_codigo',Yii::app()->user->getState('empresa'));
		//$model->unsetAttributes();  // clear any default values		
		$this->render('adminempleado',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Administrador de los documentos que 
	 * los centros médicos han subido para la empresa
	 * 
	 */
	public function actionAdminEmpresaxCentroMedico()
	{
		$arrCentrosMedicos = array();
		//$this->layout='//layouts/nocolumn';
		$model=new Documento('search');
		$objEmpresa = Empresa::model()->findByPk(Yii::app()->user->getState('empresa'));
		if ($objEmpresa) {
			$arrCentrosMedicos = CHtml::listData($objEmpresa->centrosmedicos(),'afi_codigo','afi_codigo');			
		}
		//$model->setAttribute('doc_usu_codigo',$_GET['id']);
		$model->setAttribute('doc_emp_codigo',Yii::app()->user->getState('empresa'));
		$model->setAttribute('arrAfiliado',$arrCentrosMedicos);
		//$model->unsetAttributes();  // clear any default values		
		$this->render('adminempresaxcentromedico',array(
			'model'=>$model,
			'centrosmedicos'=>$arrCentrosMedicos
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Documento the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Documento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Documento $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax']==='documento-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionSubirArchivo()
	{					
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = '..'.$ds.'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'documentos';
		$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;					
		if (!is_dir($targetPath)) {						
			mkdir($targetPath, 0777);
		}		
		if (!empty($_FILES)) {
			$file = $_FILES['Documento'];
			$tempFile = $file['tmp_name']['doc_archivo'];
		
			$infoArchivo = pathinfo($file['name']['doc_archivo']);		
			$strId = uniqid();	
			$targetFile =  $targetPath.$strId.'.'.$infoArchivo['extension'];
			
			if ( move_uploaded_file($tempFile,$targetFile) ) {								
				$model=new Documento;
				$model->setAttribute("doc_nombre",$targetFile);
				$model->setAttribute("doc_nombrearchivo",$file['name']['doc_archivo']);
				$model->setAttribute("doc_emp_codigo",Yii::app()->user->getState('empresa'));
				$model->setAttribute("doc_usu_codigo",Yii::app()->user->id);
				if(Yii::app()->user->checkAccess('centromedico')) {
					$afiliadoData = Afiliado::model()->findByAttributes(
						array(
							'afi_usr_codigo'=>Yii::app()->user->id
						)
					);
					if ( $afiliadoData ) {
						$model->setAttribute(
							"doc_afi_codigo",
							$afiliadoData->getAttribute('afi_codigo')
						);
					}					
				}									
				if ($model->save()) {
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
		$storeFolder = '..'.$ds.'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'documentos'; 
		if ( !empty($_POST['id']) && !empty($_POST['name'])) {
			$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
			$infoArchivo = pathinfo($_POST['name']);						
			$targetFile =  $targetPath.$_POST['id'].'.'.$infoArchivo['extension'];
			if ($this->_borrarArchivo($targetFile) === true) {	
				
				$model = Documento::model()->findByAttributes(array(
					"doc_nombrearchivo"=>$_POST['name'],
					"doc_nombre"=>$targetFile
				));
				$empresa = $model->getAttribute('doc_emp_codigo');
				if ($empresa !== Yii::app()->user->getState('empresa')) {
					Yii::app()->user->setFlash('error', "<strong>Acceso</strong> denegado!");	
					$this->redirect(array('admin'));
				}
				if ($model) {
						$model->delete();
				}
				$response = 'ok';
			}
		}
		echo $response;		
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionActualizarInformacion($id)
	{
		$model=$this->loadModel($id);
		$empresa = $model->getAttribute('doc_emp_codigo');
		if ($empresa !== Yii::app()->user->getState('empresa')) {
			Yii::app()->user->setFlash('error', "<strong>Acceso</strong> denegado!");	
			$this->redirect(array('admin'));
		}
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Documento'])) {			
			$model->setAttribute('doc_nota',$_POST['Documento']['doc_nota']);						
			if ($model->save(false)) {
				$this->redirect(array('admin'));
			}
		}

		$this->render('actualizarinformacion',array(
			'model'=>$model,
		));
	}
	
	protected function _borrarArchivo($rutaArchivo)
	{		
		if (file_exists($rutaArchivo) === true) {
			unlink($rutaArchivo);			
			return true;
		}
		return false;
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
		$archivo = $model->getAttribute('doc_nombre');
		$empresa = $model->getAttribute('doc_emp_codigo');
		$esSuperAdmin = Yii::app()->user->isSuperAdmin;				
		if (file_exists($archivo) && ( $empresa === Yii::app()->user->getState('empresa') || $esSuperAdmin === true)) {
			$infoArchivo = pathinfo($archivo);
			GDownload::send($archivo,md5($model->getAttribute('doc_nombrearchivo')).'.'.$infoArchivo['extension']);		
		} else {
			echo "No tiene los permisos necesarios para descargar el archivo";
		}    
	}
}
