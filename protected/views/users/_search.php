<?php
/* @var $this UsersController */
/* @var $model Users */
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
		<?php echo $form->label( $model, 'username' ); ?>
		<?php echo $form->textField( $model, 'username',array( 'size'=>50, 'maxlength'=>50 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'firstname' ); ?>
		<?php echo $form->textField( $model, 'firstname',array( 'size'=>50, 'maxlength'=>50 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'lastname' ); ?>
		<?php echo $form->textField( $model, 'lastname',array( 'size'=>50, 'maxlength'=>50 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'profile_pic' ); ?>
		<?php echo $form->textField( $model, 'profile_pic',array( 'size'=>60, 'maxlength'=>100 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'gender' ); ?>
		<?php echo $form->textField( $model, 'gender',array( 'size'=>50, 'maxlength'=>50 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'age' ); ?>
		<?php echo $form->textField( $model, 'age' ); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'birthday' ); ?>
		<?php echo $form->textField( $model, 'birthday',array( 'size'=>60, 'maxlength'=>250 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'email' ); ?>
		<?php echo $form->textField( $model, 'email',array( 'size'=>60, 'maxlength'=>2500 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'country' ); ?>
		<?php echo $form->textField( $model, 'country',array( 'size'=>60, 'maxlength'=>125 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'city' ); ?>
		<?php echo $form->textField( $model, 'city',array( 'size'=>60, 'maxlength'=>125 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'state' ); ?>
		<?php echo $form->textField( $model, 'state',array( 'size'=>60, 'maxlength'=>125 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'zip' ); ?>
		<?php echo $form->textField( $model, 'zip',array( 'size'=>10, 'maxlength'=>10 )); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'update_time' ); ?>
		<?php echo $form->textField( $model, 'update_time' ); ?>
	</div>

	<div class="row">
		<?php echo $form->label( $model, 'access_token' ); ?>
		<?php echo $form->textField( $model, 'access_token',array( 'size'=>60, 'maxlength'=>2500 )); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton( 'Search' ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->