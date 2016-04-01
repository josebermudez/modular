<h1><?php echo CrugeTranslator::t('logon',"Login"); ?></h1>
<?php if(Yii::app()->user->hasFlash('loginflash')): ?>
<div class="flash-error">
	<?php echo Yii::app()->user->getFlash('loginflash'); ?>
</div>
<?php else: ?>
<div class="form">
<?php 

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(    
    'htmlOptions'=>array('class'=>'well'),
	'id'=>'logon-form',
	 'type'=>'horizontal',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<fieldset>
	<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
	<?php if(CCaptcha::checkRequirements()): ?>	  
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'verifyCode',array('class'=>'control-label')); ?>		
		<?php $this->widget('CCaptcha'); ?>
		
		<?php echo $form->textField($model,'verifyCode'); ?>
		<div class="hint">Introduzca las letras que aparecen arriba.
			<br/>No hay distinción entre mayúsculas y minúsculas.
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>	  
	</div>
	<?php endif; ?>
	<?php //echo $form->checkboxRow($model, 'rememberMe'); ?>
	</fieldset>
	
	<div class="form-actions">
		<?php Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Login")); ?>
		<?php //echo Yii::app()->user->ui->passwordRecoveryLink; ?>
		<?php
			if(Yii::app()->user->um->getDefaultSystem()->getn('registrationonlogin')===1)
				echo Yii::app()->user->ui->registrationLink;
		?>
	</div>

	<?php
		//	si el componente CrugeConnector existe lo usa:
		//
		if(Yii::app()->getComponent('crugeconnector') != null){
		if(Yii::app()->crugeconnector->hasEnabledClients){ 
	?>
	<div class='crugeconnector'>
		<span><?php echo CrugeTranslator::t('logon', 'You also can login with');?>:</span>
		<ul>
		<?php 
			$cc = Yii::app()->crugeconnector;
			foreach($cc->enabledClients as $key=>$config){
				$image = CHtml::image($cc->getClientDefaultImage($key));
				echo "<li>".CHtml::link($image,
					$cc->getClientLoginUrl($key))."</li>";
			}
		?>
		</ul>
	</div>
	<?php }} ?>
	

<?php $this->endWidget(); ?>
</div>
<?php endif; ?>
