<?php
/**
 * This is the template for generating a controller class file.
 * The following variables are available in this template:
 * - $this: the ControllerCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass; ?> { <?php echo "\n"; ?> 
	protected $accessToken;
	protected $deviceId;
	
	public function actionIndex() {
		//$accessToken	= $_REQUEST['access_token'];
		//$deviceId		= $_REQUEST['device_id'];
		//$deviceType	= $_REQUEST['device_type'];
	
		if( true == isset( $_REQUEST['access_token']) && 0 < count( $_REQUEST['access_token'] )) {
			$this->accessToken = $_REQUEST['access_token'];
		} else {
			parent::errorMessage('No valid access token.');
		}
		
		if( true == isset( $_SERVER['REQUEST_METHOD'] )) {
			if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'update' == $_REQUEST['method'] ) {
				$this->run( '<?php echo 'Put' . $this->modelClass; ?>' );
			}else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( '<?php echo 'Delete' . $this->modelClass; ?>' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( '<?php echo 'Post' . $this->modelClass; ?>' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( '<?php echo 'Get' . $this->modelClass; ?>' );
			}
		}
	}
	
	public function actionView() {
		if( true == isset( $_SERVER['REQUEST_METHOD'] )) {
			if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'update' == $_REQUEST['method'] ) {
				$this->run( '<?php echo 'Put' . $this->modelClass; ?>' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( '<?php echo 'Delete' . $this->modelClass; ?>' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( '<?php echo 'Post' . $this->modelClass; ?>' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( '<?php echo 'Get' . $this->modelClass; ?>' );
			}
		}
	}
	
	// Get user informations as per the fields 
	public function actionGett<?php echo $this->modelClass; ?>() {
	
		$getFieldArray = $_GET;	
		$condition = $_GET['condition'];
			
				$model =  <?php echo $this->modelClass; ?>::model();
				$fieldArray = $model->getAttributes();
				$fields = array_keys($fieldArray);
			//	print_r($fields);
				//$get = $_GET;
				//unset($get['set'], $get['condition']);
				$getArray= array_keys($getFieldArray);
				//print_r($_GET);exit;
				$criteriaCondition = (isset($condition) && !empty($condition) ) ? $condition: 'AND';
				// step 0: remove indexes which are not the fields
				// step 1: create the condition string array and params array
				
				foreach (  $getArray as $key => $value ) {	
								
					if(in_array($value,$fields)){
					$conditionStringArray[] = "$getArray[$key] = :$getArray[$key]";
					
					// step 3: create the params from condition array
					$paramArray[":$getArray[$key]"] = $getFieldArray[$getArray[$key]];
					}
				}
				// step 2: create the condition string from array
				$conditionString = implode(" $criteriaCondition ", $conditionStringArray);
			
				 $usermodel=<?php echo $this->modelClass; ?>::model()->find($conditionString, $paramArray);
			
				 print_r($usermodel->attributes);
				
				 if( true == is_object( $model )) {
				 	parent::sendResponse($model->getAttributes());
				 } else {
				 	parent::errorMessage( 'No data found' );
				 }
				return $usermodel->attributes;
	}
	
	// Insert a value in the desired table
	public function actionPost<?php echo $this->modelClass; ?>() {		
		$model = new <?php echo $this->modelClass; ?>;		
		if( isset($userProfileArray)) {
			$model->attributes=$_POST['UserProfile'];
			//$model->attributes=$userProfileArray;
			if( $model->save() ) {
				// success message
				//parent::sendResponse( 'Inserted successfully' ); 
				$str = 'Inserted successfully';
			} else {
				//parent::errorMessage( 'Failed to insert data' );
				$str = 'Failed to insert data';
			}
				return $str;
		}
	}
	
	// Update a row for a desired key.
	public function actionPutUserProfile() {
		$id = $_REQUEST['UserProfile']['id'];
		$model=$this->loadModel( $id );
		if( isset($userProfileArray) ) {
		 $model->attributes=$_POST['UserProfile'];
			//$model->attributes=$userProfileArray;
			if( $model->save() ) {
				// success message
				//parent::sendResponse( 'Updated successfully' );
				$str = 'Updated successfully';
			} else {
				//parent::errorMessage( 'Failed to update data' );
				$str = 'Failed to update data';
			}
			return $str;
		}
	}
	
	// Delete a row for a desired key. 
	public function actionDeleteUserProfile() {
		$id = $_REQUEST['UserProfile']['id'];
		if( true == $this->loadModel( $id )->delete() ) { 
			// success message
			//parent::sendResponse( 'Deleted successfully' ); 
			$str = 'Deleted successfully';
		} else {
			//parent::errorMessage( 'Failed to delete.' );
			$str = 'Failed to delete.';
		}
			return $str;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel( $id ) {
		$model = UserProfile::model()->findByPk( $id );
		if( $model===null ) {
			return NULL;
		} else { 			
			return $model;
		}
	}

}
