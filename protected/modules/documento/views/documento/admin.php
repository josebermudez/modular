<?php
/* @var $this FormatoController */
/* @var $model Formato */
$this->breadcrumbs=array(
	'Documentos'=>array('index'),
	'Administrar',
);
$this->menu=array(	
	array('label'=>'Agregar documento', 'url'=>array('create')),
);
?>

<h1>Administre documentos</h1>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>

<?php 	
$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	//'id'=>'formato-grid',
	'dataProvider'=>$model->search(),
	'summaryText'=>Yii::t('general','Mostrando').' {start}-{end} '.Yii::t('general','de').' {count} '.Yii::t('general','resultados').'.',
	'filter'=>$model,
	'columns'=>array(		
		'doc_nombrearchivo',
		'doc_nota',		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}{download}{update}',
			'htmlOptions'=>array('style'=>'width: 70px'),
			'buttons'=>array
			(
				'download' => array
				(
					'label'=>'Descargar archivo',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/down.png',
					'url'=>'Yii::app()->createUrl("/documento/documento/descargar", array("id"=>$data->doc_codigo))',
				),
				'update' => array
				(
					'label'=>'Ingresar descripción del archivo',
					'url'=>'Yii::app()->createUrl("/documento/documento/actualizarInformacion", array("id"=>$data->doc_codigo))',
				)				
			),							
		),
	),
)); ?>
