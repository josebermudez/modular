<?php

/**
 * This is the model class for table "documento".
 *
 * The followings are the available columns in table 'documento':
 * @property integer $doc_codigo
 * @property string $doc_nombre
 * @property integer $doc_usr_codigo
 * @property integer $doc_empr_codigo
 * @property string $doc_fechacreacion
 */
class Documento extends CActiveRecord
{
	public $arrAfiliado;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_usu_codigo, doc_emp_codigo', 'numerical', 'integerOnly'=>true),
			array('doc_usu_codigo, doc_emp_codigo', 'required'),
			array('doc_nombre', 'length', 'max'=>400),
			array('doc_fechacreacion, arrAfiliado', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_codigo, doc_nombre, doc_usu_codigo, doc_emp_codigo, doc_fechacreacion', 'safe', 'on'=>'search'),
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
			'afiliado'=>array(
				self::BELONGS_TO,
				'Afiliado',
				'doc_afi_codigo'
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'doc_codigo' => 'Doc Codigo',
			'doc_nombre' => 'Ruta',
			'doc_nombrearchivo' => 'Archivo',
			'doc_nota' => 'Comentarios',
			'doc_archivo' => 'Documentos',
			'doc_usu_codigo' => 'Doc Usr Codigo',
			'doc_emp_codigo' => 'Doc Empr Codigo',
			'doc_fechacreacion' => 'Doc Fechacreacion',
		);
	}
	/**
	 * Lista de documentos que un centro médico ha subido para la empresa
	 */
	public function  documentosCentroMedicoxEmpresa()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('doc_codigo',$this->doc_codigo);
		$criteria->compare('doc_nombre',$this->doc_nombre,true);
		$criteria->compare('doc_nombrearchivo',$this->doc_nombrearchivo,true);
		$criteria->compare('doc_usu_codigo',$this->doc_usu_codigo);
		$criteria->compare('doc_nota',$this->doc_nota);
		$criteria->compare('doc_emp_codigo',$this->doc_emp_codigo);
		if(is_array($this->arrAfiliado) && count($this->arrAfiliado) > 0) {
			$criteria->addInCondition('doc_afi_codigo', $this->arrAfiliado);
		}				
		$criteria->compare('doc_fechacreacion',$this->doc_fechacreacion,true);		
		$criteria->order = 'doc_fechacreacion DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

		$criteria->compare('doc_codigo',$this->doc_codigo);
		$criteria->compare('doc_nombre',$this->doc_nombre,true);
		$criteria->compare('doc_nombrearchivo',$this->doc_nombrearchivo,true);
		$criteria->compare('doc_usu_codigo',$this->doc_usu_codigo);
		$criteria->compare('doc_nota',$this->doc_nota);
		$criteria->compare('doc_emp_codigo',$this->doc_emp_codigo);
		if(is_array($this->arrAfiliado) && count($this->arrAfiliado) > 0) {
			$criteria->addInCondition('doc_afi_codigo', $this->arrAfiliado);
		}
		if(Yii::app()->user->isSuperAdmin === false && Yii::app()->user->checkAccess('centromedico') ) {
			$afiliadoData = Afiliado::model()->findByAttributes(
				array(
					'afi_usr_codigo'=>Yii::app()->user->id
				)
			);					
			$criteria->compare('doc_afi_codigo',$afiliadoData->getAttribute('afi_codigo'));
			$criteria->with=array('afiliado');
		}	
		$boolTienePermisoEmpleado = Yii::app()->user->checkAccess('empleado');
		$boolTienePermisoFuncionario = Yii::app()->user->checkAccess('funcionario');
		if(Yii::app()->user->isSuperAdmin === false &&  $boolTienePermisoEmpleado === true) {						
			$criteria->compare('doc_usu_codigo',Yii::app()->user->id);
		}	
		$criteria->compare('doc_fechacreacion',$this->doc_fechacreacion,true);		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documento the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
