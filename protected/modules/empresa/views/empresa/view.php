<?php
/* @var $this EmpresaController */
/* @var $model Empresa */

$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->emp_nombre,
);

$this->menu=array(	
	array('label'=>'Crear empresa', 'url'=>array('create')),
	array('label'=>'Actualizar empresa', 'url'=>array('update', 'id'=>$model->emp_codigo)),
	array('label'=>'Borrar empresa', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->emp_codigo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar empresa', 'url'=>array('admin')),
);
?>

<h1>Ver empresa <i><?php echo $model->emp_nombre; ?></i></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
		'emp_nombre',		
		'emp_direccion',
		'emp_telefono',
		array(
			'name'=>'centrosmedicos',
			'type'=>'html',
			'value'=>$model->listaCentrosMedicos,
			//'value'=>CHtml::link(CHtml::encode($model->artikels->name),array('artikel/view','id'=>$model->artikels->id)),
			//'value'=>CHtml::listData(Artikel::model()->findAll(), 'id', 'name'),
		),
		array(
			'name'=>'empleados',
			'type'=>'html',
			'value'=>$model->listaEmpleados,
			//'value'=>CHtml::link(CHtml::encode($model->artikels->name),array('artikel/view','id'=>$model->artikels->id)),
			//'value'=>CHtml::listData(Artikel::model()->findAll(), 'id', 'name'),
		),
		array(
			'name'=>'exempleados',
			'type'=>'html',
			'value'=>$model->listaExempleados,
			//'value'=>CHtml::link(CHtml::encode($model->artikels->name),array('artikel/view','id'=>$model->artikels->id)),
			//'value'=>CHtml::listData(Artikel::model()->findAll(), 'id', 'name'),
		),

	),
)); ?>
