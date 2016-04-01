<?php
/* @var $this EmpleadoController */
/* @var $data Empleado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->emp_codigo), array('view', 'id'=>$data->emp_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->emp_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_numerodocumento')); ?>:</b>
	<?php echo CHtml::encode($data->emp_numerodocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_tipodocumento')); ?>:</b>
	<?php echo CHtml::encode($data->emp_tipodocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->emp_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_telefonofijo')); ?>:</b>
	<?php echo CHtml::encode($data->emp_telefonofijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_telefonomovil')); ?>:</b>
	<?php echo CHtml::encode($data->emp_telefonomovil); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_estado')); ?>:</b>
	<?php echo CHtml::encode($data->emp_estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_emp_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->emp_emp_codigo); ?>
	<br />

	*/ ?>

</div>