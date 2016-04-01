<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('lic_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->lic_id),array('view','id'=>$data->lic_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->lic_fechacreacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_fechaedicion')); ?>:</b>
	<?php echo CHtml::encode($data->lic_fechaedicion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_duracion')); ?>:</b>
	<?php echo CHtml::encode($data->lic_duracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_fechavencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->lic_fechavencimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_activa')); ?>:</b>
	<?php echo CHtml::encode($data->lic_activa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_emp_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->lic_emp_codigo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_usr_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->lic_usr_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->lic_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_precio')); ?>:</b>
	<?php echo CHtml::encode($data->lic_precio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lic_esgratuita')); ?>:</b>
	<?php echo CHtml::encode($data->lic_esgratuita); ?>
	<br />

	*/ ?>

</div>