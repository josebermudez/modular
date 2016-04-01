<?php
/* @var $this FormatoController */
/* @var $model Formato */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documento-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'doc_archivo'); ?>
		<?php 
		$csrfToken = Yii::app()->request->csrfToken;
		$urlBorrarArchivo = $this->createUrl('/documento/documento/borrarArchivo');
			$this->widget('ext.dropzone.EDropzone', array(
				'model' => $model,
				'attribute' => 'doc_archivo',
				'url' => $this->createUrl('/documento/documento/subirArchivo'),
				'mimeTypes' => array('application/pdf','image/jpg','image/png'),	
				'onSuccess'=>"js:file.serverId = response;",
				'sending'=>'js: formData.append("YII_CSRF_TOKEN", "'.Yii::app()->request->csrfToken.'")',
				'options' => array(
					'maxFilesize'=>'3',
					'maxFiles' => 2,
					'addRemoveLinks'=>true,
					'dictRemoveFile'=>'Borrar archivo',
					'dictCancelUpload'=>'Cancelar',
					'dictInvalidFileType'=>'El tipo de archivo no es permitido',
					'dictFileTooBig'=>'El archivo es demasiado grande',
					'dictMaxFilesExceeded'=>'El número máximo de archivos fué sobrepasado',
					'dictDefaultMessage'=>'Arrastre los archivos aqui para subirlos al sistema',
					'removedfile'=>"js:function(file, serverFileName) {    						
						if (file.serverId) { 
							$.ajax({
								type: 'POST',
								url: '$urlBorrarArchivo',
								data: \"id=\"+ file.serverId+\"&name=\"+file.name+\"&YII_CSRF_TOKEN=\"+'$csrfToken',
								dataType: 'html'
							});
						}
						var _ref;
						return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
					}"
				)							
			));
		?>
		<?php echo $form->error($model,'for_texto'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
