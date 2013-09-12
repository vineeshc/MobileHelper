<?php
/* @var $this LocationController */
/* @var $model Location */

$this->breadcrumbs=array(
	'Locations'=>array( 'index' ),
	$model->user_id,
);

$this->menu=array(
	array( 'label'=>'List Location', 'url'=>array( 'index' )),
	array( 'label'=>'Create Location', 'url'=>array( 'create' )),
	array( 'label'=>'Update Location', 'url'=>array( 'update', 'id'=>$model->user_id)),
	array( 'label'=>'Delete Location', 'url'=>'#', 'linkOptions'=>array( 'submit'=>array('delete','id'=>$model->user_id), 'confirm'=>'Are you sure you want to delete this item?' )),
	array( 'label'=>'Manage Location', 'url'=>array( 'admin' )),
);
?>

<h1>View Location #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'latitude',
		'longitude',
		'update_time',
	),
)); ?>
