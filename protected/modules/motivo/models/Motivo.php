<?php

/**
 * This is the model class for table "motivo".
 *
 * The followings are the available columns in table 'motivo':
 * @property integer $mot_codigo
 * @property string $mot_nombre
 * @property string $mot_fechacreacion
 * @property integer $mot_emp_codigo
 */
class Motivo extends CActiveRecord
{	
	
	public $mot_formatos;
	
	private $_roles;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'motivo';
	}
	
	public function getRoles()
	{		
		return $this->_roles;
	}
	public function setRoles($value)
	{
		$this->_roles = $value;
	}	

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mot_formatos, mot_nombre', 'required'),
			array('mot_codigo, mot_emp_codigo', 'numerical', 'integerOnly'=>true),
			array('mot_fechacreacion,roles', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mot_codigo, mot_nombre, mot_fechacreacion, mot_emp_codigo', 'safe', 'on'=>'search'),
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
			 'formatos'=>array(
				self::MANY_MANY,
				'Formato',
				'formatoxmotivo(fxm_mot_codigo, fxm_for_codigo)'
			),							
			//'formatos' => array(self::HAS_MANY, 'FormatoMotivo', 'fxm_for_codigo'),			
			'roles' => array(self::HAS_MANY, 'Modul4rAuthitem', 'mxr_rol_nombre'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mot_codigo' => 'Código',
			'mot_nombre' => 'Motivo',
			'mot_fechacreacion' => 'Fecha de creación',
			'mot_emp_codigo' => 'Código de la empresa',
			'formatos' => 'Formatos',
			'mot_formatos' => 'Formatos',
			'mot_archivoformulario'=>'Archivo de formulario',
			'roles'=>'Roles asignados al motivo'
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

		$criteria->compare('mot_codigo',$this->mot_codigo);
		$criteria->compare('mot_nombre',$this->mot_nombre,true);
		$criteria->compare('mot_fechacreacion',$this->mot_fechacreacion,true);
		$criteria->compare('mot_emp_codigo',Yii::app()->user->getState('empresa'));
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Motivo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	 protected function afterFind ()
    {
		$arrFormatos = array();		
		$arrRoles = array();
		$formatos= FormatoMotivo::model()->findAll("fxm_mot_codigo  = '{$this->mot_codigo}'");
		foreach($formatos as $formato){			
			$arrFormatos[] = $formato->getAttribute('fxm_for_codigo');
		}            
        $this->mot_formatos = $arrFormatos;            
        $roles= Motivoxrol::model()->findAll("mxr_mot_codigo  = '{$this->mot_codigo}'");
		foreach($roles as $rol){			
			$arrRoles[] = $rol->getAttribute('mxr_rol_nombre');
		}            
        $this->mot_formatos = $arrFormatos;                   
        $this->roles = $arrRoles;            
        parent::afterFind ();
    }


}
