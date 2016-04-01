<?php
/* @var $this FormatoController */
/* @var $model Formato */
$this->breadcrumbs=array(
	'Formatos'=>array('index'),
	'Administrar',
);
$this->menu=array(	
	array('label'=>'Agregar Formato', 'url'=>array('create')),
);
?>

<h1>Administre formatos</h1>

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
	'filter'=>$model,
	'summaryText'=>Yii::t('general','Mostrando').' {start}-{end} '.Yii::t('general','de').' {count} '.Yii::t('general','resultados').'.',
	'columns'=>array(		
		'for_nombrearchivo',
		'for_nombre',
		array(
			'name'=>'for_archivovalido',
			'filter'=>array('1'=>'Válido', '0'=>'Inválido'),
			'type'=>'html',
			'value'=>'CHtml::image(UtilityHtml::getStatusImage($data->for_archivovalido))',
			'htmlOptions'=>array('width'=>"80px")
		),		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}{download}{update}{pregenerar}',
			'htmlOptions'=>array('style'=>'width: 70px'),
			'buttons'=>array
			(
				'download' => array
				(
					'label'=>'Descargar archivo',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/down.png',
					'url'=>'Yii::app()->createUrl("/formato/formato/descargar", array("id"=>$data->for_codigo))',
				),
				'update' => array
				(
					'label'=>'Ingresar nombre del archivo',
					'url'=>'Yii::app()->createUrl("/formato/formato/actualizarInformacion", array("id"=>$data->for_codigo))',
				),				
				'pregenerar' => array
				(
					'label'=>'Generar ejemplo de carta',
					'visible'=>'UtilityHtml::getPregenerarLinkEsVisible($data->for_archivovalido)',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/pregenerarformato.png',
					'url'=>'UtilityHtml::getPregenerarLink($data->for_archivovalido,$data->for_codigo)',
				),				
			),							
		),
	),
)); ?>
