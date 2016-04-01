<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Bienvenido a <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>La aplicación que te permite automatizar las tareas de la oficina.</p>

<p>Solo activas los modulos que necesitas:</p>
<ul>
	<li>Generación masiva de cartas</li>	
</ul>
<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/software_modular.jpg" alt="software modular"/>
<p>Para mas detalles use el formulario de contacto </p>

