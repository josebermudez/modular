<?php
$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	//'id'=>'formato-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(		
		'doc_nombrearchivo',
		'doc_nota',		
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
