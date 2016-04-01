<?php

/**
 * This is the model class for table "notificacionxcontrato".
 *
 * The followings are the available columns in table 'notificacionxcontrato':
 * @property string $nxc_id
 * @property integer $nxc_con_id
 * @property string $nxc_fechacreacion
 * @property string $nxc_fechaedicion
 * @property string $nxc_notificacionemail
 * @property string $nxc_notificacionnormal
 * @property integer $nxc_usr_codigo
 * @property string $nxc_email
 * @property string $nxc_contenidoemail
 */
class Notificacionxcontrato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notificacionxcontrato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nxc_usr_codigo,nxc_con_id', 'required'),
			array('nxc_con_id, nxc_usr_codigo', 'numerical', 'integerOnly'=>true),
			array('nxc_id', 'length', 'max'=>10),
			array('nxc_notificacionemail, nxc_notificacionnormal', 'length', 'max'=>1),
			array('nxc_email', 'length', 'max'=>300),
			array('nxc_fechacreacion, nxc_fechaedicion, nxc_contenidoemail', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nxc_id, nxc_con_id, nxc_fechacreacion, nxc_fechaedicion, nxc_notificacionemail, nxc_notificacionnormal, nxc_usr_codigo, nxc_email, nxc_contenidoemail', 'safe', 'on'=>'search'),
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
			'nxc_id' => 'Nxc',
			'nxc_con_id' => 'Codigo del contrato',
			'nxc_fechacreacion' => 'Fecha de la notificacion',
			'nxc_fechaedicion' => 'Fecha de edición del registro',
			'nxc_notificacionemail' => 'Indica si la notificacion fue por email',
			'nxc_notificacionnormal' => 'Indica si la notificacion fue por el aplicativo ventana modal',
			'nxc_usr_codigo' => 'Codigo del usuario en el sitema al que se le hace la notificacion',
			'nxc_email' => 'Email a donde se envia la notificacion',
			'nxc_contenidoemail' => 'Contenido del email que se envia en la notificacion',
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

		$criteria->compare('nxc_id',$this->nxc_id,true);
		$criteria->compare('nxc_con_id',$this->nxc_con_id);
		$criteria->compare('nxc_fechacreacion',$this->nxc_fechacreacion,true);
		$criteria->compare('nxc_fechaedicion',$this->nxc_fechaedicion,true);
		$criteria->compare('nxc_notificacionemail',$this->nxc_notificacionemail,true);
		$criteria->compare('nxc_notificacionnormal',$this->nxc_notificacionnormal,true);
		$criteria->compare('nxc_usr_codigo',$this->nxc_usr_codigo);
		$criteria->compare('nxc_email',$this->nxc_email,true);
		$criteria->compare('nxc_contenidoemail',$this->nxc_contenidoemail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notificacionxcontrato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Se ejecuta antes de guardar
	 */ 
	protected function beforeSave(){
		if(parent::beforeSave()){
			if ($this->isNewRecord) {
				$this->setAttribute('nxc_fechacreacion',date('Y-m-d H:i:s'));			
			}			
			$this->setAttribute('nxc_fechaedicion',date('Y-m-d H:i:s'));			
			return TRUE;
		}
		else return false;
	}
}
