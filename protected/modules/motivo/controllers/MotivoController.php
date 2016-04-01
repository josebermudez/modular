<?php

class MotivoController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','panelGestion','generar','pregenerar'),
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
		$model=new Motivo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Motivo']))
		{
			$model->attributes=$_POST['Motivo'];			
            $model->setAttribute('mot_emp_codigo',Yii::app()->user->getState('empresa')); 
            $model->setAttribute('mot_fechacreacion',date('Y-m-d H:i:s'));   
                        
			if($model->save()){				
				//almacena los formatos x motivo
				foreach($model->getAttribute('mot_formatos') as $codigoFormato){
					$formatoxmotivo = new FormatoMotivo();
					$formatoxmotivo->setAttribute('fxm_mot_codigo',$model->getAttribute('mot_codigo'));
					$formatoxmotivo->setAttribute('fxm_for_codigo',$codigoFormato);
					$formatoxmotivo->save();					
				}
				//almacena los roles
				foreach($model->roles as $nombreRol){
					$motivoxrol = new Motivoxrol();					
					$motivoxrol->setAttribute('mxr_mot_codigo',$model->getAttribute('mot_codigo'));
					$motivoxrol->setAttribute('mxr_rol_nombre',$nombreRol);
					$motivoxrol->save();					
				}
				Yii::app()->user->setFlash('success', "<strong>Motivo</strong> agregado <strong>exitosamente</strong>!");				
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

		if(isset($_POST['Motivo']))
		{
			$model->attributes=$_POST['Motivo'];
			if($model->save()) {
				//elimina los formatos
				$this->_eliminarFormatosAsignados($model);				
				foreach($model->getAttribute('mot_formatos') as $codigoFormato){
					$formatoxmotivo = new FormatoMotivo();
					$formatoxmotivo->setAttribute('fxm_mot_codigo',$model->getAttribute('mot_codigo'));
					$formatoxmotivo->setAttribute('fxm_for_codigo',$codigoFormato);
					$formatoxmotivo->save();					
				}
				//elimina los roles
				$this->_eliminarRolesAsignados($model);				
				//almacena los roles
				foreach($model->roles as $nombreRol){
					$motivoxrol = new Motivoxrol();					
					$motivoxrol->setAttribute('mxr_mot_codigo',$model->getAttribute('mot_codigo'));
					$motivoxrol->setAttribute('mxr_rol_nombre',$nombreRol);
					$motivoxrol->save();					
				}
				Yii::app()->user->setFlash('success', "<strong>Motivo</strong> editado <strong>exitosamente</strong>!");				
				$this->redirect(array('admin'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	private function _eliminarFormatosAsignados($model)
	{
		//elimina los formatos
		FormatoMotivo::model()->deleteAll(array('condition' => 'fxm_mot_codigo = :ids', 'params'=> array(':ids' => $model->getAttribute('mot_codigo'))));
	}
	
	private function _eliminarRolesAsignados($model)
	{
		//elimina los formatos
		Motivoxrol::model()->deleteAll(array('condition' => 'mxr_mot_codigo = :ids', 'params'=> array(':ids' => $model->getAttribute('mot_codigo'))));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		//elimina los formatos
		$this->_eliminarFormatosAsignados($model);
		$this->_eliminarRolesAsignados($model);		
		$model->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Motivo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Motivo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Motivo']))
			$model->attributes=$_GET['Motivo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Acción para el panel de gestión de los motivos, a este panel
	 * se ingresa para realizar la descarga de los formatos que 
	 * el usuario tiene acceso
	 * 
	 */
	public function actionPanelGestion()
	{
		$this->layout='//layouts/column1';
		//obtine la lista de motivos que tiene el usuario
		if(!Yii::app()->user->isSuperAdmin){	
			$modelEmpleado = Empleado::model()->findByAttributes(array('emp_usr_codigo'=>Yii::app()->user->id));
		} else {
			$modelEmpleado = new Empleado();	
		}		
		$arrListaMotivos = $modelEmpleado->misMotivos();		
		$this->render('panelgestion',array(
			'arrlistaMotivos'=>$arrListaMotivos,
			'modelEmpleado'=>$modelEmpleado,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Motivo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Motivo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Motivo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='motivo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * PreGenera el formato para la descarga 
	 */
	public function actionPregenerar($formato)
	{
		$strTextoOriginalCarta = "";
		if ( (int)$formato > 0) {
			$formatoModel = Formato::model()->findByAttributes(array("for_codigo"=>$formato));
			if ($formatoModel) {
				$strNombreArchivo = $formatoModel->getAttribute("for_archivo");				
				if (is_file($strNombreArchivo)) {
					
					$strTextoOriginalCarta = file_get_contents(
						$strNombreArchivo
					);
				}				
				if (!empty($strTextoOriginalCarta)) {					
					//obtiene las etiquetas dentro de la carta
					$listaCampos = $this->_obtenerVariablesDentroDePlantilla($strTextoOriginalCarta);
					$valorCampos = $this->_obtenerValoresCampos($listaCampos);	
					$strTexto = $strTextoOriginalCarta;
					
					foreach ($valorCampos as $tabla) {
						foreach($tabla as $campo) {
							$strTexto = str_replace(
								$campo["etiqueta"],
								isset($campo["valor"])?$campo["valor"]:'', 
								$strTexto
							);  
						}
					}
					
					$strTexto = str_replace(
						'#mes#',
						Yii::t("general",date("F")), 
						$strTexto
					);  
					
					$strTexto = str_replace(
						'#anio#',
						date("Y"), 
						$strTexto
					);  
					
					$strTexto = str_replace(
						'#dia#',
						date("d"), 
						$strTexto
					);  
										
					$ds = DIRECTORY_SEPARATOR;
					$strNombreArchivo = uniqid("formato");
					$rutaArchivoRtf = dirname(dirname(__FILE__)) . $ds . 
					'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'cartas_generadas' .$ds.$strNombreArchivo.".rtf";
                    $strRutaArchivoPdf = dirname(dirname(__FILE__)) . $ds . 
					'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'cartas_generadas' .$ds.$strNombreArchivo.".pdf";
					file_put_contents(
						$rutaArchivoRtf, 
						$strTexto
					);					
					//genera el documento rtf
					if(file_exists($rutaArchivoRtf)){
						$output = shell_exec('Ted --saveTo '.$rutaArchivoRtf.' '.$strRutaArchivoPdf );						        					
						//guarda el registro de la carta								
						Yii::app()->getRequest()->sendFile( $strNombreArchivo.".pdf" , file_get_contents( $strRutaArchivoPdf ) );						
					} 		
				}
			}
		}		
	}	
	/**
	 * Genera el formato para la descarga 
	 */
	public function actionGenerar($formato,$motivo)
	{		
		$strTextoOriginalCarta = "";
		if ((int)$formato > 0 && (int)$motivo > 0) {
			$formatoModel = Formato::model()->findByAttributes(array("for_codigo"=>$formato));			
			if ($formatoModel) {
				$strNombreArchivo = $formatoModel->getAttribute("for_archivo");						
				if (is_file($strNombreArchivo)) {
					
					$strTextoOriginalCarta = file_get_contents(
						$strNombreArchivo
					);
				}							
				
				if (!empty($strTextoOriginalCarta)) {					
					//obtiene las etiquetas dentro de la carta
					$listaCampos = $this->_obtenerVariablesDentroDePlantilla($strTextoOriginalCarta);
					$valorCampos = $this->_obtenerValoresCampos($listaCampos);	
					$strTexto = $strTextoOriginalCarta;
					
					foreach ($valorCampos as $tabla) {
						foreach($tabla as $campo) {
							$strTexto = str_replace(
								$campo["etiqueta"],
								isset($campo["valor"])?$campo["valor"]:'', 
								$strTexto
							);  
						}
					}
					
					$strTexto = str_replace(
						'#mes#',
						$this->_utf8ToRtf(Yii::t("general",date("F"))), 
						$strTexto
					);  
					
					$strTexto = str_replace(
						'#anio#',
						date("Y"), 
						$strTexto
					);  
					
					$strTexto = str_replace(
						'#dia#',
						date("d"), 
						$strTexto
					);  
										
					$ds = DIRECTORY_SEPARATOR;
					$strNombreArchivo = uniqid("formato");
					$rutaArchivoRtf = dirname(dirname(__FILE__)) . $ds . 
					'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'cartas_generadas' .$ds.$strNombreArchivo.".rtf";
                    $strRutaArchivoPdf = dirname(dirname(__FILE__)) . $ds . 
					'..'.$ds.'..'.$ds.'..'.$ds.'uploads'.$ds.'cartas_generadas' .$ds.$strNombreArchivo.".pdf";
					file_put_contents(
						$rutaArchivoRtf, 
						$strTexto
					);					
					//genera el documento rtf
					if(file_exists($rutaArchivoRtf)){
						$output = shell_exec('Ted --saveTo '.$rutaArchivoRtf.' '.$strRutaArchivoPdf );
						chmod($strRutaArchivoPdf, 0777);						        					
						//guarda el registro de la carta
						$cartaGenerada = new Cartasgeneradas();
						$cartaGenerada->setAttribute('cag_empr_codigo',Yii::app()->user->getState('empresa'));
						$cartaGenerada->setAttribute('cag_usr_codigo',Yii::app()->user->id);
						$cartaGenerada->setAttribute('cag_archivo',$strRutaArchivoPdf);
						$datosEmpleado = Empleado::getEmpleado(Yii::app()->user->id,Yii::app()->user->getState('empresa'));
						if($datosEmpleado){
							$cartaGenerada->setAttribute('cag_emp_codigo',$datosEmpleado->getAttribute("emp_codigo"));
						}
						$cartaGenerada->setAttribute('cag_mot_codigo',$motivo);
						$cartaGenerada->setAttribute('cag_for_codigo',$formato);
						$cartaGenerada->save();																					
						Yii::app()->getRequest()->sendFile( $strNombreArchivo.".pdf" , file_get_contents( $strRutaArchivoPdf ) );												
					} 		
				}
			}
		}		
	}	
	/**
	 *  Obtiene las variables que se encuentren
	 *  dentro del documento
	 * 
	 */
	private function _obtenerVariablesDentroDePlantilla($strTextoOriginalCarta)
	{		 
		$listaCampos = array();
        $strExpresionVariablesSencillas='/#{1}[a-zA-Z][a-zA-Z]+#{1}/';
        $textoPlantilla = $strTextoOriginalCarta;        
        if (!empty($textoPlantilla)) {            
            $arrVariablesAsignadas = array();
            preg_match_all($strExpresionVariablesSencillas, $textoPlantilla, $arrCoincidenciasSencillas);                                                       
            $arrEtiquetas = array();
            if(is_array($arrCoincidenciasSencillas) && count($arrCoincidenciasSencillas[0]) > 0){                
                foreach($arrCoincidenciasSencillas[0] as $etiqueta){
                    $arrEtiquetas[]="'".$etiqueta."'";
                }                              
            }            
            if (count($arrEtiquetas) > 0) {
                $strEtiquetasConsulta = implode(",", $arrEtiquetas);                
                $criteria=new CDbCriteria;
				$criteria->addCondition("cam_label IN (".$strEtiquetasConsulta.")");				
                $listaCampos = Campo::model()->findAll($criteria);                                              
            }            
        }
        return $listaCampos;
	}
	/**
	 * Método que obtiene los valores para cada una de las etiquetas
	 * de la carta
	 *  
	 */
	private function _obtenerValoresCampos($listaCampos)
	{			
		$arrTablaCampos = array();
		$arrTablaCamposEtiqueta = array();
		$arrValores = array();
		if (count($listaCampos) > 0) {
			foreach($listaCampos as $campo){				
				$tabla = $campo->getAttribute("cam_tablaasociada");
				$columna = $campo->getAttribute("cam_nombre");
				$label = $campo->getAttribute("cam_label");
				$relacion = $campo->getAttribute("cam_relacion");
				if (!isset($arrTablaCampos[$tabla])) {
					$arrTablaCampos[$tabla]=array();
					$arrTablaCamposEtiqueta[$tabla]=array();
				}
				if (!in_array($columna,$arrTablaCampos[$tabla])) {
					$arrTablaCampos[$tabla][]=$columna;
					$arrTablaCamposEtiqueta[$tabla][]=array(
						"etiqueta"=>$label,
						"campo"=>$columna,
						"relacion"=>$relacion,
					);
				}				
			}
		}	
		$informacion = null;			
		foreach($arrTablaCamposEtiqueta as $nombreTabla => $tabla) {
			$listaColumnas = array();
			foreach($tabla as $columnas){
				$listaColumnas[]=$columnas["campo"];
			}
			switch($nombreTabla){
				case 'empleado':
					 $criteria=new CDbCriteria;
					 $criteria->select=implode(",",$listaColumnas);					
					 $datosEmpleado = Empleado::getEmpleado(Yii::app()->user->id,Yii::app()->user->getState('empresa'));
					 if($datosEmpleado) {
						$criteria->compare('emp_codigo',$datosEmpleado->getAttribute("emp_codigo"));					 
					 }else{
						 $criteria->compare('emp_codigo',"ERROR");					 
					 }
					 $informacion = Empleado::model()->find($criteria);						 					 
				break;
				case 'empresa':
					 $criteria=new CDbCriteria;
					 //$criteria->select=implode(",",$listaColumnas);					 
					 $criteria->compare('emp_codigo',Yii::app()->user->getState('empresa'));					 					 
					 $criteria->with = array(			
						'ciudad' => array(  // this is for filtering				
							'together' => true,
						),
				     );					 					 					 
					 $informacion = Empresa::model()->find($criteria);						 										 
				break;
				case 'centromedico':				
					 $criteria=new CDbCriteria;
					 $criteria->select=implode(",",$listaColumnas);					 
					 $criteria->compare('axe_emp_codigo',Yii::app()->user->getState('empresa'));					 					 
					 $criteria->compare('afi_tipo',Afiliado::CENTROSMEDICOS);					 					 
					 $criteria->with = array(			
						'ciudad' => array(  // this is for filtering				
							'together' => true,
						),
						'afiliadosxempresas' => array(  // this is for filtering				
							'together' => true,
						),
				     );						 
					 $informacion = Afiliado::model()->find($criteria);						 										 
				break;
			}
			if ($informacion) {								
				foreach($tabla as $key =>  $columnas){
					if (!empty($columnas["relacion"])) {
						$columnas["valor"]=$this->_utf8ToRtf($informacion->$columnas["relacion"]->getAttribute($columnas["campo"]));						
					} else {
						$columnas["valor"]=$this->_utf8ToRtf($informacion->getAttribute($columnas["campo"]));
					}
					$arrTablaCamposEtiqueta[$nombreTabla][$key]=$columnas;
				}													
			}
		}		
		return $arrTablaCamposEtiqueta;
	}
	
	/**
	 * Función que  permite convertir un texto
	 * en formato válido de un archivo
	 * rtf
	 *
	 * @param string $strTexto
	 * @return string $strConvertido
	 */
	protected function _utf8ToRtf($strTexto) {
		$arrUtf8Patterns = array(
				"[\xC2-\xDF][\x80-\xBF]",
				"[\xE0-\xEF][\x80-\xBF]{2}",
				"[\xF0-\xF4][\x80-\xBF]{3}",
		);
		$strConvertido = $strTexto;
		foreach($arrUtf8Patterns as $pattern) {
			$strConvertido = preg_replace("/($pattern)/e",
				"'\u'.hexdec(bin2hex(mb_convert_encoding('$1', 'UTF-16', 'UTF-8'))).'?'",
				$strConvertido);
		}
		return $strConvertido;
	}
}
