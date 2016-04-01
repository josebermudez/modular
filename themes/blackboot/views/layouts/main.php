<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<!-- Le fav and touch icons -->
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>				
				<div class="nav-collapse">
					<?php 
				
						$this->widget('bootstrap.widgets.TbNavbar', array(
						'fixed'=>false,
						'brand'=>Yii::app()->name,
						'brandUrl'=>Yii::app()->createUrl('/site/index'),
						'collapse'=>true, // requires bootstrap-responsive.css
						'items'=>array(
						array(
                                'class'=>'bootstrap.widgets.TbMenu',
                                'htmlOptions'=>array('class'=>'pull-left'),
                                'items'=>Yii::app()->uimanager->menuAdministradorUsuarios,
                        ),                                            
                        array(
                                'class'=>'bootstrap.widgets.TbMenu',
                                'htmlOptions'=>array('class'=>'pull-left'),
                                'items'=>Yii::app()->uimanager->menuFuncionarios,
                        ),
                        array(
                                'class'=>'bootstrap.widgets.TbMenu',
                                'htmlOptions'=>array('class'=>'pull-left'),
                                'items'=>Yii::app()->uimanager->menuEmpresasUsuarios,
                                
                        ), 
                        array(
                                'class'=>'bootstrap.widgets.TbMenu',
                                'items'=>array(
                                        //array('label'=>'Inicio', 'url'=>array('/site/index'), 'active'=>true),
                                        Yii::app()->uimanager->menuCurrentUser,
                                ),
                        ),   
                ),
        )); 
					
					 ?>
					
					
					
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	
	<div class="cont">
	<div class="container-fluid">
	  <?php 		
		if(isset($this->breadcrumbs)):?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>CHtml::link('('.Empleado::getNombreEmpresaActual().') '), 
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); ?>
		<!-- breadcrumbs -->
	  <?php endif?>
	
	<?php echo $content ?>
	
	
	</div><!--/.fluid-container-->
	</div>
	
	<div class="extra">
	  <div class="container">
		<div class="row">
			<!--<div class="col-md-3">
				<h4>Heading 1</h4>
				<ul>
					<li><a href="#">Subheading 1.1</a></li>
					<li><a href="#">Subheading 1.2</a></li>
					<li><a href="#">Subheading 1.3</a></li>
					<li><a href="#">Subheading 1.4</a></li>
				</ul>
			</div> -->
			
			<!--<div class="col-md-3">
				<h4>Heading 2</h4>
				<ul>
					<li><a href="#">Subheading 2.1</a></li>
					<li><a href="#">Subheading 2.2</a></li>
					<li><a href="#">Subheading 2.3</a></li>
					<li><a href="#">Subheading 2.4</a></li>
				</ul>
			</div>-->
			
			<!--<div class="col-md-3">
				<h4>Heading 3</h4>	
				<ul>
					<li><a href="#">Subheading 3.1</a></li>
					<li><a href="#">Subheading 3.2</a></li>
					<li><a href="#">Subheading 3.3</a></li>
					<li><a href="#">Subheading 3.4</a></li>
				</ul>
			</div>-->
			
			<!--<div class="col-md-3">
				<h4>Heading 4</h4>
				<ul>
					<li><a href="#">Subheading 4.1</a></li>
					<li><a href="#">Subheading 4.2</a></li>
					<li><a href="#">Subheading 4.3</a></li>
					<li><a href="#">Subheading 4.4</a></li>
				</ul>
				</div>  -->
			</div> <!-- /row -->
		</div> <!-- /container -->
	</div>
	
	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-copyright" class="col-md-6">
				Acerca de nosotros | Contactenos | Terminos & Condiciones
			</div> <!-- /span6 -->
			<div id="footer-terms" class="col-md-6">				
			</div> <!-- /.span6 -->
		 </div> <!-- /row -->
	  </div> <!-- /container -->
	</div>
	<script>
	$( document ).ready(function() {	
	$("body").bind("ajaxSend", function(elm, xhr, s){
		if (s.type == "POST") {
		xhr.setRequestHeader('<?php echo Yii::app()->request->csrfTokenName; ?>', '<?php echo Yii::app()->request->csrfToken; ?>');
		}
		});
	});
	</script>
</body>
</html>
