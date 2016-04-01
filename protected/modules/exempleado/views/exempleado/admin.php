<?php
/* @var $this ExempleadoController */
/* @var $model Exempleado */

$this->breadcrumbs=array(
	'Ex-empleados'=>array('index'),
	'Administrar',
);

$this->menu=array(	
	array('label'=>'Crear Ex-empleado', 'url'=>array('create')),
);
?>
<h1>Administrar ex-empleados</h1>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>
<div id="ayuda">
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h4>Información</h4>
	</div>
 
	<div class="modal-body">
		<p>Permite agregar los datos de los ex-empleados.</p>
		<p>Para agregar un ex-empleado es obligatorio el número de documento.</p>
		<p>Si el número
			de documento no está registrado como empleado, el sistema
			automáticamente crea el empleado y los datos de acceso 
			para la aplicación.
		</p>
	</div>
 
	<div class="modal-footer">   
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Close',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
		)); ?>
	</div>
 
<?php $this->endWidget(); ?>
 <span>
	 <?php $this->widget('bootstrap.widgets.TbLabel', array(
		'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
		'label'=>'Ayuda',
		'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
    ),
	)); ?>   
 </div>

<?php 
	$template = '{update}{view}';
	if(Yii::app()->user->isSuperAdmin){
		$template = '{update}{view}{delete}';
	}
	$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'exempleado-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
	'columns'=>array(
		'numerodocumento',		
		array(
            'name' => 'exm_fechacreacion',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'exm_fechacreacion', 
                'language' => 'es',
                // 'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', (#2)
                'htmlOptions' => array(
                    'id' => 'datepicker_for_exm_fechacreacion',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy/mm/dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true)
		),
		
		//'exm_fechacreacion',
		'exm_motivo',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'template'=>$template,
        ),
	),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_exm_fechacreacion').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['es'],{'dateFormat':'yy/mm/dd'}));
}
");

?>
