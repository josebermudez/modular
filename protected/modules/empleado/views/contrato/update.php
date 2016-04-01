<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	Yii::t('general','Contratos')=>array('index'),
	$model->con_id=>array('view','id'=>$model->getAttribute('con_id')),
	Yii::t('general','Actualizar'),
);

$this->menu=array(	
	array('label'=>Yii::t('general','Crear contrato'), 'url'=>array('create','empleado'=>$model->getAttribute('con_emp_id'))),
	array('label'=>Yii::t('general','Ver contrato'), 'url'=>array('view', 'id'=>$model->getAttribute('con_id'))),
	array('label'=>Yii::t('general','Administrar contrato'), 'url'=>array('admin','id'=>$model->getAttribute('con_emp_id'))),
);
?>

<h1><?php echo Yii::t('general','Actualizar Contrato'); ?> <?php echo $model->con_id; ?></h1>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
