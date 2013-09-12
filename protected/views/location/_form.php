<?php
/* @var $this LocationController */
/* @var $model Location */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget( 'CActiveForm', array(
	'id'=>'location-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary( $model ); ?>

	<div class="row">
		<?php echo $form->labelEx( $model, 'user_id' ); ?>
		<?php echo $form->textField( $model, 'user_id',array( 'size'=>20, 'maxlength'=>20 )); ?>
		<?php echo $form->error( $model, 'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'latitude' ); ?>
		<?php echo $form->textField( $model, 'latitude',array( 'size'=>5, 'maxlength'=>5 )); ?>
		<?php echo $form->error( $model, 'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'longitude' ); ?>
		<?php echo $form->textField( $model, 'longitude',array( 'size'=>5, 'maxlength'=>5 )); ?>
		<?php echo $form->error( $model, 'longitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'update_time' ); ?>
		<?php echo $form->textField( $model, 'update_time' ); ?>
		<?php echo $form->error( $model, 'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->