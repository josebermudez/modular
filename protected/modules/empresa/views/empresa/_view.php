<?php
/* @var $this EmpresaController */
/* @var $data Empresa */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->emp_codigo), array('view', 'id'=>$data->emp_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->emp_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->emp_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_telefono')); ?>:</b>
	<?php echo CHtml::encode($data->emp_telefono); ?>
	<br />


</div>