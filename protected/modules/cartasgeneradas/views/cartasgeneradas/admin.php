<?php
/* @var $this CartasgeneradasController */
/* @var $model Cartasgeneradas */

$this->breadcrumbs=array(
	'Cartas generadas'=>array('index'),
	'Administrar',
);

$this->menu=array(

);
?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Número de cartas por día</h4>
</div>
 
<div class="modal-body">
   <?php 
		$numeroDias = 5;				
		$labels = array();		
		$fechaInicial = gmdate("Y-m-d", strtotime("-".$numeroDias." day", strtotime(date("Y-m-d"))));  		
		$labels[]=$fechaInicial;		
		$fecha = new DateTime(date("Y-m-d H:i:s"));
		$fecha->add(new DateInterval('P'.$numeroDias.'D'));		
		$fechaFinal = date("Y-m-d");
		$sCurrentDate = $fechaInicial;
		for($i=1;$i<=$numeroDias;$i++){
			$sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));
			$labels[]=$sCurrentDate;
		}				
		//genera datasets
		$dataSets = array();
		$criteria = new CDbCriteria(array('order'=>'cag_fechacreacion DESC'));
		$criteria->addBetweenCondition('cag_fechacreacion', $fechaInicial.' 00:00:00', $fechaFinal.' 23:59:59');		
		$criteria->addCondition('cag_empr_codigo='.Yii::app()->user->getState('empresa'));				
		$listaCartas = Cartasgeneradas::model()->findAll($criteria);
		$arrDiasCartas = array();		
		foreach($listaCartas as $carta){			
				$fecha = $carta->getAttribute('cag_fechacreacion');
				$dia = date('Y-m-d', strtotime($fecha));
				if(isset($arrDiasCartas[$dia])){
					$arrDiasCartas[$dia]++;
				}else{
					$arrDiasCartas[$dia]=1;
				}
		}			
		foreach($labels as $label){
			if(!array_key_exists($label,$arrDiasCartas)){
				$arrDiasCartas[$label]=0;
			}
		}		
		ksort($arrDiasCartas);
		$dataSets[]=array(
			"fillColor" => "rgba(220,220,220,0.5)",
			"strokeColor" => "rgba(220,220,220,1)",
			"pointColor" => "rgba(220,220,220,1)",
			"pointStrokeColor" => "#ffffff",
			"data" => array_values($arrDiasCartas)
		);
		
        $this->widget(
            'chartjs.widgets.ChBars', 
            array(
                'width' => 600,
                'height' => 300,
                'htmlOptions' => array(),
                'labels' => $labels,
                'datasets' => $dataSets,
                'options' => array()
            )
        ); 
    ?>
</div>
 
<div class="modal-footer">   
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>Yii::t('general','Close'),
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>

<h1>Administre Cartas generadas</h1>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Yii::t('general','Graph'),
    'type'=>'primary',
    'htmlOptions'=>array(
        'data-toggle'=>'modal',
        'data-target'=>'#myModal',
    ),
)); ?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>
<?php 
$template = '{download}';
if(Yii::app()->user->isSuperAdmin){
	$template = '{update}{view}{delete}{download}';
}
$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'cartasgeneradas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(		
		'empleado.emp_nombre',
		'usuario.username',
		'empresa.emp_nombre',
		'motivo.mot_nombre',
		'formato.for_nombre',		
		'cag_fechacreacion',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),			
			'template'=>$template,
			'buttons'=>array
			(
				'download' => array
				(
					'label'=>'Descargar archivo',
					'imageUrl'=>Yii::app()->theme->baseUrl.'/img/down.png',
					'url'=>'Yii::app()->createUrl("/cartasgeneradas/cartasgeneradas/descargar", array("id"=>$data->cag_codigo))',
				),				
			),
		),	
	),
)); ?>
