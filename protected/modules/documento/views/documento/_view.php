<?php
/* @var $this DocumentoController */
/* @var $data Documento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_codigo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->doc_codigo), array('view', 'id'=>$data->doc_codigo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_nombre')); ?>:</b>
	<?php echo CHtml::encode($data->doc_nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_usr_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->doc_usu_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_empr_codigo')); ?>:</b>
	<?php echo CHtml::encode($data->doc_emp_codigo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_fechacreacion')); ?>:</b>
	<?php echo CHtml::encode($data->doc_fechacreacion); ?>
	<br />


</div>
