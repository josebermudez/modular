<?php
return array(
    'title'=>'Por favor ingrese los siguientes datos',
	'id'=>uniqid(),
    'elements'=>array(
		'ciudad'=>array(
            'type'  => 'dropdownlist',
            'items' => Ciudad::getListaCiudades(),
            'id'=>uniqid(),
			'ajax' => array(
				'type'=>'POST', //request type
				'url'=>array('currentController/dynamiccities'), //url to call.
				//Style: CController::createUrl('currentController/methodToCall')
				'update'=>'#city_id', //selector to update
				//'data'=>'js:javascript statement' 
				//leave out the data key to pass all form values through
				) 
			),        
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),
 
    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
);
