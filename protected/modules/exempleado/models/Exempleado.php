<?php

/**
 * This is the model class for table "exempleado".
 *
 * The followings are the available columns in table 'exempleado':
 * @property integer $exm_codigo
 * @property integer $exm_emp_codigo
 * @property string $exm_fechacreacion
 * @property string $exm_motivo
 */
class Exempleado extends CActiveRecord
{
	private $_numerodocumento;
	
	
	public function getNumerodocumento()
	{
		if ($this->_numerodocumento === null && $this->empleado !== null)
		{
			$this->_numerodocumento = $this->empleado->emp_numerodocumento;
		}
		return $this->_numerodocumento;
	}
	public function setNumerodocumento($value)
	{
		$this->_numerodocumento = $value;
	}	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'exempleado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('exm_emp_codigo', 'numerical', 'integerOnly'=>true),
			array('exm_fechacreacion, exm_motivo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('exm_codigo,numerodocumento, exm_emp_codigo, exm_fechacreacion, exm_motivo', 'safe', 'on'=>'search'),
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
			'empleado' => array(self::BELONGS_TO, 'Empleado', 'exm_emp_codigo'),			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'exm_codigo' => 'Codigo',
			'exm_emp_codigo' => 'Emp Codigo',
			'exm_fechacreacion' => 'Fecha creacion',
			'exm_motivo' => 'Motivo',
			'numerodocumento' => 'Número de documento',
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

		$criteria->compare('exm_codigo',$this->exm_codigo);
		$criteria->compare('exm_emp_codigo',$this->exm_emp_codigo);
		if (!empty($this->exm_fechacreacion)) {
			$criteria->condition = "exm_fechacreacion BETWEEN :date_from AND :date_to";
			$criteria->params[':date_from'] = $this->exm_fechacreacion.' 00:00:00';
			$criteria->params[':date_to'] = $this->exm_fechacreacion.' 23:59:59';		
		}		
		$criteria->compare('exm_motivo',$this->exm_motivo,true);
		$criteria->compare('empleado.emp_numerodocumento',$this->numerodocumento,true);		
	    $criteria->compare('empleado.emp_emp_codigo',Yii::app()->user->getState('empresa'),true); 
		$criteria->with = 'empleado';
		
		$sort = new CSort();
			$sort->attributes = array(
				'defaultOrder'=>'exm_fechacreacion DESC',
				'motivo'=>array(
					'asc'=>'t.exm_motivo',
					'desc'=>'t.exm_motivo desc',
				),				
				'numerodocumento'=>array(
					'asc'=>'empleado.emp_numerodocumento',
					'desc'=>'empleado.emp_numerodocumento desc',
				),
			);
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		    'sort'=>$sort
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Exempleado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
