<?php
$this->breadcrumbs=array(
	Yii::t('general','Licencias')=>array('index'),
	Yii::t('general','Manage'),
);

$this->menu=array(
array('label'=>Yii::t('general','List Licencia'),'url'=>array('index')),
array('label'=>Yii::t('general','Create Licencia'),'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('licencia-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1><?php echo Yii::t('general','Manage Licencias');?></h1>

<?php ;

 $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); 
    
?>

<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'licencia-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'summaryText'=>Yii::t('general','Mostrando').' {start}-{end} '.Yii::t('general','de').' {count} '.Yii::t('general','resultados').'.',
'columns'=>array(
		'lic_id',
		'lic_fechacreacion',
		'lic_fechaedicion',
		'lic_duracion',
		'lic_fechavencimiento',
		'lic_activa',
		/*
		'lic_emp_codigo',
		'lic_usr_codigo',
		'lic_codigo',
		'lic_precio',
		'lic_esgratuita',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
