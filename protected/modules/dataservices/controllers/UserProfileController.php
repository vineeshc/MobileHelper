<?php

class UserProfileController extends DataserviceController { 
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
				$this->run( 'PutUserProfile' );
			}else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( 'DeleteUserProfile' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( 'PostUserProfile' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( 'GetUserInfo' );
			}
		}
	}
	
	public function actionView() {
		if( true == isset( $_SERVER['REQUEST_METHOD'] )) {
			if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'update' == $_REQUEST['method'] ) {
				$this->run( 'PutUserProfile' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( 'DeleteUserProfile' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( 'PostUserProfile' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( 'GetUserInfo' );
			}
		}
	}
	
	// Get user informations as per the fields 
	public function actionGetUserProfile() {
		//echo "Hiiii";
		//$getArray,$condition
		if(isset($_GET))
		{
			$getFieldArray = $_GET;	
				if(isset($_GET['condition']) && !empty($_GET['condition'])){
                       		$condition = $_GET['condition'];
                       }
		}
				$modelCatched = parent::getCatcheData( array('id'=>$_REQUEST['id'], 'class'=>'UserProfile' ));
				//$model = UserProfile::model()->findByPk( $_REQUEST['id'] );	
				$model =  UserProfile::model();
				$fieldArray = $model->getAttributes();
				$fields = array_keys($fieldArray);
				//print_r($fields);
				//$get = $_GET;
				//unset($get['set'], $get['condition']);
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
					/* //////////////////// New Condition //////////////////////////////////////
					 	$select = '*';
						if (isset($_POST['select'])) {
						 $select = $_POST['select'];
						}
						$criteria=new CDbCriteria;
						$criteria->select = $select;
						$criteria->condition='username=:userName OR email=:email';
						$criteria->params=array(':userName'=>$value1,':email'=>$value2);
						$usermodel=User::model()->find($criteria);
						
						$usermodel=User::model()->find('username=:userName OR email=:email',array(':userName'=>$value1,':email'=>$value2));
						//////////////////// New Condition //////////////////////////////////////
						*/
										
					//print_r($conditionString);echo "<br>";
					//print_r($paramArray);				
			   		//$usermodel=User::model()->find($criteria);
			   		//$usermodel=UserProfile::model()->find('username=:userName OR email=:email',array(':userName'=>$value1,':email'=>$value2));
			   		
					$select = '*';
					if (isset($_GET['select'])) {
						 $select = $_GET['select'];
					}
					
					$criteria=new CDbCriteria;
					$criteria->select = $select;
					$criteria->condition=$conditionString;
					$criteria->params=$paramArray;
					$usermodel=UserProfile::model()->find($criteria);
					print_r($usermodel->attributes);
				 		//$usermodel=UserProfile::model()->find($conditionString, $paramArray); 			///////Running
				}else{
							//echo "Hello";//$id =UserProfile::model()->tableSchema->primaryKey;
							$usermodel = UserProfile::model()->findAll();			
							foreach ($usermodel as $model) {
								$rows[] = $model->attributes;						
							}
							print_r($rows);
				}
				 if( true == is_object( $model )) {
				 	parent::sendResponse($model->getAttributes());
				 } else {
				 	parent::errorMessage( 'No data found' );
				 }
				return $usermodel->attributes;
				//$comments = UserProfile::model()->findAll('content LIKE :match',	array(':match' => "%$match%"));
				// $model = UserProfile::model()->findByAttributes(array($fields[4]=>$_GET['name'],$fields[3]=>$_GET['lastname']));
				//$model = UserProfile::model()->findByAttributes(array($str,'',''));
				//print_r($model);exit;
				parent::setCatcheData( array( 'id'=>$_REQUEST['id'], 'class'=>'UserProfile', 'value'=>$model ));
	}
	
	// Insert a value in the desired table
	public function actionPostUserProfile() {		
		$model = new UserProfile;		
		if( isset($_POST['UserProfile'])) {
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
		 $id = $_REQUEST['id'];
		$_POST['UserProfile'] = array('FirstName'=>'deepali2222');
		$model=$this->loadModel( $id );
		if( isset($_POST['UserProfile']) ) {
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
