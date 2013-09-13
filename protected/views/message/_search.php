<?php
/* @var $this MessageController */
/* @var $model Message */
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
		<?php echo $form->label( $model, 'message' ); ?>
		<?php echo $form->textField( $model, 'message',array( 'size'=>5, 'maxlength'=>5 )); ?>
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