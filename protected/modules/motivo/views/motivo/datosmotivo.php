<?php
	foreach($model->formatos as $formato):
	?>
	<?php
	$idModal = uniqid();
	$botonCerrar = uniqid();
	/*$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>$idModal)); 
		echo $this->renderPartial(
			'formulariomotivo', 
			array(
				'motivo'=>$model,'formato'=>$formato,
				'botonCerrar'=>$botonCerrar
			),
			true,
			true
	); 
	$this->endWidget();*/
	?>
	<span style="margin-right:3px">
		<?php
		$this->widget('bootstrap.widgets.TbButton', array(
			'label'=>$formato->getAttribute('for_nombre'),
			'type'=>'primary',	
			/*'htmlOptions'=>array(
			'data-toggle'=>'modal',
			'data-target'=>'#'.$idModal,
		),*/
			'url'=>Yii::app()->createUrl('/motivo/motivo/generar', array(
				'formato'=>$formato->getAttribute('for_codigo'),
				'motivo'=>$model->getAttribute('mot_codigo')
			))
				
			)); 
		?>
	</span>	
	<?php
	break;
	endforeach;
?>
