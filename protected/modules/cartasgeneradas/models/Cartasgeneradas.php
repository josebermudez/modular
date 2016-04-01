<?php

/**
 * This is the model class for table "cartasgeneradas".
 *
 * The followings are the available columns in table 'cartasgeneradas':
 * @property integer $cge_codigo
 * @property integer $cag_emp_codigo
 * @property integer $cag_usr_codigo
 * @property integer $cag_empr_codigo
 * @property string $cag_archivo
 * @property string $cag_fechacreacion
 */
class Cartasgeneradas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cartasgeneradas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cag_emp_codigo, cag_usr_codigo, cag_empr_codigo', 'numerical', 'integerOnly'=>true),
			array('cag_archivo', 'length', 'max'=>400),
			array('cag_fechacreacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cag_codigo, cag_emp_codigo, cag_usr_codigo, cag_empr_codigo, cag_archivo, cag_fechacreacion', 'safe', 'on'=>'search'),
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
			 'empresa'=>array(self::BELONGS_TO, 'Empresa', 'cag_empr_codigo'),
			 'empleado' => array( self::BELONGS_TO, 'Empleado', 'cag_emp_codigo' ),
			 'usuario' => array(self::BELONGS_TO, 'CrugeStoredUser', 'cag_usr_codigo'),
			 'motivo' => array(self::BELONGS_TO, 'Motivo', 'cag_mot_codigo'),
			 'formato' => array(self::BELONGS_TO, 'Formato', 'cag_for_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cag_codigo' => 'Cge Codigo',
			'cag_emp_codigo' => 'Cag Emp Codigo',
			'cag_usr_codigo' => 'Cag Usr Codigo',
			'cag_empr_codigo' => 'Cag Empr Codigo',
			'cag_archivo' => 'Cag Archivo',
			'cag_fechacreacion' => 'Cag Fechacreacion',
			'cag_mot_codigo' => 'Cag Fechacreacion',
			'cag_fechacreacion' => 'Fecha creación',
			'username' => 'Usuario',
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

		$criteria->compare('cag_codigo',$this->cag_codigo);
		$criteria->compare('cag_emp_codigo',$this->cag_emp_codigo);
		$criteria->compare('cag_usr_codigo',$this->cag_usr_codigo);
		$criteria->compare('cag_empr_codigo',Yii::app()->user->getState('empresa'));		
		$criteria->compare('cag_archivo',$this->cag_archivo,true);
		$criteria->compare('cag_fechacreacion',$this->cag_fechacreacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cartasgeneradas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
