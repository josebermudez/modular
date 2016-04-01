<?php
class NotificacionContratoWidget extends CWidget {
 
    public $intEmpresa;
    public $intEmpleado;    
 
	public function init(){
		parent::init();		
	}
 
    public function run() {		
		if (Yii::app()->user->checkAccess('notificacionvencimientocontrato')) {
			$arrContratos = array();		
			$criteria=New CDbCriteria;		
			if((int)$this->intEmpleado > 0) {
				$criteria->compare('con_emp_id', $this->intEmpleado);			
			} elseif((int)$this->intEmpresa > 0) {
				$criteria->with = array('empleado');
				$criteria->compare('emp_emp_codigo', $this->intEmpresa);					
			} elseif((int)Yii::app()->user->getState('empresa') > 0)  {
				$criteria->with = array('empleado');
				$criteria->compare('emp_emp_codigo', (int)Yii::app()->user->getState('empresa'));
			}		
			$arrContratos=Contrato::model()->findAll(
				$criteria
			);		
			$arrContratosVencidos = array();
			foreach($arrContratos as $contrato) {
				if ($contrato->proximoAVencer() === true && (int)$contrato->getAttribute('con_terminado') === 0) {
					$urlContrato = Yii::app()->createUrl('empleado/contrato/admin',array('id'=>$contrato->empleado->getAttribute('emp_codigo')));
					$fechaFormateada = $contrato->getAttribute('con_fechainicio');                
					$mensajeProximoAVencer = Yii::t('general','El contrato con inicio').' '.$fechaFormateada.' '.Yii::t('general','esta a cerca a vencerse').' <a href="'.$urlContrato.'">'.Yii::t('general','Ir').'</a>';
					$mensajeVencido = Yii::t('general','El contrato con inicio').' '.$fechaFormateada.' '.Yii::t('general','esta vencido');
					if((int)$this->intEmpresa > 0) {
						$mensajeProximoAVencer = Yii::t('general','El empleado ').' '.$contrato->empleado->getAttribute('emp_nombre').' '.Yii::t('general','tiene contratos cerca a vencerse').' <a href="'.$urlContrato.'">'.Yii::t('general','Ir').'</a>';
						$mensajeVencido = Yii::t('general','El empleado').' '.$contrato->empleado->getAttribute('emp_nombre').' '.Yii::t('general','tiene contratos vencidos').' <a href="'.$urlContrato.'">'.Yii::t('general','Ir').'</a>';
					}				
					$arrContratosVencidos[] = array(
						'id'=>$contrato->getAttribute('con_id'),
						'mensajeProximoVencer'=>$mensajeProximoAVencer,
						'mensajeVencido'=>$mensajeVencido,
						'fechaVencimiento'=>$contrato->getAttribute('con_fechafin'),
						'intervaloNegativo'=>(bool)$contrato->getTipoIntervalo(),
						'fechaInicio'=>$contrato->getAttribute('con_fechainicio'),
						
					);
				}
			}
			$this->render('contratowidget/alertasvencimiento',array(
				'arrContratosVencidos'=>$arrContratosVencidos,							
			));		
		}		      
    }
}
