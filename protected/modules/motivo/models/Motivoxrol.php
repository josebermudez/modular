<?php

/**
 * This is the model class for table "motivoxrol".
 *
 * The followings are the available columns in table 'motivoxrol':
 * @property integer $mxr_codigo
 * @property integer $mxr_mot_codigo
 * @property string $mxr_rol_nombre
 * @property string $mxr_fechacreacion
 *
 * The followings are the available model relations:
 * @property Motivo $mxrMotCodigo
 */
class Motivoxrol extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'motivoxrol';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mxr_mot_codigo', 'numerical', 'integerOnly'=>true),
			array('mxr_rol_nombre', 'length', 'max'=>64),
			array('mxr_fechacreacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mxr_codigo, mxr_mot_codigo, mxr_rol_nombre, mxr_fechacreacion', 'safe', 'on'=>'search'),
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
			'motivo' => array(self::BELONGS_TO, 'Motivo', 'mxr_mot_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mxr_codigo' => 'Mxr Codigo',
			'mxr_mot_codigo' => 'Mxr Mot Codigo',
			'mxr_rol_nombre' => 'Mxr Rol Nombre',
			'mxr_fechacreacion' => 'Mxr Fechacreacion',
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

		$criteria->compare('mxr_codigo',$this->mxr_codigo);
		$criteria->compare('mxr_mot_codigo',$this->mxr_mot_codigo);
		$criteria->compare('mxr_rol_nombre',$this->mxr_rol_nombre,true);
		$criteria->compare('mxr_fechacreacion',$this->mxr_fechacreacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Motivoxrol the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
