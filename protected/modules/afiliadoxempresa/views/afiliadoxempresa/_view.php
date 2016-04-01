<?php
/* @var $this AfiliadoxempresaController */
/* @var $data Afiliadoxempresa */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('axe_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->axe_codigo), array('view', 'id'=>$data->axe_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('axe_emp_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->axe_emp_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('axe_afi_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->axe_afi_codigo); ?>
	<br />


</div>