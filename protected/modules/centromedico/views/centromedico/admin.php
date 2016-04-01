<?php
/* @var $this CentromedicoController */
/* @var $model Afiliado */

$this->breadcrumbs=array(
	Yii::t('general','Centros médicos')=>array('index'),
	Yii::t('general','Administrar'),
);

$this->menu=array(	
	array('label'=>Yii::t('general','Crear centro médico'), 'url'=>array('create')),
);

?>

<h1><?php echo Yii::t('general','Administrar centros médicos'); ?></h1>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>


<?php 
//asigna el tipo para los centros médicos
$model->setAttribute("afi_tipo",1);
if (!Yii::app()->user->isSuperAdmin) {
	$columns = array(		
		'afi_nombre',
		'afi_numerodocumento',		
		'afi_direccion',
		'afi_telefonos',		
		/*
		'afi_tipo',
		'afi_horarios',
		'afi_ciu_codigo',
		*/
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),            
        ),
	);
}else{
	$columns = array(		
		'afi_nombre',
		'afi_numerodocumento',		
		'afi_direccion',
		'afi_telefonos',		
		'afi_telefonos',		
		array(
			'filter'=>false,
			'name'=>'empresas',
			'type'=>'html',
			'value'=>'$data->listaEmpresas',			
		),
		/*
		'afi_tipo',
		'afi_horarios',
		'afi_ciu_codigo',
		*/
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),            
        ),
	);
}
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'afiliado-grid',
	'summaryText'=>Yii::t('general','Mostrando').' {start}-{end} '.Yii::t('general','de').' {count} '.Yii::t('general','resultados').'.',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=> $columns,
)); ?>
