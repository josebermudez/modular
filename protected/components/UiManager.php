<?php

 class UiManager extends CApplicationComponent {
	public function init(){
			parent::init();
	}
	public function getCurrentUserNames(){
			return Yii::app()->user->email;
	}

	public function getMenuCurrentUser(){
			if(!Yii::app()->user->isGuest){
					return array(
							'label'=>$this->currentUserNames,
							'class'=>'bootstrap.widgets.TbBootMenu',
							'items'=>array(
									array('label'=>'Editar mi Perfil','icon'=>'user'
											, 'url'=>Yii::app()->user->ui->editProfileUrl),
									array('label'=>'Cerrar Sesion','icon'=>'off'
											, 'url'=>Yii::app()->user->ui->logoutUrl),
							),
					);
			}else{
					return array('label'=>'Iniciar Sesion','url'=>Yii::app()->user->ui->loginUrl);
			}
	}

	public function getMenuAdministradorUsuarios()
	{

			if(!Yii::app()->user->isSuperAdmin)
					return array();

			return array(
					array('label'=>'Usuarios', 'url'=>'#', 'items'=>Yii::app()->user->ui->adminItems),
			);
	}
	
	public function getMenuEmpresasUsuarios(){
				 
			 $listaEmpresas = array();
			//obitiene la lista de empresas del usuario
			$arrListaEmpresas=Empleado::misEmpresas();     
			if(count($arrListaEmpresas) > 1 || Yii::app()->user->isSuperAdmin){
				$listaEmpresas['label']="Cambiar empresa";
				$listaEmpresas['url']='#';								
				$listaEmpresas['items']=array();								
				foreach($arrListaEmpresas as $empresa){
					if(Yii::app()->user->getState('empresa') === $empresa->getAttribute("emp_codigo")){
						$listaEmpresas['items'][]=array(
							'label'=>$empresa->getAttribute("emp_nombre"),
							'icon'=>'ok',
							'url'=>'#'
						);
					}else{
						$listaEmpresas['items'][]=array(
							'label'=>$empresa->getAttribute("emp_nombre"),											
							'url'=>array('/site/cambiarEmpresa',"id"=>$empresa->getAttribute("emp_codigo"))
						);
					}
				}
			}else{
				return array();
			}
			//print_r(array($listaEmpresas));die;
			return array($listaEmpresas);                               
	}

	public function getMenuFuncionarios(){						
					return
			Yii::app()->user->rbac->getMenu();                                                       
	}
	public function getMenuHome(){
		
		$itemsGenerales = array(
			array('label'=>Yii::t("general","About us"),'url'=>Yii::app()->createUrl('/site/aboutus')),
			array('label'=>Yii::t("general","Services"),'url'=>Yii::app()->createUrl('/site/services')),
			array('label'=>Yii::t("general","Contact"),'url'=>Yii::app()->createUrl('/site/contact')),						
		);						
		if(!Yii::app()->user->isGuest){
			$itemsGenerales[] = array('label'=>Yii::t('general','Panel gestión')
									,'url'=>Yii::app()->createUrl('/site/welcome'));
			$itemsGenerales[] = array('label'=>Yii::t('general','Cerrar sesión')
								,'url'=>Yii::app()->user->ui->logoutUrl);										
		}else{
			$itemsGenerales[] = array('label'=>Yii::t('general','Iniciar sesión')
								, 'url'=>Yii::app()->user->ui->loginUrl);					
		}
		return $itemsGenerales;
	}
					
					
}
    ?>

