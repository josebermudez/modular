<?php

/**
 * This is the model class for table "afiliadoxempresa".
 *
 * The followings are the available columns in table 'afiliadoxempresa':
 * @property integer $axe_codigo
 * @property integer $axe_emp_codigo
 * @property integer $axe_afi_codigo
 */
class Afiliadoxempresa extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'afiliadoxempresa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('axe_emp_codigo, axe_afi_codigo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('axe_codigo, axe_emp_codigo, axe_afi_codigo', 'safe', 'on'=>'search'),
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
			'empresa'  => array( self::BELONGS_TO, 'Empresa', 'axe_emp_codigo' ),
			'afiliado'   => array( self::BELONGS_TO, 'Afiliado', 'axe_afi_codigo' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'axe_codigo' => 'Código',
			'axe_emp_codigo' => 'Código de empresa',
			'axe_afi_codigo' => 'Código de afiliado',
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

		$criteria->compare('axe_codigo',$this->axe_codigo);
		$criteria->compare('axe_emp_codigo',$this->axe_emp_codigo);
		$criteria->compare('axe_afi_codigo',$this->axe_afi_codigo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Afiliadoxempresa the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
