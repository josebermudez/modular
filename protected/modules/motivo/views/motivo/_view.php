<?php
/* @var $this MotivoController */
/* @var $data Motivo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mot_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mot_codigo), array('view', 'id'=>$data->mot_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mot_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->mot_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mot_fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->mot_fechacreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mot_emp_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->mot_emp_codigo); ?>
	<br />


</div>