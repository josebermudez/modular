<?php
$urlAreaVentas =  Yii::app()->createUrl('ventas/index');
$urlLogin =  Yii::app()->createUrl('cruge/ui/login');
if ((bool)$boolLicenciaActiva === false) {
Yii::app()->user->setFlash('error',
        'Su <strong>licencia</strong> está inactiva si desea activarla comuníquese con el <a href="'.$urlAreaVentas.'">área de ventas</a>');
$this->widget('bootstrap.widgets.TbAlert');

Yii::app()->clientScript->registerScript("licenciainactiva", '
		js:bootbox.dialog("'.'
		<div data-spy="affix" data-offset-top="200">'.Yii::t('general','Su licencia está inactiva').'</div>');
Yii::app()->user->logout();
Yii::app()->clientScript->registerScript("licenciainactiva", '
        
		window.setTimeout(function(){ window.location.replace("'.$urlLogin.'"); }, 2000);
	');

}
?>
<?php
if((bool)$boolLicenciaUsuarioActiva === false) {
	Yii::app()->clientScript->registerScript("licencianopermitida", '		
		js:bootbox.dialog("'.'
		<div data-spy="affix" data-offset-top="200">'.Yii::t('general','Su licencia no es valida o esta vencida').'</div>');							
	    Yii::app()->user->logout();
	    Yii::app()->clientScript->registerScript("licencianopermitida", '	
		window.setTimeout(function(){ document.location.reload(true); }, 2000);
	');
	
}
?>
<?php
if((bool)$boolTieneConexionesLibres === false) {    
    Yii::app()->user->setFlash('error',
       'Ha <strong>sobrepasado el número de licencias</strong> para conexión de usuarios, si desea comprar mas licencias comuníquese con el <a href="'.$urlAreaVentas.'">área de ventas</a>');     
    $this->widget('bootstrap.widgets.TbAlert');        
}
?>




