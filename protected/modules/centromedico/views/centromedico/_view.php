<?php
/* @var $this CentromedicoController */
/* @var $data Afiliado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->afi_codigo), array('view', 'id'=>$data->afi_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->afi_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_direccion')); ?>:</b>
	<?php echo CHtml::encode($data->afi_direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_telefonos')); ?>:</b>
	<?php echo CHtml::encode($data->afi_telefonos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_numerodocumento')); ?>:</b>
	<?php echo CHtml::encode($data->afi_numerodocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_tipodocumento')); ?>:</b>
	<?php echo CHtml::encode($data->afi_tipodocumento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_tipo')); ?>:</b>
	<?php echo CHtml::encode($data->afi_tipo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_horarios')); ?>:</b>
	<?php echo CHtml::encode($data->afi_horarios); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('afi_ciu_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->afi_ciu_codigo); ?>
	<br />

	*/ ?>

</div>