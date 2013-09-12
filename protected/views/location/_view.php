<?php
/* @var $this LocationController */
/* @var $data Location */
?>

<div class="view">

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'user_id' )); ?>:</b>
	<?php echo CHtml::link(CHtml::encode( $data->user_id ), array( 'view', 'id'=>$data->user_id )); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'latitude' )); ?>:</b>
	<?php echo CHtml::encode( $data->latitude ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'longitude' )); ?>:</b>
	<?php echo CHtml::encode( $data->longitude ); ?>
	<br />

	<b><?php echo CHtml::encode( $data->getAttributeLabel( 'update_time' )); ?>:</b>
	<?php echo CHtml::encode( $data->update_time ); ?>
	<br />


</div>