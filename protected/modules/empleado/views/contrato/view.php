<?php
$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	$model->con_id,
);

$this->menu=array(
array('label'=>Yii::t('general','Create Contrato'),'url'=>array('create')),
array('label'=>Yii::t('general','Update Contrato'),'url'=>array('update','id'=>$model->con_id)),
array('label'=>Yii::t('general','Manage Contrato'),'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('general','View Contrato');?> #<?php echo $model->con_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'con_id',
		'con_fechainicio',
		'con_fechafin',
		'con_documento',
		'con_contenido',
		'con_avisarvencimiento',
		'con_avisarantesde',
		'con_avisarjefe',
		'con_avisarempleado',
		'con_fechacreacion',
		'con_fechaedicion',
		'con_enviarcorreelectronico',
		'con_for_id',
		'con_emp_id',
		'con_esindefinido',
		'con_emr_codigo',
		'con_terminado',
		'con_documentooriginal',
),
)); ?>
