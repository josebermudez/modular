<?php

	$this->widget('application.components.NotificacionContratoWidget', array(
			'intEmpresa'=>0,
			'intEmpleado'=>(int)$modelEmpleado->getAttribute('emp_codigo')
		)
	);
	$this->widget('application.components.EmpleadoWidget', array(
	  'crumbs' => array(
		array('name' => 'Home', 'url' => array('site/index')),
		array('name' => 'Login'),
	  ),
		'delimiter' => ' &rarr; ', // if you want to change it
)); 
?>
<?php

$this->breadcrumbs=array(
	'Motivos'=>array('index'),
	'Administrar',
);
//por cada uno de los motivos crea un tab
$arrTabs = array();
foreach($arrlistaMotivos as $key => $motivo){
	$active = false;
	if($key===0){
		$active = true;
	}
	$arrTabs[]= array(
		'label'=>$motivo->getAttribute('mot_nombre'), 
		'content'=>$this->renderPartial('datosmotivo', 
			array('model'=>$motivo),true,false
		), 'active'=>$active
	);
}
?>
<h1>Panel de gestión</h1>
<?php Yii::app()->user->setFlash('warning', '<strong>Atenci&oacute;n!</strong> Digitalizar y subir el certificado obtenido en el centro m&eacute;dico, inmediatamente despu&eacute;s de realizado el examen.'); ?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>
<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'left', // 'above', 'right', 'below' or 'left'
    'tabs'=>$arrTabs,
    //'htmlOptions' => array('style'=>'float:left')
)); 

?>
