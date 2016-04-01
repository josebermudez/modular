<?php
/* @var $this ExempleadoController */
/* @var $model Exempleado */

$this->breadcrumbs=array(
	'Ex-empleado'=>array('index'),
	$model->empleado->emp_numerodocumento,
);

$this->menu=array(	
	array('label'=>'Crear ex-empleado', 'url'=>array('create')),
	array('label'=>'Actualizar ex-empleado', 'url'=>array('update', 'id'=>$model->exm_codigo)),
	array('label'=>'Borrar ex-empleado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->exm_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar ex-empleado', 'url'=>array('admin')),
);
?>

<h1>Ver ex-empleado <?php echo $model->empleado->emp_numerodocumento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'exm_fechacreacion',
		'empleado.empresa.emp_nombre',
		'empleado.emp_numerodocumento',
		'empleado.emp_email',
		'empleado.emp_direccion',
		'empleado.emp_telefonofijo',		
		'exm_motivo',		
	),
)); ?>
