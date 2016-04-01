<?php

class EmpleadoWidget extends CWidget {
 
    public $crumbs = array();
    public $delimiter = ' / ';
 
    public function run() {
		
		$model=Empleado::model()->findByAttributes(array(
				'emp_usr_codigo'=>Yii::app()->user->id,
				'emp_emp_codigo'=>Yii::app()->user->getState('empresa')
			)
		);		
		$model->scenario = 'completardatos';	
		if(isset($_POST['Empleado']))
		{
			$usuario = Yii::app()->user->um->loadUserById($model->getAttribute('emp_usr_codigo'), true);
			$model->attributes=$_POST['Empleado'];
			$model->setAttribute('emp_estado','A');
			if($model->save()) {
				$strEmail = $model->getAttribute('emp_email');				
				$usuario->email= $strEmail;
				$numeroDocumento = $model->getAttribute('emp_numerodocumento');
				Yii::app()->user->setState('empresa',$model->getAttribute('emp_emp_codigo'));
				if (empty($strEmail)) {
					$usuario->email = 'usuario_'.$numeroDocumento.'@modular.com.co';
				}	
							
				Yii::app()->user->um->save($usuario,'update');
					
			}
		}	
		if ($model) {
			$this->render('update',array(
				'model'=>$model,							
			));
		}										      
    }
 
}
?>
