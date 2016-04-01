<?php
$this->breadcrumbs=array(
	'Licencias',
);

$this->menu=array(
array('label'=>'Create Licencia','url'=>array('create')),
array('label'=>'Manage Licencia','url'=>array('admin')),
);
?>

<h1>Licencias</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
