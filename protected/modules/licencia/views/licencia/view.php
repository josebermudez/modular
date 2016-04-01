<?php
$this->breadcrumbs=array(
	'Licencias'=>array('index'),
	$model->lic_id,
);

$this->menu=array(
array('label'=>Yii::t('general','Create Licencia'),'url'=>array('create')),
array('label'=>Yii::t('general','Update Licencia'),'url'=>array('update','id'=>$model->lic_id)),
array('label'=>Yii::t('general','Manage Licencia'),'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('general','View Licencia');?> #<?php echo $model->lic_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'lic_id',
		'lic_fechacreacion',
		'lic_fechaedicion',
		'lic_duracion',
		'lic_fechavencimiento',
		'lic_activa',
		'lic_emp_codigo',
		'lic_usr_codigo',
		'lic_codigo',
		'lic_precio',
		'lic_esgratuita',
),
)); ?>
