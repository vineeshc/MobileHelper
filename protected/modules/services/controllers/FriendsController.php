
<?php

class FriendsController extends ServiceController { 
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
				parent::errorMessage( 'Invalid Method' );
			}else if( 'POST' == $_SERVER['REQUEST_METHOD'] && true == isset( $_REQUEST['method'] ) && 'delete' == $_REQUEST['method'] ) {
				parent::errorMessage( 'Invalid Method' );
			} else if( 'POST' == $_SERVER['REQUEST_METHOD'] ) { 
				parent::errorMessage( 'Invalid Method' );
			} else if( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
				$this->run( 'GetFriends' );
			}
		}
	}
	
	// The method will provice web services required or fetched by a api call.
	public function actionGetFriends() {
		
		if( true == isset( $_REQUEST['id'] ) && false == is_null( $_REQUEST['id'] ) && true == is_numeric( $_REQUEST['id'] )) {
		
			$modelCatched = parent::getCatcheData( array('id'=>$_REQUEST['id'], 'class'=>'Friends' ));
			$fbFriends = "";
			if( true == $modelCatched ) {				
				$fbFriends = $modelCatched;				
				
			} else {							
				//Get Friends List from FB.	
				$Usersobj = Users::model()->findByPk( $_REQUEST['id'] );
				
				if(true == is_object( $Usersobj )) {
					$users = $Usersobj->getAttributes();
					$acessToken = $users['access_token'];
					$userId = $users['user_id'];
					$fbFriends = $this->getFacebookFriends($userId,$acessToken);					
					parent::setCatcheData( array( 'id'=>$userId, 'class'=>'Friends', 'value'=>$fbFriends ));
				}
				else {
					parent::errorMessage( 'No data found' );
				}				
			}
						
			if( true == is_object( $fbFriends )) {
				/* Filter the friends list based on distance */
				if(true == isset( $_REQUEST['distance'] ) && false == is_null( $_REQUEST['distance'] ) && true == is_numeric( $_REQUEST['distance'] )) {					
					//Find my current Location.
					$distance = $_REQUEST['distance'];
					$obj = Location::model()->findByPk( $_REQUEST['id'] );
					if(true == is_object( $obj )) {
						$location = $obj->getAttributes();		
						$latitude = $location['latitude'];
						$longitude = $location['longitude'];
						$fbFriendsIds = array();
						echo "<pre>";
						$fbFriendsIds = array();
						foreach($fbFriends->data as $key=>$val) {	
							$fbFriendsIds[] = $val->id;							
						}						
						if(isset($fbFriendsIds) && is_array($fbFriendsIds)) {																				
							$qry = "select user_id from (SELECT *,(((acos(sin((".$latitude."*pi()/180)) * sin((`latitude`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`latitude`*pi()/180)) * cos(((".$longitude."- `longitude`) *pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM location WHERE user_id in (" . implode(",",$fbFriendsIds) . ")) p where p.distance <= ".$distance."";
							
							$nearByFriendsObj = Location::model()->findBySql($qry);
							if(true == is_object( $nearByFriendsObj )) {
								$nearByFriends = $nearByFriendsObj->getAttributes();
								print_r($nearByFriends);
							}
							else {
								// Provide Some help line number near by in this case..... Nahi to bichara mar jayega...
								// Dont just show the below message. Its too hard to manage the situation for the user...
								parent::errorMessage( 'We are sorry :(:( No one to help you at this time.' );
							}
						}
						else {
							// Provide Some help line number near by in this case..... Nahi to bichara mar jayega...
							// Dont just show the below message. Its too hard to manage the situation for the user...
							parent::errorMessage( 'We are sorry :(:( No one to help you at this time.' );
						}
							
					}					
					else {						
						parent::errorMessage( 'Your current location is not available.' );
					}
				}				
			} else {
				parent::errorMessage( 'No data found' );
			}
			parent::sendResponse($fbFriends);
		} else {
			parent::errorMessage( 'No data found' );
		}
	}
	
	private function getFacebookFriends($userId,$acessToken){
		$ch = curl_init();		
		$facebookPostUrl = "https://graph.facebook.com/$userId/friends?fields=picture.width(200).height(200),id,name,gender&access_token=$acessToken";
		curl_setopt($ch, CURLOPT_URL, $facebookPostUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_POST,false);
		$contents = curl_exec($ch);
		curl_close($ch);		
		$info = json_decode($contents);
		if(isset($info->error)) {
			//FB Error.	
			parent::errorMessage( $info->error->message );
		}
		return $info;
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