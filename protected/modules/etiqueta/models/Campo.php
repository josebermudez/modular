<?php

/**
 * This is the model class for table "campo".
 *
 * The followings are the available columns in table 'campo':
 * @property integer $cam_codigo
 * @property string $cam_nombre
 * @property string $cam_label
 * @property string $cam_tipo
 * @property string $cam_tablaasociada
 * @property string $cam_keyllaveasociada
 * @property string $cam_valorllaveasociada
 * @property string $cam_etiqueta
 */
class Campo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'campo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cam_nombre, cam_label, cam_tipo, cam_tablaasociada, cam_keyllaveasociada, cam_valorllaveasociada, cam_etiqueta', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cam_codigo, cam_nombre, cam_label, cam_tipo, cam_tablaasociada, cam_keyllaveasociada, cam_valorllaveasociada, cam_etiqueta', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cam_codigo' => 'Cam Codigo',
			'cam_nombre' => 'Cam Nombre',
			'cam_label' => 'Cam Label',
			'cam_tipo' => 'Cam Tipo',
			'cam_tablaasociada' => 'Cam Tablaasociada',
			'cam_keyllaveasociada' => 'Cam Keyllaveasociada',
			'cam_valorllaveasociada' => 'Cam Valorllaveasociada',
			'cam_etiqueta' => 'Cam Etiqueta',
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

		$criteria->compare('cam_codigo',$this->cam_codigo);
		$criteria->compare('cam_nombre',$this->cam_nombre,true);
		$criteria->compare('cam_label',$this->cam_label,true);
		$criteria->compare('cam_tipo',$this->cam_tipo,true);
		$criteria->compare('cam_tablaasociada',$this->cam_tablaasociada,true);
		$criteria->compare('cam_keyllaveasociada',$this->cam_keyllaveasociada,true);
		$criteria->compare('cam_valorllaveasociada',$this->cam_valorllaveasociada,true);
		$criteria->compare('cam_etiqueta',$this->cam_etiqueta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Campo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
