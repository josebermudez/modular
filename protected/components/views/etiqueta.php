<?php 
if ($model) {
	$label = $model->getAttribute('cam_label');
	if (!empty($label)) {
		$this->widget('bootstrap.widgets.TbLabel', array(    
			'label'=>$model->getAttribute('cam_label'),
		)); 
	}
}
?>
