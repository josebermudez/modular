<?php
/* @var $this CentromedicoController */
/* @var $model Afiliado */
$this->breadcrumbs=array(
	'Panel de gestion'=>array('panelGestion'),	
);
?>
<h1>Panel de gestión</h1>
<?php $this->renderPartial('_formpanelgestion', array('model'=>$model,'dataProvider'=>$dataProvider)); ?>
