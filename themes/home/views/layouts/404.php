<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es-CO">
<head profile="http://gmpg.org/xfn/11">
<title><?php echo Yii::app()->name . ' - ' .$error['code']; ?></title>
 <meta charset="ISO-8859-1"> 
<meta http-equiv="Content-Language" content="es"/>
<meta name="robots" content="all,index,follow"/>
<meta name="keywords" content="modular, php, soa,  404 error page"/>
<meta name="description" content="modular"/>
<meta name="publisher" content="mogoolab.com" />
<meta name="author" content="mogoolab.com" />
<meta http-equiv="X-UA-Compatible" content="IE=8">
<link href='http://fonts.googleapis.com/css?family=Istok+Web|Chivo' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/backgrounds.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/themes/blue/css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/themes/green/css/style.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo Yii::app()->theme->baseUrl; ?>/themes/gray/css/style.css" />


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-global.js"></script>

<!--[if IE]>
<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>


<div class="wrapper">

	<div class="mainWrapper">
       <?php echo $content; ?>
	</div>

</div>
<!-- end .wrapper -->
</body>
</html>