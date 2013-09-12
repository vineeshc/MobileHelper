<?php

class ConfigurationController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		// Parse without sections
		$settings = Config::settings();
		
		// collect user input data
		if ( isset($_POST['ConfigForm']) ) {
			$attributes = $_POST['ConfigForm'];
			// print_r($attributes) ;
			
			// create an array with only value field for merging with original settings
			Config::prepareSettings($attributes, $settings);
			// print_r($settings) ;
			
			// Now write the settings back to ini file. Note : it doesnt retails the comments.
			if ( Config::write_php_ini($settings) )	{		
				$this->redirect('');
				
			}
		}
		// display the login form
		$this->render('config', array('settings' => $settings));
	}	
	
	public function actionSettings() {
		// initialize the Config class this way
		$settings = new Config();
		// And access as below
		print_r($settings->settings);
	}
}