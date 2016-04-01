<?php
/* @var $this CiudadController */
/* @var $data Ciudad */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciu_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ciu_codigo), array('view', 'id'=>$data->ciu_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciu_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->ciu_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exm_fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->exm_fechacreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciu_est_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->ciu_est_codigo); ?>
	<br />


</div>