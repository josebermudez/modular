<?php

/**
 * This is the model class for table "formato".
 *
 * The followings are the available columns in table 'formato':
 * @property integer $for_codigo
 * @property string $for_nombre
 * @property string $for_texto
 */
class FormatoMotivo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'formatoxmotivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fxm_for_codigo,fxm_mot_codigo', 'required'),			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('fxm_codigo,fxm_for_codigo,fxm_mot_codigo', 'safe', 'on'=>'search'),
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
			'formato' => array(self::BELONGS_TO, 'Formato', 'fxm_for_codigo'),
			'motivo' => array(self::BELONGS_TO, 'Motivo', 'fxm_mot_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'for_codigo' => 'Código',
			'for_nombre' => 'Nombre',
			'for_nombrearchivo' => 'Formato',
			'for_texto' => 'Texto',
			'for_archivo' => 'Adjunte los formatos ( máximo 4 )',
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

		$criteria->compare('for_codigo',$this->for_codigo);
		$criteria->compare('for_nombre',$this->for_nombre,true);
		$criteria->compare('for_texto',$this->for_texto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
