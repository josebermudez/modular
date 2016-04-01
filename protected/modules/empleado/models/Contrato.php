<?php
/**
 * This is the model class for table "contrato".
 *
 * The followings are the available columns in table 'contrato':
 * @property integer $con_fechainicio
 * @property string $con_fechafin
 * @property string $con_for_id
 * @property string $con_emp_id
 * @property string $con_documento
 * @property string $con_contenido
 * @property string $con_avisarvencimiento
 * @property string $con_avisarantesde
 * @property integer $con_avisarjefe
 */
class Contrato extends CActiveRecord
{
	protected $_contratoProximoAVencer;
	
	protected $_diasVencerse;
	
	protected $_tipoIntervalo;
	
	protected $_strFechaInicial;
	
	protected $_strFechaFinal;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contrato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('con_id', 'numerical', 'integerOnly'=>true),
			array('con_documento', 'file', 'types'=>'pdf', 'allowEmpty' => true,'on'=>'update'),			
			//array('emp_email', 'email'),
			array('con_fechainicio, con_fechafin,  con_emp_id', 'required'),
			array('con_fechainicio, con_esindefinido, con_documentooriginal, con_terminado, con_fechafin, con_for_id, con_emp_id, con_documento, con_contenido, con_avisarvencimiento, con_avisarantesde, con_avisarjefe, con_avisarempleado, con_fechacreacion, con_fechaedicion, con_enviarcorreelectronico', 'safe'),
			//array('emp_email,emp_nombre, emp_numerodocumento, emp_direccion, emp_telefonomovil, emp_estado, emp_emp_codigo',  'required', 'on'=>'completardatos'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('con_fechainicio, con_esindefinido, con_terminado, con_fechafin, con_for_id, con_emp_id, con_documento, con_contenido, con_avisarvencimiento, con_avisarantesde, con_avisarjefe, con_avisarempleado, con_fechacreacion, con_fechaedicion, con_enviarcorreelectronico', 'safe', 'on'=>'search'),
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
			'formato' => array(self::HAS_ONE, 'Formato', 'con_for_id'),
			'empleado' => array(self::BELONGS_TO, 'Empleado', 'con_emp_id'),			
			'notificaciones' => array(self::BELONGS_TO, 'Notificacionxcontrato', 'nxc_con_id')	
		);
	}	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'con_fechainicio' => Yii::t('general','Fecha de inicio'),
			'con_fechafin' => Yii::t('general','Fecha final'),
			'con_for_id' => Yii::t('general','Código formato'),
			'con_emp_id' => Yii::t('general','Código empleado'),		
			'con_terminado' => Yii::t('general','Contrato terminado'),			
			'con_esindefinido' => Yii::t('general','Es indefinido'),
			'con_documento' => Yii::t('general','Documento del contrato'),
			'con_contenido' => Yii::t('general','Contenido del contrato'),
			'con_avisarvencimiento' => Yii::t('general','Recordar antes del vencimiento'),
			'con_avisarantesde' => Yii::t('general','Numero de días para recordar'),
			'con_avisarjefe' => Yii::t('general','Enviar recordatorio jefe'),
			'con_avisarempleado' => Yii::t('general','Enviar recordatorio empleado'),
			'con_fechaedicion' => Yii::t('general','Fecha de edición'),
			'con_fechacreacion' => Yii::t('general','Fecha de creación'),
			'con_enviarcorreelectronico' => Yii::t('general','Enviar correo electrónico de recordatorio'),
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

		$criteria->compare('con_fechainicio',$this->con_fechainicio);
		$criteria->compare('con_fechafin',$this->con_fechafin,true);
		$criteria->compare('con_for_id',$this->con_for_id,true);
		$criteria->compare('con_emp_id',$this->con_emp_id,true);
		$criteria->compare('con_documento',$this->con_documento,true);
		$criteria->compare('con_contenido',$this->con_contenido,true);
		$criteria->compare('con_avisarvencimiento',$this->con_avisarvencimiento,true);
		$criteria->compare('con_avisarantesde',$this->con_avisarantesde,true);		
		$criteria->compare('con_avisarjefe',$this->con_avisarjefe,true);
		$criteria->compare('con_terminado',$this->con_terminado,true);
		$criteria->compare('con_avisarempleado',$this->con_avisarempleado,true);
		$criteria->compare('con_fechaedicion',$this->con_fechaedicion,true);
		$criteria->compare('con_fechacreacion',$this->con_fechacreacion,true);
		$criteria->compare('con_enviarcorreelectronico',$this->con_enviarcorreelectronico,true);								
		$criteria->compare('con_esindefinido',$this->con_esindefinido,true);								
		$criteria->compare('con_emp_id',$this->con_emp_id,true);								
		$criteria->order = 'con_terminado ASC, con_fechafin ASC'; 

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Empleado the static model class
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
				$this->setAttribute('con_fechacreacion',date('Y-m-d H:i:s'));			
			}
			if ($this->scenario === 'terminar') {
				$this->setAttribute('con_fechainicio', $this->_strFechaInicial);
				$this->setAttribute('con_fechafin',$this->_strFechaFinal);
			} else {
				$this->setAttribute('con_fechainicio',date('Y-m-d', strtotime(str_replace(",", "", $this->con_fechainicio))));
				$this->setAttribute('con_fechafin',date('Y-m-d', strtotime(str_replace(",", "", $this->con_fechafin))));
			}
			$this->setAttribute('con_fechaedicion',date('Y-m-d H:i:s'));			
			return TRUE;
		}
		else return false;
	}
	/**
	 * Se ejecuta descpues de buscar
	 */
	protected function afterFind(){		
		parent::afterFind();	
		$this->_esContratoProximoAVencer();
		$this->_strFechaInicial =  $this->con_fechainicio;
		$this->_strFechaFinal =  $this->con_fechafin;
		$this->con_fechainicio=Yii::app()->dateFormatter->formatDateTime(
                    CDateTimeParser::parse(
                        $this->con_fechainicio,
                        'yyyy-MM-dd'
                    ),
                    'long',null
                );
		$this->con_fechafin=Yii::app()->dateFormatter->formatDateTime(
                    CDateTimeParser::parse(
                        $this->con_fechafin, 
                        'yyyy-MM-dd'
                    ),
                    'long',null
                );
	}
	
	public function proximoAVencer()
	{
		return $this->_contratoProximoAVencer;
	}
	
	public function diasParaVencerse()
	{
		return $this->_diasVencerse;
	}
	
	public function getTipoIntervalo()
	{
		return $this->_tipoIntervalo;
	}
	/**
	 * Verifica si un contrato esta proximo a vencerse 
	 */
	protected function _esContratoProximoAVencer()
	{										
		$this->_contratoProximoAVencer = false;
		$this->_diasVencerse = 0;
		$intCodigoContrato = (int)$this->getAttribute('con_id');
		$intFechaInicio = $this->getAttribute('con_fechainicio');
		$intFechaFin = $this->getAttribute('con_fechafin');
		$intDiasAvisar = (int)$this->getAttribute('con_avisarantesde');		
		if ($intCodigoContrato  > 0 && $intDiasAvisar > 0) {
			$dateFechaInicio = new DateTime($intFechaInicio);
			$dateFechaFin = new DateTime($intFechaFin);
			$interval = $dateFechaInicio->diff($dateFechaFin);			
			$boolAvisarVencimiento = (bool)$this->getAttribute('con_avisarvencimiento');
			if((((int)$interval->days <= $intDiasAvisar || $interval->invert === 1) && ($boolAvisarVencimiento === true || Yii::app()->user->isSuperAdmin))) {
				$this->_contratoProximoAVencer = true;
				$this->_diasVencerse = $interval->days;
				$this->_tipoIntervalo = $interval->invert;				
			}			
		}		
	}
}
