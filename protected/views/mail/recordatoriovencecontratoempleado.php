<p>Señor(a): <?php echo CHtml::encode($objContrato->empleado->emp_nombre);  ?>  .</p>
<p>El sistema <?php echo CHtml::encode(Yii::app()->name);  ?> ha detectado
que su contrato en la empresa <strong><?php echo CHtml::encode($objContrato->empleado->empresa->emp_nombre); ?></strong> </p>
<?php if($objContrato->getTipoIntervalo() === 1): ?>
<p>Está vencido <?php echo CHtml::encode($objContrato->con_fechafin); ?></p>
<?php endif; ?>
<?php if($objContrato->getTipoIntervalo() === 0): ?>
<p>Está próximo a vencerse, <strong><?php echo CHtml::encode($objContrato->con_fechafin); ?></strong></p>
<?php endif; ?>
<p>Este recordatorio se enviará durante días <?php echo Yii::app()->params['numerodiasnotificacionvencimiento'] ?> y despues se desactivará el recordatorio.</p>

