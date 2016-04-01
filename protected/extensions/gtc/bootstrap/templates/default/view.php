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
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
array('label'=>Yii::t('general','Create <?php echo $this->modelClass; ?>'),'url'=>array('create')),
array('label'=>Yii::t('general','Update <?php echo $this->modelClass; ?>'),'url'=>array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
array('label'=>Yii::t('general','Manage <?php echo $this->modelClass; ?>'),'url'=>array('admin')),
);
?>

<h1><?php echo "<?php echo Yii::t('general','View"; ?> <?php echo $this->modelClass . "');?>" . " #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
<?php
foreach ($this->tableSchema->columns as $column) {
	echo "\t\t'" . $column->name . "',\n";
}
?>
),
)); ?>
