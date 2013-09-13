<?php
/* @var $this MessageController */
/* @var $data Message */
?>

<div class="view">

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'user_id' )); ?>:</b>
	<?php echo CHtml::link(CHtml::encode( $data->user_id ), array( 'view', 'id'=>$data->user_id )); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'message' )); ?>:</b>
	<?php echo CHtml::encode( $data->message ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'update_time' )); ?>:</b>
	<?php echo CHtml::encode( $data->update_time ); ?>
	<br />


</div>