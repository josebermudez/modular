<?php
/* @var $this CentromedicoController */
/* @var $model Afiliado */

$this->breadcrumbs=array(
	Yii::t('general','Centros médicos')=>array('index'),
	$model->afi_nombre,
);

$this->menu=array(	
	array('label'=>Yii::t('general','Crear centros medicos'), 'url'=>array('create')),
	array('label'=>Yii::t('general','Actualizar centro medico'), 'url'=>array('update', 'id'=>$model->afi_codigo)),
	array('label'=>Yii::t('general','Borrar centro medico'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->afi_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('general','Administrar centro medico'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('general','Ver centro médico'); ?> <i><?php echo $model->afi_nombre; ?></i></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'afi_nombre',
		'afi_direccion',
		'afi_telefonos',
		'afi_numerodocumento',
		'afi_tipodocumento',
		'afi_tipo',
		'afi_horarios',		
		'ciudad.ciu_nombre',
		array(
			'name'=>'empresas',
			'type'=>'html',
			'value'=>$model->listaEmpresas,			
		),
	),
)); ?>
