<?php

class UsersController extends ServiceController { 
	protected $accessToken;
	protected $deviceId;
	
	public function __construct() {
	}
	
	public function actionIndex() {
		//$accessToken	= $_REQUEST['access_token'];
		//$deviceId		= $_REQUEST['device_id'];
		//$deviceType	= $_REQUEST['device_type'];
	
		/*if( true == isset( $_REQUEST['access_token']) && 0 < count( $_REQUEST['access_token'] )) {
			$this->accessToken = $_REQUEST['access_token'];
		} else {
			parent::errorMessage('No valid access token.');
		}*/
		
		if( true == isset( $_SERVER['REQUEST_METHOD'] )) {
			if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'update' == $_REQUEST['method'] ) {
				$this->run( 'PutUsers' );
			}else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( 'DeleteUsers' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( 'PostUsers' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( 'GetUsers' );
			}
		}
	}
	
	public function actionView() {
		if( true == isset( $_SERVER['REQUEST_METHOD'] )) {
			if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'update' == $_REQUEST['method'] ) {
				$this->run( 'PutUsers' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				$this->run( 'DeleteUsers' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				$this->run( 'PostUsers' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( 'GetUsers' );
			}
		}
	}
	
	// The method will provice web services required or fetched by a api call.
	public function actionGetUsers() {
		
		if( true == isset( $_REQUEST['id'] ) && false == is_null( $_REQUEST['id'] ) && true == is_numeric( $_REQUEST['id'] )) {
		
			$modelCatched = parent::getCatcheData( array('id'=>$_REQUEST['id'], 'class'=>'Users' ));
			
			if( true == $modelCatched ) {				
				$model = $modelCatched;				
				
			} else {							
				$model = Users::model()->findByPk( $_REQUEST['id'] );						 
				parent::setCatcheData( array( 'id'=>$_REQUEST['id'], 'class'=>'Users', 'value'=>$model ));
			}
						
			if( true == is_object( $model )) {
				parent::sendResponse($model->getAttributes());
			} else {
				parent::errorMessage( 'No data found' );
			}
		} else {
		
				$start = 0;
				$count = 100;
				
				if( true == isset( $_REQUEST['start'] )) {
					$start = $_REQUEST['start'];
				}
				
				if( true == isset( $_REQUEST['count'] )) {
					$count = $_REQUEST['count'];
				}
				
			$modelCatched = parent::getCatcheData(array('id'=>NULL, 'class'=>'Users' . $count . '_' . $start ));
			
			if( true == $modelCatched ) {										
				$model = $modelCatched;
			} else {
				
				$Criteria = new CDbCriteria();
				$Criteria->limit	= "$count";
				$Criteria->offset	= "$start";
				
				$model = Users::model()->findAll( $Criteria );
				parent::setCatcheData( array( 'id'=>NULL, 'class'=>'Users' . $count . '_' . $start, 'value'=>$model ));
			}
			
			if( true == is_array( $model ) && 0 < count( $model )) {
				$arrModel = array();
				foreach( $model as $objData ) {
					array_push( $arrModel, $objData->getAttributes() );
				}
				parent::sendResponse($arrModel);
			} else {
				parent::errorMessage( 'No data found' );
			}
		}
	}

	// Insert a value in the desired table
	public function actionPostUsers() {
		
		$model = new Users;
		
		if( isset($_POST['Users'])) {
			$model->attributes=$_POST['Users'];
			if( $model->save() ) {
				// success message
				parent::sendResponse( 'Inserted successfully' ); 
			} else {
				parent::errorMessage( 'Failed to insert data' );
			}
				
		}
	}
	
	// Update a row for a desired key.
	public function actionPutUsers() {
		$id = $_POST['Users']['user_id'];
		$model=$this->loadModel( $id );

		if( isset($_POST['Users']) ) {
			$model->attributes=$_POST['Users'];
			if( $model->save() ) {
				// success message
				parent::sendResponse( 'Updated successfully' ); 
			} else {
				parent::errorMessage( 'Failed to update data' );
			}
		}
	}
	
	// Delete a row for a desired key. 
	public function actionDeleteUsers() {
		$id = $_POST['Users']['user_id'];
		if( true == $this->loadModel( $id )->delete() ) { 
			// success message
			parent::sendResponse( 'Deleted successfully' ); 
		} else {
			parent::errorMessage( 'Failed to delete.' );
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel( $id ) {
		$model = Users::model()->findByPk( $id );
		if( $model===null ) {
			return NULL;
		} else { 			
			return $model;
		}
	}

}
