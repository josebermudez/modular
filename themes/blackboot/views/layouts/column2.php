<?php 
$this->widget('application.components.NotificacionContratoWidget', array(
        'intEmpresa'=>0,
        'intEmpleado'=>Yii::app()->user->id,
    )
);
$this->beginContent('//layouts/main'); ?>
      <div class="row-fluid">
        <div class="span3">
         <?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Acciones',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'sidebar'),
			));
			$this->endWidget();
		?>
		<div id="notificacionesUsuario">
		<?php 
		$this->widget('application.components.LicenciaWidget', array(
		'intEmpresa'=>Yii::app()->user->getState('empresa'),
		'intUsuario'=>0,
	)
);
		?>
				</div>
		</div><!-- sidebar span3 -->

	<div class="span9">
		<div class="main">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>
