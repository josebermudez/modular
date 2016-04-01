<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	Yii::t('general','Create'),
);\n";
?>

$this->menu=array(
array('label'=>Yii::t('general','List <?php echo $this->modelClass; ?>'),'url'=>array('index')),
array('label'=>Yii::t('general','Manage <?php echo $this->modelClass; ?>'),'url'=>array('admin')),
);
?>

<h1><?php echo "<?php echo Yii::t('general','Create "?><?php echo $this->modelClass; echo "');?>";  ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
