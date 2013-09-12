<?php

/**
 * @author : sanjeev
 * Config is for configuring the configuration file.
 * It contains the validate method that checks all values provided properly
 * It contains the configure method to save the values
 * It contains the settings to get the saved values
 */
class Config {
	
	public $settings;
	
	/**
	 * @param string $type for constructing the settings either object or array
	 */
	public function __construct($type = 'object') {
		
		$settings = $this->settings();
		foreach ( $settings as $key => $value ) {
			$values[$key] = $value['value'];
		}
		if ( $type == 'object') 
			$this->settings = ( object ) $values;
			// $this->settings = json_decode(json_encode($values, false));
		else // $type = 'array'
			$this->settings = $values;
	}
	/**
	 * validate the input values
	 * @return boolean whether validation succeeds.
	 */
	public function validate() {
		
	}
	
	/**
	 * configure the values into file
	 */
	public function configure() {
		
	}
	
	/**
	 * settings gets the array or objects. Objects by default
	 * @param $type is the return type. default is object.
	 * options available or object and array 
	 */
	public function settings( $type = 'array' ) {
		// read the settings file
		# TODO change the hardcoded path to params
		$settings = parse_ini_file("protected/config/settings.ini", true);
		# TODO consider the $type return
		return $settings;
	}
	
	/**
	 * prepare settings from posted input
	 * @param $postedSettings array the input fields from post method
	 * @param $settings array of settings read from file
	 */
	public function prepareSettings($postedSettings, &$settings = array()) {
		$preparedSettings = array(); 
		
		// Pass through the settings and assign values to the $preparedSettings array
		foreach ( $settings as $key => $setting ) {
			// get the input type
			$inputType = ( isset($setting['type']) ) ? $setting['type'] : 'text';

			// get values depending on type of field it is
			// if checkbox get the values and implode it
			if ( $inputType == 'checkbox' ) {
				// if key is updated
				if ( is_array($postedSettings) && isset($postedSettings[$key]) ) {
					$settings[$key]['value'] = implode(",", $postedSettings[$key]);
				} else {
					$settings[$key]['value'] = NULL;
				}
			} else {			
				// if rado / text then assign single value
				if ( is_array($postedSettings) && isset($postedSettings[$key]) ) {
					$settings[$key]['value'] = $postedSettings[$key];
				} else {
					$settings[$key]['value'] = NULL;
				}				
			}
		}
		
	}
	
	public function write_php_ini( $array, $file='' )
	{
		$res = array();
		foreach( $array as $key => $val ) { // level 1 -> keys
			if( is_array($val) ) { 
				
				$res[] = "[$key]";
				foreach( $val as $skey => $sval ) {
					// $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
					if( is_array($sval) ) { // level 2 -> options
					
						// $res[] = "[$skey]"; // options [value] = label
						foreach( $sval as $sskey => $ssval ) {
							//print_r($sskey);exit;
							$res[] = $skey."[$sskey] = ".(is_numeric($ssval) ? $ssval : '"'.$ssval.'"');
						}
					} else {
						$res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
					}
				}
			} else {
				$res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
			}
			$res[] = '';
		}
		//print_r(implode("\r\n", $res));exit;
		//echo __FILE__; exit;
		return self::safefilerewrite("/var/www/html/accelerator/protected/config/settings.ini", implode("\r\n", $res));
	}
	
	//////
	function safefilerewrite($fileName, $dataToSave) {
		if ($fp = fopen($fileName, 'w'))
		{
			$startTime = microtime();
			do
			{            $canWrite = flock($fp, LOCK_EX);
			// If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
			if(!$canWrite) usleep(round(rand(0, 100)*1000));
			} while ((!$canWrite)and((microtime()-$startTime) < 1000));
		
			// file was locked so now we can store information
			if ($canWrite)
			{            fwrite($fp, $dataToSave);
			flock($fp, LOCK_UN);
			}
			fclose($fp);
			return true;
		}
	
	}
	
	public function write_php_ini_old($array, $file='')
	{
		$res = array();
		foreach($array as $key => $val)
		{
			if(is_array($val))
			{
				$res[] = "[$key]";
				foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
			}
			else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
		}
		print_r(implode("\r\n", $res));exit;
		//safefilerewrite($file, implode("\r\n", $res));
	}
}