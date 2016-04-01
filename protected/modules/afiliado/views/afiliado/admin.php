<?php
/* @var $this AfiliadoController */
/* @var $model Afiliado */

$this->breadcrumbs=array(
	Yii::t('general','Afiliados')=>array('index'),
	Yii::t('general','Manage'),
);

$this->menu=array(
	array('label'=>'List Afiliado', 'url'=>array('index')),
	array('label'=>'Create Afiliado', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#afiliado-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('general','Administrar Afiliados'); ?></h1>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'afiliado-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'afi_codigo',
		'afi_nombre',
		'afi_direccion',
		'afi_telefonos',
		'afi_numerodocumento',
		'afi_tipodocumento',
		/*
		'afi_tipo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
