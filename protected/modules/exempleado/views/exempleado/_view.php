<?php
/* @var $this ExempleadoController */
/* @var $data Exempleado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('exm_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->exm_codigo), array('view', 'id'=>$data->exm_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exm_emp_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->exm_emp_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exm_fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->exm_fechacreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exm_motivo')); ?>:</b>
	<?php echo CHtml::encode($data->exm_motivo); ?>
	<br />


</div>