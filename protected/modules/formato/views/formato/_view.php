<?php
/* @var $this FormatoController */
/* @var $data Formato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('for_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->for_codigo), array('view', 'id'=>$data->for_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('for_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->for_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('for_texto')); ?>:</b>
	<?php echo CHtml::encode($data->for_texto); ?>
	<br />


</div>