<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'lic_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lic_fechacreacion',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lic_fechaedicion',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lic_duracion',array('class'=>'span5','maxlength'=>4)); ?>

		<?php echo $form->textFieldRow($model,'lic_fechavencimiento',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lic_activa',array('class'=>'span5','maxlength'=>1)); ?>

		<?php echo $form->textFieldRow($model,'lic_emp_codigo',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lic_usr_codigo',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lic_codigo',array('class'=>'span5','maxlength'=>23)); ?>

		<?php echo $form->textFieldRow($model,'lic_precio',array('class'=>'span5','maxlength'=>10)); ?>

		<?php echo $form->textFieldRow($model,'lic_esgratuita',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
