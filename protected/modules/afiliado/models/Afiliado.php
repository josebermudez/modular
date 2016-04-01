<?php

/**
 * This is the model class for table "afiliado".
 *
 * The followings are the available columns in table 'afiliado':
 * @property integer $afi_codigo
 * @property string $afi_nombre
 * @property string $afi_direccion
 * @property string $afi_telefonos
 * @property string $afi_numerodocumento
 * @property string $afi_tipodocumento
 * @property integer $afi_tipo
 */
class Afiliado extends CActiveRecord
{
	const CENTROSMEDICOS = 1;
	
	public $empleado;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'afiliado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('afi_tipo', 'numerical', 'integerOnly'=>true),
			array('afi_nombre, afi_ciu_codigo, afi_direccion,afi_email, afi_telefonos, afi_numerodocumento', 'required'),
			array('afi_nombre', 'length', 'min'=>2, 'max'=>100),      
			array('afi_direccion', 'length', 'min'=>2, 'max'=>100),
			array('afi_telefonos', 'length', 'min'=>2, 'max'=>100),    
			array('afi_email','email'),        
			array('afi_email', 'length', 'min'=>2, 'max'=>200),            
			array('afi_numerodocumento', 'length', 'min'=>2, 'max'=>20),      
			array('afi_nombre, afi_direccion, afi_horarios, afi_telefonos, afi_numerodocumento, afi_tipodocumento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('afi_codigo, afi_nombre, afi_direccion, afi_telefonos, afi_numerodocumento, afi_tipodocumento, afi_tipo', 'safe', 'on'=>'search'),
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
			 'empresas'=>array(self::MANY_MANY, 'Empresa', 'afiliadoxempresa(axe_afi_codigo, axe_emp_codigo)'),
			 'afiliadosxempresas' => array( self::HAS_MANY, 'Afiliadoxempresa', 'axe_afi_codigo' ),
			 'ciudad' => array( self::BELONGS_TO, 'Ciudad', 'afi_ciu_codigo' ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'afi_codigo' => 'Código',
			'afi_nombre' => 'Nombre',
			'afi_direccion' => 'Dirección',
			'afi_telefonos' => 'Teléfonos',
			'afi_horarios' => 'Horarios',
			'afi_ciu_codigo' => 'Ciudad',
			'afi_numerodocumento' => 'Número documento',
			'afi_tipodocumento' => 'Tipo documento',
			'afi_tipo' => 'Tipo',
			'empleado' => 'Número documento',
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

		$criteria->compare('afi_codigo',$this->afi_codigo);
		$criteria->compare('afi_nombre',$this->afi_nombre,true);
		$criteria->compare('afi_direccion',$this->afi_direccion,true);
		$criteria->compare('afi_telefonos',$this->afi_telefonos,true);
		$criteria->compare('afi_numerodocumento',$this->afi_numerodocumento,true);
		$criteria->compare('afi_tipodocumento',$this->afi_tipodocumento,true);
		$criteria->compare('afi_tipo',$this->afi_tipo);
		if (!Yii::app()->user->isSuperAdmin) {
			$criteria->compare('axe_emp_codigo',Yii::app()->user->getState('empresa'),true); 
		}
		$criteria->with = 'afiliadosxempresas';
		$criteria->together = true;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Afiliado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getListaEmpresas ()
	{
	   $arrCentrosMedicos= CHtml::listData($this->empresas(),'emp_codigo','emp_nombre');						         
	   $ausgabe = '<ul>';
	   foreach($arrCentrosMedicos as $key=>$value) { 
			$ausgabe .= sprintf('<li>%s</li>', CHtml::link($value, array('/empresa/empresa/view', 'id' => $key)));
			
	   }
	   $ausgabe .= '</ul>';
	   return $ausgabe;
	}
}
