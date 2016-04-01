<?php
/* @var $this AdministradorController */
/* @var $data Administrador */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('adm_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->adm_codigo), array('view', 'id'=>$data->adm_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adm_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->adm_usuario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adm_contrasenia')); ?>:</b>
	<?php echo CHtml::encode($data->adm_contrasenia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adm_emp_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->adm_emp_codigo); ?>
	<br />


</div>