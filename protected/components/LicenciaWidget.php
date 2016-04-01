<?php
class LicenciaWidget extends CWidget {
 
    public $intEmpresa;
    public $intUsuario;    
 
	public function init(){
		parent::init();		
	}
 
    public function run() {
		if (Yii::app()->user->checkAccess('notificacionlicencia')) {
			
			$boolLicenciaUsuarioActiva = true;	
			$boolLicenciaActiva = true;
			if((int)Yii::app()->user->getState('empresa') > 0) {	
				$boolLicenciaActiva = Licencia::model()->tieneLicenciasLibres(Yii::app()->user->getState('empresa'));
				$boolTieneConexionesLibres = Licencia::model()->tieneConexionesLibres(Yii::app()->user->getState('empresa'));
			}
			if((!Yii::app()->user->isSuperAdmin && !Yii::app()->user->isGuest ) && (int)$this->intUsuario > 0) {
				//verifica la información de la licencia del usuario
				$licenciaActiva = Licencia::model()->findByAttributes(
					array(
						'lic_usr_codigo'=>$this->intUsuario,
						'lic_activa' => 1
					)
				);	
				if(!$licenciaActiva) {
					$boolLicenciaUsuarioActiva = false;
				}					
				
			}
			
			
			
			$this->render('licenciawidget/alertaslicencia',array(
				'boolLicenciaActiva'=>$boolLicenciaActiva,
				'boolLicenciaUsuarioActiva' => $boolLicenciaUsuarioActiva,
			    'boolTieneConexionesLibres'=>$boolTieneConexionesLibres    
			));						      
		}
	}
}
