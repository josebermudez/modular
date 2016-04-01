<?php

/**
 * This is the model class for table "empleado".
 *
 * The followings are the available columns in table 'empleado':
 * @property integer $emp_codigo
 * @property string $emp_nombre
 * @property string $emp_numerodocumento
 * @property string $emp_tipodocumento
 * @property string $emp_direccion
 * @property string $emp_telefonofijo
 * @property string $emp_telefonomovil
 * @property string $emp_estado
 * @property integer $emp_emp_codigo
 */
class Empleado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empleado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_emp_codigo', 'numerical', 'integerOnly'=>true),
			//array('emp_email', 'email'),
			array('emp_numerodocumento', 'required'),
			array('emp_email,emp_nombre, emp_numerodocumento, emp_jefe_id, emp_tipodocumento, emp_direccion, emp_esjefe, emp_telefonofijo, emp_telefonomovil, emp_estado, emp_emp_codigo', 'safe'),
			array('emp_email,emp_nombre, emp_numerodocumento, emp_direccion, emp_telefonomovil, emp_estado, emp_emp_codigo',  'required', 'on'=>'completardatos'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_codigo, emp_nombre, emp_numerodocumento, emp_tipodocumento, emp_direccion, emp_telefonofijo, emp_telefonomovil, emp_estado, emp_emp_codigo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usuario' => array(self::BELONGS_TO, 'CrugeStoredUser', 'emp_usr_codigo'),
			'empresa' => array(self::BELONGS_TO, 'Empresa', 'emp_emp_codigo'),
			'exempleado' => array(self::HAS_ONE, 'Exempleado', 'exm_emp_codigo')					
		);
	}
	
	public static function misEmpresas(){
		$result = array();
		if(!Yii::app()->user->isSuperAdmin){			
			
			$list = self::model()->findAllByAttributes(array('emp_usr_codigo'=>Yii::app()->user->id));		
			if(isset($list))
			foreach($list as $empleadoInst) {
				$result[] = $empleadoInst->empresa;
			}
		}else {
			$empresa = new Empresa();
			$result = $empresa->findAll();
		}
		
		return $result;
	}
	
	public static function getEmpleado($iduser,$idempresa){
		return Empleado::model()->findByAttributes(array('emp_usr_codigo'=>$iduser,'emp_emp_codigo'=>$idempresa));
	}
	public function getEmpresa(){
		return $this->idempresa0;
	}
	/**
	 * Obtiene el nombre de la empresa actual 
	 */
	public static function getNombreEmpresaActual() {
		$modelEmpresa = Empresa::model()->findByAttributes(
			array(
				'emp_codigo' => Yii::app()->user->getState('empresa')
			)
		);
		if ($modelEmpresa) {
			return $modelEmpresa->getAttribute('emp_nombre');
		}
		return '';
	}	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'emp_codigo' => Yii::t('general','Codigo'),
			'emp_nombre' => Yii::t('general','Nombres y apellidos'),
			'emp_numerodocumento' => Yii::t('general','Numero documento'),
			'emp_tipodocumento' => Yii::t('general','Tipo documento'),
			'emp_direccion' => Yii::t('general','Direccion'),
			'emp_telefonofijo' => Yii::t('general','Telefono fijo'),
			'emp_telefonomovil' => Yii::t('general','Telefono movil'),
			'emp_estado' => Yii::t('general','Estado'),
			'emp_emp_codigo' => Yii::t('general','Codigo empresa'),
			'emp_email' => Yii::t('general','Correo electronico')			
		);
	}
	
	
	public static function misMotivos(){
		$result = array();			
		$arrMotivosValidos = array();
		if(!Yii::app()->user->isSuperAdmin){			
			//obtiene la lista de motivos de la empresa
			$motivosList = Motivo::model()->with('formatos')->findAllByAttributes(
				array(
					'mot_emp_codigo'=>Yii::app()->user->getState('empresa')
				)
			);
			$arrCodigosMotivos=CHtml::listData($motivosList, 'mot_codigo', 'mot_codigo');			
			//obtiene los motivosxrol de la empresa
			if (count($arrCodigosMotivos)) {
				$motivosxrolList = Motivoxrol::model()->with('motivo','motivo.formatos')->findAllByAttributes(
					array(
						'mxr_mot_codigo'=>array_keys($arrCodigosMotivos)
					)
				);				
				//verifica los motivos a los que tiene acceso el usuario
				foreach($motivosxrolList as $motivorol){	
					 
					 if(Yii::app()->user->checkAccess($motivorol->getAttribute('mxr_rol_nombre'))) {						 
						 $arrMotivosValidos[]=$motivorol->motivo;						 
					 }
				}					
			}							
		}else {
			$arrMotivosValidos = Motivo::model()->with('formatos')->findAll();				
		}		
		return $arrMotivosValidos;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('emp_codigo',$this->emp_codigo);
		$criteria->compare('emp_nombre',$this->emp_nombre,true);
		$criteria->compare('emp_numerodocumento',$this->emp_numerodocumento,true);
		$criteria->compare('emp_tipodocumento',$this->emp_tipodocumento,true);
		$criteria->compare('emp_direccion',$this->emp_direccion,true);
		$criteria->compare('emp_telefonofijo',$this->emp_telefonofijo,true);
		$criteria->compare('emp_telefonomovil',$this->emp_telefonomovil,true);
		$criteria->compare('emp_estado',$this->emp_estado,true);
		$criteria->compare('emp_emp_codigo',Yii::app()->user->getState('empresa'),true); 
		$criteria->order = 'emp_codigo DESC'; 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empleado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	 /**
	 * Se ejecuta despues de guardar
	 */ 
	protected function afterSave(){							
		//asigna una licencia por defecto
		if ($this->isNewRecord) {
			$intCodigoEmpresa = (int)$this->getAttribute('emp_emp_codigo');
			$criteria = new CDbCriteria;
			$criteria->compare('lic_emp_codigo','=:'.$intCodigoEmpresa); 
			$criteria->compare('lic_activa','=:1'); 
			$criteria->compare('lic_usr_codigo','=:0'); 
			$criteria->compare('lic_fechavencimiento','>=:'.date('Y-m-d H:i:s')); 									
			$licencia = Licencia::model()->find($criteria);	
			if ($licencia) {
				//$licencia->setAttribute('lic_fechacreacion',date('Y-m-d H:i:s'));
				$licencia->setAttribute('lic_usr_codigo',$this->getAttribute('emp_usr_codigo'));
				$licencia->save();
			}			
		}							
		parent::afterSave();
		return true;		
	}
}
