<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget( 'CActiveForm', array(
	'id'=>'users-form',
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
		<?php echo $form->labelEx( $model, 'username' ); ?>
		<?php echo $form->textField( $model, 'username',array( 'size'=>50, 'maxlength'=>50 )); ?>
		<?php echo $form->error( $model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'firstname' ); ?>
		<?php echo $form->textField( $model, 'firstname',array( 'size'=>50, 'maxlength'=>50 )); ?>
		<?php echo $form->error( $model, 'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'lastname' ); ?>
		<?php echo $form->textField( $model, 'lastname',array( 'size'=>50, 'maxlength'=>50 )); ?>
		<?php echo $form->error( $model, 'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'profile_pic' ); ?>
		<?php echo $form->textField( $model, 'profile_pic',array( 'size'=>60, 'maxlength'=>100 )); ?>
		<?php echo $form->error( $model, 'profile_pic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'gender' ); ?>
		<?php echo $form->textField( $model, 'gender',array( 'size'=>50, 'maxlength'=>50 )); ?>
		<?php echo $form->error( $model, 'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'age' ); ?>
		<?php echo $form->textField( $model, 'age' ); ?>
		<?php echo $form->error( $model, 'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'birthday' ); ?>
		<?php echo $form->textField( $model, 'birthday',array( 'size'=>60, 'maxlength'=>250 )); ?>
		<?php echo $form->error( $model, 'birthday'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'email' ); ?>
		<?php echo $form->textField( $model, 'email',array( 'size'=>60, 'maxlength'=>2500 )); ?>
		<?php echo $form->error( $model, 'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'country' ); ?>
		<?php echo $form->textField( $model, 'country',array( 'size'=>60, 'maxlength'=>125 )); ?>
		<?php echo $form->error( $model, 'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'city' ); ?>
		<?php echo $form->textField( $model, 'city',array( 'size'=>60, 'maxlength'=>125 )); ?>
		<?php echo $form->error( $model, 'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'state' ); ?>
		<?php echo $form->textField( $model, 'state',array( 'size'=>60, 'maxlength'=>125 )); ?>
		<?php echo $form->error( $model, 'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'zip' ); ?>
		<?php echo $form->textField( $model, 'zip',array( 'size'=>10, 'maxlength'=>10 )); ?>
		<?php echo $form->error( $model, 'zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'update_time' ); ?>
		<?php echo $form->textField( $model, 'update_time' ); ?>
		<?php echo $form->error( $model, 'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx( $model, 'access_token' ); ?>
		<?php echo $form->textField( $model, 'access_token',array( 'size'=>60, 'maxlength'=>2500 )); ?>
		<?php echo $form->error( $model, 'access_token'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->