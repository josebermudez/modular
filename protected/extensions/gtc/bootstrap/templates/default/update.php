<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn = $this->guessNameColumn($this->tableSchema->columns);
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	Yii::t('general','Update'),
);\n";
?>

	$this->menu=array(
	array('label'=>Yii::t('general','List <?php echo $this->modelClass; ?>'),'url'=>array('index')),
	array('label'=>Yii::t('general','Create <?php echo $this->modelClass; ?>'),'url'=>array('create')),
	array('label'=>Yii::t('general','View <?php echo $this->modelClass; ?>'),'url'=>array('view','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>Yii::t('general','Manage <?php echo $this->modelClass; ?>'),'url'=>array('admin')),
	);
	?>

	<h1><?php echo "<?php echo Yii::t('general','" ?>Update <?php echo $this->modelClass . " <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?><?php echo " ');?>"; ?> </h1>

<?php echo "<?php echo \$this->renderPartial('_form',array('model'=>\$model)); ?>"; ?>
