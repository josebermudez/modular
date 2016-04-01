<p>Señor(a): <?php echo CHtml::encode($objContrato->empleado->empresa->jefepersonal->emp_nombre);  ?>  jefe de personal.</p>
<p>El sistema <?php echo CHtml::encode(Yii::app()->name);  ?> ha detectado
que el contrato del empleado: <strong><?php echo CHtml::encode($objContrato->empleado->emp_nombre); ?></strong> en la empresa <?php echo CHtml::encode($objContrato->empleado->empresa->emp_nombre); ?> </p>
<?php if($objContrato->getTipoIntervalo() === 1): ?>
<p>Está vencido <?php echo CHtml::encode($objContrato->con_fechafin); ?></p>
<?php endif; ?>
<?php if($objContrato->getTipoIntervalo() === 0): ?>
<p>Está proximo a vencerse, <strong><?php echo CHtml::encode($objContrato->con_fechafin); ?></strong></p>
<?php endif; ?>
<p>Este recordatorio se enviará dentro de <?php echo Yii::app()->params['tiempohorasparaenviarrecordatorioempleado'] ?> horas al empleado vía correo electrónico, si desea cancelar el envio ingrese <a href="<?php echo $urlSistemaContratos ?>">Aqui</a>.</p>
<p>Este recordatorio se enviará durante días <?php echo Yii::app()->params['numerodiasnotificacionvencimiento'] ?> y despues se desactivará el recordatorio.</p>

