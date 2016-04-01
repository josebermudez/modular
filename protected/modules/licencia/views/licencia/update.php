<?php
$this->breadcrumbs=array(
	'Licencias'=>array('index'),
	$model->lic_id=>array('view','id'=>$model->lic_id),
	Yii::t('general','Update'),
);

	$this->menu=array(
	array('label'=>Yii::t('general','List Licencia'),'url'=>array('index')),
	array('label'=>Yii::t('general','Create Licencia'),'url'=>array('create')),
	array('label'=>Yii::t('general','View Licencia'),'url'=>array('view','id'=>$model->lic_id)),
	array('label'=>Yii::t('general','Manage Licencia'),'url'=>array('admin')),
	);
	?>

	<h1><?php echo Yii::t('general','Update Licencia <?php echo $model->lic_id; ?> ');?> </h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>