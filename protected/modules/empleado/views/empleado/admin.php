<?php
//Carga las notificaciones para la empresa
$this->widget('application.components.NotificacionContratoWidget', array(
		'intEmpresa'=>Yii::app()->user->getState('empresa'),
		'intEmpleado'=>0,
	)
);
/* @var $this EmpleadoController */
/* @var $model Empleado */

$this->breadcrumbs=array(
	Yii::t('general','Empleados')=>array('index'),
	Yii::t('general','Administrar'),
);

$this->menu=array(        
        array('label'=>Yii::t('general','Crear empleado'), 'url'=>array('create')),
);
?>
<h1><?php echo Yii::t('general','Administrar empleados'); ?></h1>
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
		<h4><?php echo Yii::t('general','Información'); ?></h4>
	</div>
 
	<div class="modal-body">
		<p>Permite agregar los datos de los empleados.</p>
		<p>Para agregar un empleado es obligatorio el número de documento.</p>
		<p>El sistema
			automáticamente crea los datos de acceso 
			para la aplicación, el numero de documento se convierte en el
			usuario y la contraseña para poder ingresar al aplicativo.
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
	$templateGeneral = '{update}{view}';
	if(Yii::app()->user->isSuperAdmin){
		$templateGeneral = '{update}{view}{delete}';
	}
	$templateContratos = '{contratos}';
	$templateVerDocumentos = '{verdocumentos}';
	
	$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),    
    'summaryText'=>Yii::t('general','Mostrando').' {start}-{end} '.Yii::t('general','de').' {count} '.Yii::t('general','resultados').'.',
    'filter'=>$model,
    'columns'=>array(
		'emp_numerodocumento',
		'emp_codigo',
		'emp_nombre',		
		'emp_tipodocumento',
		'emp_direccion',
		'emp_telefonofijo',
		array(
			'name'=>'licencia.lic_codigo',
			'value'=>'isset($data->licencia)?$data->licencia->lic_codigo:'.Yii::t('general','Son licencia asignada'),
			'visible'=>true
            ),        
		/*
		'emp_telefonomovil',
		'emp_estado',
		'emp_emp_codigo',
		*/
		 array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'header'=>Yii::t('general','Contratos'),			
            'template'=>$templateContratos,
            'buttons'=>array
			(							
				'contratos' => array
				(									 			
					'url'=>'$this->grid->controller->createUrl("/empleado/contrato/admin", array("id"=>$data->emp_codigo,"gridId"=>$this->grid->id))',					
					'label'=>'Ver contratos del ex/emplelado',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/paper102_14x14.png'					
				),	
			),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'template'=>$templateVerDocumentos,
            'header'=>Yii::t('general','Documentos'),
            'buttons'=>array
			(
				'verdocumentos' => array
				(									 
					'url'=>'$this->grid->controller->createUrl("/documento/documento/adminempleado", array("id"=>$data->emp_codigo,"asDialog"=>1,"gridId"=>$this->grid->id))',
					'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',                     				
					'label'=>'Ver documentos del ex/emplelado',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/paper102_14x14.png'					
				)	
			),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'template'=>$templateGeneral
        ),
	),
    
	)); 
?>

<?php
//--------------------- begin new code --------------------------
   // add the (closed) dialog for the iframe
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'cru-dialog',
    'options'=>array(
        'title'=>'Documentos del ex/empleado',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>700,
        'height'=>500,
        'position'=> array('my'=> 'center bottom', 'at'=> 'center bottom', 'of'=> 'button' ),
        'buttons' => array(
			array('text'=>'Cerrar','click'=> 'js:function(){$(this).dialog("close");}')			
		),
    ),
    ));
?>
<iframe id="cru-frame" width="100%" height="100%" scrolling="auto"></iframe>
<?php
$this->endWidget();
//--------------------- end new code --------------------------
?>
