<?php
$arrCentrosMedicos = array();
$objEmpresa = Empresa::model()->findByPk(
	Yii::app()->user->getState('empresa')
);
$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	//'id'=>'formato-grid',
	'dataProvider'=>$model->documentosCentroMedicoxEmpresa(),
	'filter'=>$model,
	'columns'=>array(		
		array(
			'filter' => array(1 => 'Male', 2 => 'Female'),
			'header' => 'Centro  médico',
			'value' => '$data->afiliado->afi_nombre',
		),  		
		'doc_nombrearchivo',
		'doc_nota',	
		'doc_fechacreacion',					
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{download}',
			'htmlOptions'=>array('style'=>'width: 70px'),
			'buttons'=>array
			(
				'download' => array
				(
					'label'=>'Descargar archivo',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/down.png',
					'url'=>'Yii::app()->createUrl("/documento/documento/descargar", array("id"=>$data->doc_codigo))',
				),				
			),							
		),
	),
)); ?>
