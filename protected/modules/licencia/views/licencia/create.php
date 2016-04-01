<?php
$this->breadcrumbs=array(
	'Licencias'=>array('index'),
	Yii::t('general','Create'),
);

$this->menu=array(
array('label'=>Yii::t('general','List Licencia'),'url'=>array('index')),
array('label'=>Yii::t('general','Manage Licencia'),'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('general','Create Licencia');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>