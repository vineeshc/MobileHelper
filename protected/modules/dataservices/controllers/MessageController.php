<?php

class MessageController extends ServiceController { 
 
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
				$this->run( 'PutMessage' );
			}else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( 'DeleteMessage' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( 'PostMessage' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( 'GetMessage' );
			}
		}
	}
	
	public function actionView() {
		if( true == isset( $_SERVER['REQUEST_METHOD'] )) {
			if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'update' == $_REQUEST['method'] ) {
				$this->run( 'PutMessage' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( 'DeleteMessage' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( 'PostMessage' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( 'GetMessage' );
			}
		}
	}
	
	// Get user informations as per the fields 
	public function actionGetMessage() {		
		if( isset( $_GET )) {
			$getFieldArray = $_GET;	
			$condition = $_GET['condition'];
		}
				$model =  Message::model();
				$fieldArray = $model->getAttributes();
				$fields = array_keys($fieldArray);
				$getArray= array_keys($getFieldArray);
				//print_r($_GET);exit;
				$criteriaCondition = (isset($condition) && !empty($condition) ) ? $condition: 'AND';
				
				// step 0: remove indexes which are not the fields
				// step 1: create the condition string array and params array
				if(isset($getArray) && !empty($getArray)){
						foreach (  $getArray as $key => $value ) {	
										
							if(in_array($value,$fields)){
							$conditionStringArray[] = "$getArray[$key] = :$getArray[$key]";
							
							// step 3: create the params from condition array
							$paramArray[":$getArray[$key]"] = $getFieldArray[$getArray[$key]];
							}
						}
				// step 2: create the condition string from array
					$conditionString = implode(" $criteriaCondition ", $conditionStringArray);
					//print_r($conditionString);
					//print_r($paramArray);	
					
						$select = '*';
					if (isset($_GET['select'])) {
						 $select = $_GET['select'];
					}
					
					$criteria=new CDbCriteria;
					$criteria->select = $select;
					$criteria->condition=$conditionString;
					$criteria->params=$paramArray;
					$usermodel=Message::model()->find($criteria);
					print_r($usermodel->attributes);
					
				}else{					
					$usermodel = Message::model()->findAll();			
						foreach ($usermodel as $model) {
							$rows[] = $model->attributes;						
						}
						//print_r($rows);
					}
				 	//print_r($usermodel->attributes);
				 
				 if( true == is_object( $model )) {
				 	parent::sendResponse($model->getAttributes());
				 } else {
				 	parent::errorMessage( 'No data found' );
				 }
				return $usermodel->attributes;
	}
	
	// Insert a value in the desired table
	public function actionPostMessage() {		
		$model = new Message;		
		if( true == isset( $_POST['Message'] )) {
			$model->attributes=$_POST['Message'];
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
	public function actionPutMessage() {
		$id = $_REQUEST['user_id'];
		$model=$this->loadModel( $id );
		if( isset($_POST['Message']) ) {
		 $model->attributes=$_POST['Message'];
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
	public function actionDeleteMessage() {
		$id = $_REQUEST['user_id'];
		$model =  $this->loadModel( $id );
		if( true == $model &&  $model->delete()) { 
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
		$model = Message::model()->findByPk( $id );
		if( $model===null ) {
			return NULL;
		} else { 			
			return $model;
		}
	}

}
