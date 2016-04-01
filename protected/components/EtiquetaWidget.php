<?php

class EtiquetaWidget extends CWidget {
 
    public $campo = '';
    public $tabla = '';
        
 
    public function run() {
		if(!empty($this->campo) && !empty($this->tabla)){
			//obtiene el modelo del label
			$label = Campo::model()->findByAttributes(array(
					'cam_tablaasociada'=>$this->tabla,
					'cam_nombre'=>$this->campo
				)
			);
			
		}
		$this->render('etiqueta',array(
				'model'=>$label,							
			));
	}										      
 
}
?>
