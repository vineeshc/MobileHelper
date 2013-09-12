<?php
/* @var $this AdressTypesController */

?>
<h1>Configuration manager</h1>

<p>
	You may update the below settings
</p>
<div class="form">
	<form id="config-form" action="" method="post">
		<?php /*?><div class="row">
	        <label for="ConfigForm_username" class="required">Username <span class="required">*</span></label>		
	        <input name="ConfigForm[username]" id="ConfigForm_username" type="text" />		<div class="errorMessage" id="ConfigForm_username_em_" style="display:none"></div>
		
	    </div><?php */?>
	    
	    <?php foreach ( $settings as $key => $setting ) { 
	    	// supported are only text radio and checkbox. default is text type.
	    	$inputType = ( isset($setting['type']) ) ? $setting['type'] : 'text'; 
	    	// default value if any
	    	$default = ( array_key_exists('default', $setting) ) ? $setting['default'] : NULL;
	    	// currently only checked is supported and only one option supported.
	    	// $checked = ( isset($default) && $setting['value'] == $default ) ? 'checked' : '';
	    	// $selected = ( isset($default) && $setting['value'] == $default ) ? 'selected' : '';
	    	?>
	    <div class="row">
	        <label for="ConfigForm_<?php echo $key?>" class="required"><?php echo ( !empty($setting['label']) )?$setting['label']:( ucfirst($key) )?></label>
	        <?php if ( $inputType == 'radio' || $inputType == 'checkbox' ) {
	        	$options = ( array_key_exists('options', $setting) ) ? $setting['options'] : array($setting['value']=>'');
	        	foreach ( $options as $optionValue => $optionLabel ) {
					$inputName = ( $inputType == 'radio' ) ? 'ConfigForm['.$key.']' : 'ConfigForm['.$key.']['.$optionValue.']';
					$inputId = 'ConfigForm_'.$key.'_'.$optionValue;
					$checked = ( isset($default) && $optionValue == $default ) ? 'checked' : '';
					// assume value is given then check with value instead of default
					$checked = ( isset($setting['value']) && $optionValue == $setting['value'] ) ? 'checked' : '';
					$inputValue = $optionValue;
					$inputLabel = $optionLabel;
	        	?>		
	        	<input name="<?php echo $inputName?>" id="<?php echo $inputId?>" type="<?php echo $inputType?>" <?php echo $checked;?> value="<?php echo $inputValue?>" /> <?php echo $inputLabel;?>
	        <?php 
				}
			} else { // text type ?>
	        <input name="ConfigForm[<?php echo $key?>]" id="ConfigForm_<?php echo $key?>" type="text" value="<?php echo $setting['value']?>" />
	        <?php } ?>		
	        <div class="errorMessage" id="ConfigForm_<?php echo $key?>_em" style="display:none"></div>
		
	    </div>
	    <?php } ?>
	 
	 	<div class="row">
	 	&nbsp;
	 	</div>
	    <div class="row submit">
	        <?php echo CHtml::submitButton('Configure'); ?>
	    </div>
	</form>
</div>
