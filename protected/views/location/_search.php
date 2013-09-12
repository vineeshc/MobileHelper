<?php
/* @var $this LocationController */
/* @var $model Location */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget( 'CActiveForm', array(
	'action'=>Yii::app()->createUrl( $this->route ),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label( $model, 'user_id' ); ?>
		<?php echo $form->textField( $model, 'user_id',array( 'size'=>20, 'maxlength'=>20 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'latitude' ); ?>
		<?php echo $form->textField( $model, 'latitude',array( 'size'=>5, 'maxlength'=>5 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'longitude' ); ?>
		<?php echo $form->textField( $model, 'longitude',array( 'size'=>5, 'maxlength'=>5 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'update_time' ); ?>
		<?php echo $form->textField( $model, 'update_time' ); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Search' ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->