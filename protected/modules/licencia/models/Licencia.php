<?php

/**
 * This is the model class for table "licencia".
 *
 * The followings are the available columns in table 'licencia':
 * @property string $lic_id
 * @property string $lic_fechacreacion
 * @property string $lic_fechaedicion
 * @property string $lic_duracion
 * @property string $lic_fechavencimiento
 * @property string $lic_activa
 * @property integer $lic_emp_codigo
 * @property integer $lic_usr_codigo
 * @property string $lic_codigo
 */
class Licencia extends CActiveRecord
{
	protected $_tamanioCodigoLicencia;
	protected $_tamanioTrozosCodigoLicencia;
	protected $_separadorTrozos;
	public function init()
	{
		parent::init();
		$this->_tamanioCodigoLicencia = 14;		
		$this->_tamanioTrozosCodigoLicencia = 4;
		$this->_separadorTrozos = '-';
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'licencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('lic_emp_codigo, lic_usr_codigo', 'numerical', 'integerOnly'=>true),
			array('lic_id', 'length', 'max'=>10),
			array('lic_duracion', 'length', 'max'=>4),
			array('lic_activa', 'length', 'max'=>1),
			array('lic_codigo', 'length', 'max'=>23),
			array('lic_fechacreacion, lic_estaenuso,lic_fechaedicion,lic_precio, lic_fechavencimiento, lic_esgratuita', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lic_id, lic_fechacreacion, lic_fechaedicion, lic_duracion, lic_esgratuita, lic_fechavencimiento, lic_activa, lic_emp_codigo, lic_usr_codigo, lic_codigo', 'safe', 'on'=>'search'),
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
	        //'empresas' => array(self::HAS_MANY, 'Empresa', 'emp_lic_codigo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lic_id' => 'Lic',
			'lic_fechacreacion' => 'Fecha de creacion del registro',
			'lic_fechaedicion' => 'Fecha de edición del registro',
			'lic_duracion' => 'Duracion de la licencia en dias',
			'lic_fechavencimiento' => 'Contenido del email que se envia en la notificacion',
			'lic_activa' => 'Indica el estado de la licencia',
			'lic_emp_codigo' => 'Codigo de la empresa dueña de la licencia',
			'lic_usr_codigo' => 'Codigo del usuario que puede usar la licencia',
			'lic_codigo' => 'Codigo de la licencia',
			'lic_precio' => 'Precio de la licencia',
			'lic_esgratuita' => 'Licencia gratis',
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

		$criteria->compare('lic_id',$this->lic_id,true);
		$criteria->compare('lic_fechacreacion',$this->lic_fechacreacion,true);
		$criteria->compare('lic_fechaedicion',$this->lic_fechaedicion,true);
		$criteria->compare('lic_duracion',$this->lic_duracion,true);
		$criteria->compare('lic_fechavencimiento',$this->lic_fechavencimiento,true);
		$criteria->compare('lic_activa',$this->lic_activa,true);
		$criteria->compare('lic_emp_codigo',$this->lic_emp_codigo);
		$criteria->compare('lic_usr_codigo',$this->lic_usr_codigo);
		$criteria->compare('lic_precio',$this->lic_precio);
		$criteria->compare('lic_codigo',$this->lic_codigo,true);
		$criteria->compare('lic_esgratuita',$this->lic_esgratuita,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Licencia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * Se ejecuta antes de guardar
	 */ 
	protected function beforeSave(){
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {				
				$this->setAttribute('lic_activa',1);	
				$this->setAttribute('lic_codigo',$this->_crearCodigoLicencia());															
			}			
			$intDuracionLicencia = (int)$this->getAttribute('lic_duracion');
			$fechaVencimiento = new DateTime($this->getAttribute('lic_fechacreacion'));
			$fechaVencimiento->add(new DateInterval('P'.$intDuracionLicencia.'D'));				
			$this->setAttribute('lic_fechavencimiento',$fechaVencimiento->format('Y-m-d'));	
			$this->setAttribute('lic_fechaedicion',date('Y-m-d H:i:s'));				
			return TRUE;
		}
		else return false;
	}
	
	protected function _crearCodigoLicencia()
	{
		$tamanioLicencia =  $this->_tamanioCodigoLicencia;
		$strLicencia = '';
		$licenciaValida = false;
		while ($licenciaValida === false) {
			while ($tamanioLicencia > 0) {
				if (empty($strLicencia)) {
					$strLicencia .= $this->_generateRandom($this->_tamanioTrozosCodigoLicencia);		
				} else {				
					$strLicencia .= $this->_separadorTrozos.$this->_generateRandom($this->_tamanioTrozosCodigoLicencia);		
				}			
				$tamanioLicencia = $tamanioLicencia - $this->_tamanioTrozosCodigoLicencia;
			}
			$infoLicencia = $this->findByAttributes(array('lic_codigo'=>$strLicencia));
			if (!$infoLicencia) {
				$licenciaValida = true;
			}
		}
		return $strLicencia;
	}
	
	private function _generateRandom($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'){				 
		$randString = '';
		$count = strlen($charset);
		while ($length--) {
			$randString .= $charset[mt_rand(0, $count-1)];
		}
		return $randString;
	}
	
	public function tieneLicenciasLibres($intCodigoEmpresa=0)
	{
		$tieneLicenciasLibres = false;
		if($intCodigoEmpresa === 0) {
			$intCodigoEmpresa = (int)$this->getAttribute('lic_emp_codigo');
		}
		if ($intCodigoEmpresa > 0) {		    
			$criteria = new CDbCriteria;
			$criteria->compare('lic_emp_codigo',$intCodigoEmpresa); 
			$criteria->compare('lic_activa',1); 			
			$criteria->compare('lic_fechavencimiento','>='.date('Y-m-d H:i:s')); 	
			$licencia = $this->find($criteria);
			if ($licencia) {
				$tieneLicenciasLibres = true;
			}
		}		
		return $tieneLicenciasLibres;
	}
	public function tieneConexionesLibres($licencia,$intCodigoEmpresa=0)
	{
	    $tieneConexionesLibres = false;
	    if($intCodigoEmpresa === 0) {
	        $intCodigoEmpresa = (int)$this->getAttribute('lic_emp_codigo');
	    }	    
	    if ($intCodigoEmpresa > 0) {
	        $empleados =  Empleado::model()->findByAttributes(
                array(
                    'emp_emp_codigo' => $intCodigoEmpresa
                )
            );
	        
	        $criteria = new CDbCriteria;
	        $criteria->compare('lic_emp_codigo',$intCodigoEmpresa);
	        $criteria->compare('lic_activa',1);
	        $criteria->compare('lic_fechavencimiento','>='.date('Y-m-d H:i:s'));
	        $licencia = $this->find($criteria);
	        if ($licencia->getAttribute('numerousuariosconectados') > count($empleados)) {
	            $tieneConexionesLibres = true;
	        }
	    }
	    return $tieneConexionesLibres;
	}
	/**
	 * Se ejecuta cuando se elimina un empleado y un usuario 
	 */
	public function eliminarYCrearLicencia($inCodigoUsuario, $intCodigoEmpresa)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('lic_usr_codigo','=:'.$inCodigoUsuario); 
		$criteria->compare('lic_emp_codigo','=:'.$intCodigoEmpresa);
		$criteria->compare('lic_activa','=:1'); 				
		$licencia = $this->find($criteria);
		$intCodigoLicencia = $licencia->getAttribute('lic_id');
		if ($licencia) {
			$licencia->setAttribute('lic_id',null);
			$licencia->setAttribute('lic_usr_codigo',0);
			$licencia->isNewRecord = true;
			if ($licencia->save()) {
				$licencia->setAttribute('lic_id',$intCodigoLicencia);
				$licencia->delete();
			}									
		}
	}
}
