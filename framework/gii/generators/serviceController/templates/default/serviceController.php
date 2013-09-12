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
	
	public function __construct() {
	}
	
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
	
	// The method will provice web services required or fetched by a api call.
	public function actionGet<?php echo $this->modelClass; ?>() {
		
		if( true == isset( $_REQUEST['<?php echo $this->tableSchema->primaryKey; ?>'] ) && false == is_null( $_REQUEST['<?php echo $this->tableSchema->primaryKey; ?>'] ) && true == is_numeric( $_REQUEST['<?php echo $this->tableSchema->primaryKey; ?>'] )) {
		
			$modelCatched = parent::getCatcheData( array('id'=>$_REQUEST['<?php echo $this->tableSchema->primaryKey; ?>'], 'class'=>'<?php echo $this->modelClass; ?>' ));
			
			if( true == $modelCatched ) {				
				$model = $modelCatched;				
				
			} else {							
				$model = <?php echo $this->modelClass; ?>::model()->findByPk( $_REQUEST['<?php echo $this->tableSchema->primaryKey; ?>'] );						 
				parent::setCatcheData( array( 'id'=>$_REQUEST['<?php echo $this->tableSchema->primaryKey; ?>'], 'class'=>'<?php echo $this->modelClass; ?>', 'value'=>$model ));
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
				
			$modelCatched = parent::getCatcheData(array('id'=>NULL, 'class'=>'<?php echo $this->modelClass; ?>' . $count . '_' . $start ));
			
			if( true == $modelCatched ) {										
				$model = $modelCatched;
			} else {
				
				$Criteria = new CDbCriteria();
				$Criteria->limit	= "$count";
				$Criteria->offset	= "$start";
				
				$model = <?php echo $this->modelClass; ?>::model()->findAll( $Criteria );
				parent::setCatcheData( array( 'id'=>NULL, 'class'=>'<?php echo $this->modelClass; ?>' . $count . '_' . $start, 'value'=>$model ));
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
	public function actionPost<?php echo $this->modelClass; ?>() {
		
		$model = new <?php echo $this->modelClass; ?>;
		
		if( isset($_POST['<?php echo $this->modelClass; ?>'])) {
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if( $model->save() ) {
				// success message
				parent::sendResponse( 'Inserted successfully' ); 
			} else {
				parent::errorMessage( 'Failed to insert data' );
			}
				
		}
	}
	
	// Update a row for a desired key.
	public function actionPut<?php echo $this->modelClass; ?>() {
		$id = $_POST['<?php echo $this->modelClass; ?>']['<?php echo $this->tableSchema->primaryKey; ?>'];
		$model=$this->loadModel( $id );

		if( isset($_POST['<?php echo $this->modelClass; ?>']) ) {
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if( $model->save() ) {
				// success message
				parent::sendResponse( 'Updated successfully' ); 
			} else {
				parent::errorMessage( 'Failed to update data' );
			}
		}
	}
	
	// Delete a row for a desired key. 
	public function actionDelete<?php echo $this->modelClass; ?>() {
		$id = $_POST['<?php echo $this->modelClass; ?>']['<?php echo $this->tableSchema->primaryKey; ?>'];
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
		$model = <?php echo $this->modelClass; ?>::model()->findByPk( $id );
		if( $model===null ) {
			return NULL;
		} else { 			
			return $model;
		}
	}

}