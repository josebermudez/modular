<?php
/* @var $this EmpleadoController */
/* @var $model Empleado */
//Carga las notificaciones para el empleado
$this->widget('application.components.NotificacionContratoWidget', array(
		'intEmpresa'=>0,
		'intEmpleado'=>$modelEmpleado->getAttribute('emp_codigo'),
	)
);
$this->widget('application.components.LicenciaWidget', array(
		'intEmpresa'=>Yii::app()->user->getState('empresa'),
		'intUsuario'=>0,
	)
);
$this->breadcrumbs=array(
	Yii::t('general','Empleados')=>array('index'),
	$modelEmpleado->getAttribute('emp_nombre') => array('/empleado/empleado/view/id/'.UrlEnDecode::base64UrlEncode(Yii::app()->getSecurityManager()->encrypt($modelEmpleado->getAttribute('emp_codigo')))),
	Yii::t('general','Contratos'),
	Yii::t('general','Administrar'),
);
$this->menu=array(	
	array('label'=>Yii::t('general','Administrar contratos del empleado'), 'url'=>array('create','empleado'=>$model->getAttribute('con_emp_id'))),
	array('label'=>Yii::t('general','Crear contrato'), 'url'=>array('create','empleado'=>$modelEmpleado->getAttribute('emp_codigo')), 'visible'=>Yii::app()->user->checkAccess('action_empleado_contrato_create')),
);
?>
<div id="formmotivocierre" class="modal hide fade">
 <!-- dialog contents -->
<div class="modal-body">Formulario para agrega el motivo del cierre</div>
<!-- dialog buttons -->
<div class="modal-footer"><a href="#" class="btn primary">OK</a></div> 
</div>
<h1><?php echo Yii::t('general','Administrar contratos') ?></h1>

<?php $this->widget('bootstrap.widgets.TbAlert', array(        
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); 


$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	//'id'=>'formato-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>Yii::t('general','Mostrando').' {start}-{end} '.Yii::t('general','de').' {count} '.Yii::t('general','resultados').'.',
	'columns'=>array(		
		'con_fechainicio',
		'con_fechafin',	
		 array(
			'class' => 'bootstrap.widgets.TbToggleColumn',
			'toggleAction' => '/empleado/contrato/terminar',
			'name' => 'con_terminado',
			'header' => CHtml::encode($model->getAttributeLabel('con_terminado')),
			'checkedButtonLabel'=>Yii::t('general','Contrato terminado'),
			'uncheckedButtonLabel'=>Yii::t('general','Contrato activo'),
			'afterToggle'=>"function(){
				 $('#formmotivocierre').modal({ // wire up the actual modal functionality and show the dialog
					'backdrop' : 'static',
					'keyboard' : true,
					'show' : true // ensure the modal is shown immediately
					}); 									 					
			}",
		),		
		 array(
			'name' => 'con_esindefinido',
			'header'=> CHtml::encode($model->getAttributeLabel('con_esindefinido')),
			//'filter'=> CHtml::activeTextField($model, 'varFullname'),
			'value' => '((int)$data->con_esindefinido === 1) ? Yii::t("general","Si"): Yii::t("general","No")',
		),	
		 array(
			'name'=>'con_documento',
			'type'=>'raw',
			'value'=>'CHtml::link($data->con_documentooriginal, Yii::app()->createUrl("empleado/contrato/descargar",array("contrato"=>UrlEnDecode::base64UrlEncode(Yii::app()->getSecurityManager()->encrypt($data->con_id)))) )',
		),				
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            
            //'template'=>$template,
            'buttons'=>array
			(
				'update'=>array(
					'visible'=>'(Yii::app()->user->isSuperAdmin || ((int)$data->_con_terminado==0)   ) ? true:false',
				),	
				'view' => array(
					'url' => 'Yii::app()->createUrl("empleado/contrato/view", array("id"=>UrlEnDecode::base64UrlEncode(Yii::app()->getSecurityManager()->encrypt($data->con_id))))',					
				),
			),
        ),
	),
	'bulkActions' => array(
		'actionButtons' => array(
			array(
				'id'=>uniqid(),
				'buttonType' => 'button',
				'type' => 'primary',
				'size' => 'small',
				'label' => Yii::t('general','Generar carta de notificación'),
				'click' => 'js:function(values){confirmarGeneracionNotificacion(values)}'
			)
		),
		// if grid doesn't have a checkbox column type, it will attach
		// one and this configuration will be part of it
		'checkBoxColumnConfig' => array(
			'name' => 'con_id'
		),
	),
)); 
Yii::app()->clientScript->registerScript("notifylist", 
"
 $('#formmotivocierre').on('show', function() { // wire up the OK button to dismiss the modal when shown
					$('#formmotivocierre a.btn').on('click', function(e) {
					console.log('button pressed'); // just as an example...
					$('#formmotivocierre').modal('hide'); // dismiss the dialog
					});
					});
					$('#formmotivocierre').on('hide', function() { // remove the event listeners when the dialog is dismissed
					$('#formmotivocierre a.btn').off('click');
					});
					$('#formmotivocierre').on('hidden', function() { // remove the actual elements from the DOM when fully hidden
					$('#formmotivocierre').remove();
					});
"
);
Yii::app()->clientScript->registerScript("generarcartanotificacion", 
"
	function confirmarGeneracionNotificacion(values)
	{
		console.log(values);
		js:bootbox.confirm('Desea generar la carta de notificación para los contratos:?', function(confirmed){
			window.open('".Yii::app()->createUrl("empleado/contrato/crearDocumentoNotificacion")."/id/'+values.con_id);
			console.log('Genera la carta')
		})
	} 
"
);
