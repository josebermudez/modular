<?php
/* @var $this CartasgeneradasController */
/* @var $data Cartasgeneradas */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cge_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cge_codigo), array('view', 'id'=>$data->cge_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cag_emp_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->cag_emp_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cag_usr_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->cag_usr_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cag_empr_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->cag_empr_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cag_archivo')); ?>:</b>
	<?php echo CHtml::encode($data->cag_archivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cag_fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->cag_fechacreacion); ?>
	<br />


</div>