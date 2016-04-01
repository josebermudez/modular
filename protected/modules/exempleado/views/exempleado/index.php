<?php
/* @var $this ExempleadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Exempleados',
);

$this->menu=array(
	array('label'=>'Create Exempleado', 'url'=>array('create')),
	array('label'=>'Manage Exempleado', 'url'=>array('admin')),
);
?>

<h1>Exempleados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
