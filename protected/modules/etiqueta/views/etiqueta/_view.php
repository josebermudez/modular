<?php
/* @var $this EtiquetaController */
/* @var $data Campo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cam_codigo), array('view', 'id'=>$data->cam_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->cam_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_label')); ?>:</b>
	<?php echo CHtml::encode($data->cam_label); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->cam_tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_tablaasociada')); ?>:</b>
	<?php echo CHtml::encode($data->cam_tablaasociada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_keyllaveasociada')); ?>:</b>
	<?php echo CHtml::encode($data->cam_keyllaveasociada); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_valorllaveasociada')); ?>:</b>
	<?php echo CHtml::encode($data->cam_valorllaveasociada); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cam_etiqueta')); ?>:</b>
	<?php echo CHtml::encode($data->cam_etiqueta); ?>
	<br />

	*/ ?>

</div>