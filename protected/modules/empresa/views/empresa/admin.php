<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar empresas', 'url'=>array('index')),
	array('label'=>'Crear empresa', 'url'=>array('create')),
);

?>

<h1>Administrar empresas</h1>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>

<?php 
	$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'empresa-grid',
	'dataProvider'=>$model->search(),
	'summaryText'=>Yii::t('general','Mostrando').' {start}-{end} '.Yii::t('general','de').' {count} '.Yii::t('general','resultados').'.',
	'filter'=>$model,
	'columns'=>array(
		'emp_codigo',
		'emp_nombre',		
		'emp_direccion',
		'emp_telefono',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'template'=>'{update}',
		),	
	),
)); ?>
