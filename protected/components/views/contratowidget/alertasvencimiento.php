<?php
Yii::app()->clientScript->registerScript("notifylist", '
var contratos = '.json_encode($arrContratosVencidos).';	
console.log(contratos);
		jQuery.each(contratos,function(index, value){
		if(this.intervaloNegativo === true) {
			$.notify(this.mensajeVencido, {className:"error",clickToHide:true,autoHide:false});
		} else {
		console.log("entra");
			$.notify(this.mensajeProximoVencer,{className:"info",clickToHide:true,autoHide:false});
		}				
});');
?>
