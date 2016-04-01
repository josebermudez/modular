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

	<div class="container-fluid">	  		
	<?php echo $content ?>		
	</div><!--/.fluid-container-->

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
