<?php

/**
 * This is the model class for table "empresa".
 *
 * The followings are the available columns in table 'empresa':
 * @property string $emp_nombre
 * @property integer $emp_codigo
 * @property string $emp_direccion
 * @property string $emp_telefono
 */
class Empresa extends CActiveRecord
{
	public $centrosmedicos;
	public $exempleados;
	
		
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'empresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_nombre, emp_lic_codigo, emp_direccion, emp_ciu_codigo, emp_email', 'required'),
			array('emp_telefono,epm_estado,emp_usr_codigo,centrosmedicos,emp_jefepersonal', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_nombre, emp_codigo, emp_direccion, emp_telefono', 'safe', 'on'=>'search'),
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
			'empleados' => array(self::HAS_MANY, 'Empleado', 'emp_emp_codigo'),	
			'jefepersonal' => array(self::BELONGS_TO, 'JefePersonal', 'emp_jefepersonal',),			
			'ciudad' => array(self::BELONGS_TO, 'Ciudad', 'emp_ciu_codigo'),
			'centrosmedicos'=>array(
				self::MANY_MANY, 'Afiliado', 
				'afiliadoxempresa(axe_emp_codigo, axe_afi_codigo)',		
				'condition'=> 'afi_tipo = :type',
				'params' => array(':type' => Afiliado::CENTROSMEDICOS)
			),
	        'licencia' => array(self::HAS_ONE, 'Licencia', 'emp_lic_codigo','condition'=>'lic_activa = 1'),
		);
		
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'emp_nombre' => Yii::t('general','Nombre empresa'),
			'emp_codigo' => Yii::t('general','Código'),
			'emp_direccion' => Yii::t('general','Dirección'),
			'emp_telefono' => Yii::t('general','Telefono'),
			'emp_ciu_codigo' => Yii::t('general','Ciudad'),
			'centrosmedicos'=>Yii::t('general','Centros médicos'),
			'empleados'=>Yii::t('general','Empleados'),
			'exempleados'=>Yii::t('general','Exempleados'),
			'emp_email'=>Yii::t('general','E-mail'),
			'emp_jefepersonal'=>Yii::t('general','Jefe de personal')
		);
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

		$criteria->compare('emp_nombre',$this->emp_nombre,true);
		$criteria->compare('emp_codigo',$this->emp_codigo);
		$criteria->compare('emp_direccion',$this->emp_direccion,true);
		$criteria->compare('emp_telefono',$this->emp_telefono,true);
		$criteria->compare('emp_email',$this->emp_email,true);
		$criteria->compare('emp_jefepersonal',$this->emp_jefepersonal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getListaCentrosMedicos ()
	{
	   $arrCentrosMedicos= CHtml::listData($this->centrosmedicos(),'afi_codigo','afi_nombre');						         
	   $ausgabe = '<ul>';
	   foreach($arrCentrosMedicos as $key=>$value) { 
			$ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('/afiliado/afiliado/view', 'id' => $key)));
			
	   }
	   $ausgabe .= '</ul>';
	   return $ausgabe;
	}
	
	public function getCentrosMedicos()
	{
		// query criteria
		$criteria = new CDbCriteria();			
		$criteria->compare('axe_emp_codigo',$this->getAttribute("emp_codigo"),true);
		// find all authors with his/her posts
		$arrDataAfiliados = array();
		$arrAfiliados = Afiliadoxempresa::model()->findAll($criteria);				
	    foreach($arrAfiliados as $key=>$value) { 
			$arrDataAfiliados[$value->getAttribute('axe_afi_codigo')]= $value->afiliado->afi_nombre;
		}		  	    
	    return $arrDataAfiliados;
	}
	
	public function getListaEmpleados ()
	{
		// query criteria
		$criteria = new CDbCriteria();
		// join Post model (one for fetching data, the other for filtering)
		$criteria->with = array(			
			'exempleado' => array(  // this is for filtering				
				'together' => true,
			),
		);
		// compare title
		$criteria->addCondition('exm_codigo IS NULL');
		$criteria->compare('emp_emp_codigo',$this->getAttribute("emp_codigo"),true);
		// find all authors with his/her posts
		$arrExempleados = CHtml::listData(Empleado::model()->findAll($criteria),'emp_codigo','emp_nombre');		
		$ausgabe = '<ul>';
	    foreach($arrExempleados as $key=>$value) { 
		   if (empty($value)) {
			   $value = $key;
		   }
		   $ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('/empleado/empleado/view', 'id' => $key)));			
	    }
	    $ausgabe .= '</ul>';
	    return $ausgabe;
	}
	
	public function getListaExempleados ()
	{
		// query criteria
		$criteria = new CDbCriteria();
		// join Post model (one for fetching data, the other for filtering)
		$criteria->with = array(			
			'exempleado' => array(  // this is for filtering				
				'together' => true,
			),
		);
		// compare title
		$criteria->addCondition('exm_codigo IS NOT NULL');
		$criteria->compare('emp_emp_codigo',$this->getAttribute("emp_codigo"),true);
		// find all authors with his/her posts
		$arrExempleados = CHtml::listData(Empleado::model()->findAll($criteria),'emp_codigo','emp_nombre');		
		$ausgabe = '<ul>';
	    foreach($arrExempleados as $key=>$value) { 
		   if (empty($value)) {
			   $value = $key;
		   }
		   $ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('/empleado/empleado/view', 'id' => $key)));			
	    }
	    $ausgabe .= '</ul>';
	    return $ausgabe;
	}
	
	protected function afterFind ()
    {			
		if(is_array($this->centrosmedicos())){
			$arrCentrosMedicos= CHtml::listData($this->centrosmedicos(),'afi_codigo','afi_codigo');						         
			$this->centrosmedicos = $arrCentrosMedicos;           
		}
        parent::afterFind ();
    }
    
    /**
	 * Se ejecuta despues de guardar
	 */ 
	protected function afterSave(){							
		//crea las licencias por defecto
		if ($this->isNewRecord) {
			$licenciasPorDefecto = (int)Yii::app()->params['licenciasPorDefecto'];	
			$crearLicenciasGratuitasAtomaticas = (bool)Yii::app()->params['crearLicenciasGratuitasAtomaticas'];	
			if($licenciasPorDefecto > 0 && $crearLicenciasGratuitasAtomaticas === true) {
				for ($i=0;$i<$licenciasPorDefecto;$i++) {
					$licencia = new Licencia();
					$licencia->setAttribute('lic_fechacreacion',date('Y-m-d H:i:s'));					
					$licencia->setAttribute('lic_duracion',(int)Yii::app()->params['tiempoLicenciaPorDefecto']);
					$licencia->setAttribute('lic_emp_codigo',$this->getAttribute('emp_codigo'));					
					$licencia->setAttribute('lic_usr_codigo',0);
					$licencia->setAttribute('lic_precio',0);																								
					$licencia->setAttribute('lic_esgratuita',1);
					$licencia->save();
				}					
			}				
		}							
		parent::afterSave();
		return true;		
	}
}
