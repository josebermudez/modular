<?php

/**
 * This is the model class for table "formato".
 *
 * The followings are the available columns in table 'formato':
 * @property integer $for_codigo
 * @property string $for_nombre
 * @property string $for_texto
 */
class Formato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'formato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('for_archivo,for_emp_codigo,for_nombrearchivo,for_usu_codigo', 'required','on'=>'subidaarchivo'),
			array('for_archivovalido', 'safe'),
			array('for_nombre', 'required','on'=>'nombreformato'),
			
			array('for_archivo', 'file', 'types'=>'rtf'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('for_codigo, for_nombre, for_texto, for_archivo', 'safe', 'on'=>'search'),
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
			'motivos'=>array(
				self::MANY_MANY,
				'Motivo',
				'formatoxmotivo(fxm_for_codigo,fxm_mot_codigo,)'
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'for_codigo' => 'Código',
			'for_nombre' => 'Formato',
			'for_nombrearchivo' => 'Archivo',
			'for_texto' => 'Texto',
			'for_archivo' => 'Adjunte los formatos ( máximo 4 )',
			'for_archivovalido' => 'Válido',
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
		$criteria->compare('for_nombrearchivo',$this->for_nombrearchivo,true);
		$criteria->compare('for_archivovalido',$this->for_archivovalido,true);
		$criteria->compare('for_texto',$this->for_texto,true);
		$criteria->compare('for_emp_codigo',Yii::app()->user->getState('empresa')); 

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
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formato the static model class
	 */
	public static function getFormatosEmpresa()
	{
		$result = array();
		$list = self::model()->findAllByAttributes(
			array(
				'for_emp_codigo'=>Yii::app()->user->getState('empresa'),
				'for_archivovalido'=>1
			)
		);		
		if (isset($list)) {
			$result = $list;
		}		
		return $result;
	}
}
