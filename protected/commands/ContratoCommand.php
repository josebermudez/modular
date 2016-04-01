<?php
class ContratoCommand extends CConsoleCommand
{
	/**
	 * Notifica via email los vencimientos
	 * de los contratos, la notificación solo se envia
	 * una vez en el día y durante el número de días configurado
	 * en em main 	 
	 */
    public function actionNotificaVencimiento() {
		$arrContratos = Contrato::model()->findAll();
		foreach ($arrContratos as $objContrato) {
			if ($objContrato->proximoAVencer() === true) {				
				//candidato a enviar aviso por correo electronico
				$this->_enviarAvisoCorreoElectronico($objContrato);
			}
		}
		Yii::log('Proceso ejecutado correctamente', 'trace');
	}
    public function actionInit() {  }
    /**
     * Envio una notificacion via correoelectronico
     * sobre el vencimiento de un contrato     
     */
    private function _enviarAvisoCorreoElectronico($objContrato)
    {
		$enviarAJefe = (int)$objContrato->getAttribute('con_avisarjefe');
		$enviarAEmpleado = (int)$objContrato->getAttribute('con_avisarempleado');
		$enviarCorreoElec = (int)$objContrato->getAttribute('con_enviarcorreelectronico');
		$contratoTerminado = (int)$objContrato->getAttribute('con_terminado');
		if ($contratoTerminado === 0) {
			if ($enviarCorreoElec === 1) {
				if($enviarAJefe === 1) {
					$this->_enviarAvisoJefe($objContrato);
				}
				if($enviarAEmpleado === 1) {
					$this->_enviarAvisoEmpleado($objContrato);
				}
			} else {
				Yii::log('El contrato: '.$objContrato->getAttribute('con_id').' no tiene activo el envio de correo electronico para los avisos', 'trace');
			}
		} else {
			Yii::log('El contrato: '.$objContrato->getAttribute('con_id').' esta terminado y no se envia aviso', 'trace');
		}
	}
	/**
	 * Envia un correo electronico con la informaciíon
	 * del vencimiento del contrato al empleado
	 * dueño del contrato
	 */
	private function _enviarAvisoEmpleado($objContrato) {
		$objEmpleado = $objContrato->empleado;
		$objEmpresa = $objEmpleado->empresa;		
		if ($this->_cumpleNumeroNotificaciones($objEmpleado, $objContrato) && $this->_cumpleTiempoEnvioJefe($objEmpleado,$objContrato) && !$this->_yaSeEnvioHoy($objEmpleado, $objContrato)) {						
			$emailEmpleado = $objEmpleado->getAttribute('emp_email');
			if( !empty($emailEmpleado) ) {
				$mail = new YiiMailerModular();
				$mail->setView($this->_getVistaRecordatorioEmpleado($objEmpresa));
				$mail->setData(array('objContrato' => $objContrato ));
				$mail->setFrom(Yii::app()->params['appEmail'], Yii::app()->params['appEmailNombre']);
				$mail->setTo($emailEmpleado);
				$mail->setSubject(Yii::t('general','Recordatorio de vencimiento contrato empleado').': '.CHtml::encode($objEmpleado->getAttribute('emp_nombre')));										
				if ($mail->send()) {
					Yii::log('Se envió email a : '.$emailEmpleado, 'trace');
					$notificacion = new Notificacionxcontrato();
					$notificacion->setAttribute('nxc_con_id',$objContrato->getAttribute('con_id'));
					$notificacion->setAttribute('nxc_notificacionemail',1);
					$notificacion->setAttribute('nxc_notificacionnormal',0);
					$notificacion->setAttribute('nxc_usr_codigo',$objEmpleado->getAttribute('emp_usr_codigo'));
					$notificacion->setAttribute('nxc_email',$emailEmpleado);
					$notificacion->setAttribute('nxc_contenidoemail',$mail->save());
					$notificacion->save();
				} else {					
					Yii::log('No se pudo enviar email a : '.$emailEmpleado. 'error:'.$mail->getError(), 'trace');					
				}
			}
		}
	}
	/**
	 * Envia un correo electronico con la informaciíon
	 * del vencimiento del contrato al jefe de 
	 * empleados	 
	 */
	private function _enviarAvisoJefe($objContrato) {
		$objEmpleado = $objContrato->empleado;
		$objEmpresa = $objEmpleado->empresa;
		$urlSistemaContratos = Yii::app()->createAbsoluteUrl('empleado/empleado/update/id/'.$objEmpleado->getAttribute('emp_codigo'), array(), 'https');		
		if ($objEmpresa->jefepersonal && $this->_cumpleNumeroNotificaciones($objEmpresa->jefepersonal, $objContrato) && !$this->_yaSeEnvioHoy($objEmpresa->jefepersonal, $objContrato)) {			
			$objJefePersonal = $objEmpresa->jefepersonal;			
			$emailJefePersonal = $objJefePersonal->getAttribute('emp_email');
			if( !empty($emailJefePersonal) ) {
				$mail = new YiiMailerModular();
				$mail->setView('recordatoriovencecontratojefe');
				$mail->setData(array('objContrato' => $objContrato, 'urlSistemaContratos' => $urlSistemaContratos ));
				$mail->setFrom(Yii::app()->params['appEmail'], Yii::app()->params['appEmailNombre']);
				$mail->setTo($emailJefePersonal);
				$mail->setSubject(Yii::t('general','Recordatorio de vencimiento contrato empleado').': '.CHtml::encode($objEmpleado->getAttribute('emp_nombre')));										
				if ($mail->send()) {
					Yii::log('Se envió email a : '.$emailJefePersonal, 'trace');
					$notificacion = new Notificacionxcontrato();
					$notificacion->setAttribute('nxc_con_id',$objContrato->getAttribute('con_id'));
					$notificacion->setAttribute('nxc_notificacionemail',1);
					$notificacion->setAttribute('nxc_notificacionnormal',0);
					$notificacion->setAttribute('nxc_usr_codigo',$objJefePersonal->getAttribute('emp_usr_codigo'));
					$notificacion->setAttribute('nxc_email',$emailJefePersonal);
					$notificacion->setAttribute('nxc_contenidoemail',$mail->save());
					$notificacion->save();
				} else {					
					Yii::log('No se pudo enviar email a : '.$emailJefePersonal. 'error:'.$mail->getError(), 'trace');					
				}
			}
		}
	}
	/**
	 * Verifica si ya se envio un email del vencimiento 
	 * del contrato al empleado que llega por parametro
	 * 
	 */
	private function _yaSeEnvioHoy($objEmpleado, $objContrato) 
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'nxc_fechacreacion>=:fecha';
		$criteria->params = array(':fecha'=>date('Y-m-d 00:00:00'));		
		$criteria->compare('nxc_usr_codigo',$objEmpleado->getAttribute('emp_usr_codigo'),false);
		$criteria->compare('nxc_notificacionemail',1,false);
		$criteria->compare('nxc_con_id',$objContrato->getAttribute('con_id'),false);		
		$notificacion = Notificacionxcontrato::model()->find($criteria);	
		if ($notificacion) {			
			Yii::log('El día de hoy '.date('Y-m-d H:i:s').' ya se envió un email (notificacionxcontrato='.$notificacion->getAttribute('nxc_id').') a : '.$objEmpleado->getAttribute('emp_email').', usuario: '.$objEmpleado->getAttribute('emp_usr_codigo').', contrato:'.$objContrato->getAttribute('con_id'), 'trace');
			return true;
		}
		return false;
	}
	/**
	 * Verifica el número de notificaciones enviadas al mes
	 */ 
	private function _cumpleNumeroNotificaciones($objEmpleado, $objContrato)
	{
		$criteria=new CDbCriteria;
		$criteria->condition = 'nxc_fechacreacion>=:fecha';
		$criteria->params = array(':fecha'=>date('Y-m-01 00:00:00'));		
		$criteria->compare('nxc_usr_codigo',$objEmpleado->getAttribute('emp_usr_codigo'),false);
		$criteria->compare('nxc_notificacionemail',1,false);
		$criteria->compare('nxc_con_id',$objContrato->getAttribute('con_id'),false);		
		$notificaciones = Notificacionxcontrato::model()->findAll($criteria);	
		if ($notificaciones && count($notificaciones) >= Yii::app()->params['numerodiasnotificacionvencimiento']) {						
			Yii::log('El usuario '.$objEmpleado->getAttribute('emp_usr_codigo').' cumplio con el número máximo de notficaciones: '.Yii::app()->params['numerodiasnotificacionvencimiento'],'trace');
			return false;
		}
		return true;
	}
	/**
	 * Verifica si durante un numero de horas 
	 * no se ha enviado una notificacion
	 *  
	 */
	private function _cumpleTiempoEnvioJefe($objEmpleado,$objContrato) {
		$criteria=new CDbCriteria;
		$fecha = new DateTime(date('Y-m-d H:i:s'));		
		$haceSeisHoras = $fecha->sub(new DateInterval('PT'.Yii::app()->params['tiempohorasparaenviarrecordatorioempleado'].'H'));		
		$criteria->condition = 'nxc_fechacreacion<=:fecha';
		$criteria->params = array(':fecha'=>$haceSeisHoras->format('Y-m-d H:i:s'));				
		$criteria->compare('nxc_notificacionemail',1,false);
		$criteria->compare('nxc_con_id',$objContrato->getAttribute('con_id'),false);		
		$notificaciones = Notificacionxcontrato::model()->findAll($criteria);	
		if ($notificaciones) {						
			return false;
		}
		return true;		
	}
	
	private function _getVistaRecordatorioEmpleado($objEmpresa)
	{		
		return 'recordatoriovencecontratoempleado';
	}
}
