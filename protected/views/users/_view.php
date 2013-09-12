<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'user_id' )); ?>:</b>
	<?php echo CHtml::link(CHtml::encode( $data->user_id ), array( 'view', 'id'=>$data->user_id )); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'username' )); ?>:</b>
	<?php echo CHtml::encode( $data->username ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'firstname' )); ?>:</b>
	<?php echo CHtml::encode( $data->firstname ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'lastname' )); ?>:</b>
	<?php echo CHtml::encode( $data->lastname ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'profile_pic' )); ?>:</b>
	<?php echo CHtml::encode( $data->profile_pic ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'gender' )); ?>:</b>
	<?php echo CHtml::encode( $data->gender ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'age' )); ?>:</b>
	<?php echo CHtml::encode( $data->age ); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'birthday' )); ?>:</b>
	<?php echo CHtml::encode( $data->birthday ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'email' )); ?>:</b>
	<?php echo CHtml::encode( $data->email ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'country' )); ?>:</b>
	<?php echo CHtml::encode( $data->country ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'city' )); ?>:</b>
	<?php echo CHtml::encode( $data->city ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'state' )); ?>:</b>
	<?php echo CHtml::encode( $data->state ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'zip' )); ?>:</b>
	<?php echo CHtml::encode( $data->zip ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'update_time' )); ?>:</b>
	<?php echo CHtml::encode( $data->update_time ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'access_token' )); ?>:</b>
	<?php echo CHtml::encode( $data->access_token ); ?>
	<br />

	*/ ?>

</div>