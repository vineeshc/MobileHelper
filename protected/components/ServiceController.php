<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ServiceController extends Controller {
	
	public function jsonOutput( $result = '', $return = false ) {
		
		$json = json_encode($result);
		
		if( $return ) {
			return $json;
		} else {
			echo $json;
			//exit;
		}
	}
	
	public function returnResponse( $result='' ) {
		$response['resultStatus']	= 1;
		$response['response']		= $result;
		if ( UserIdentity::$newTokenGenerated ) {
			$response['newAccessToken'] = UserIdentity::$accessToken;
		}
		return $response;
	}
	
	public function errorMessage( $errMsgOrId = '', $statusCode = 200, $content_type = 'text/html' ) {

		$status					= 200;
		$result['resultStatus']	= 0;
		$result['response']		= '';
		$message				= ( is_numeric( $errMsgOrId )) ? self::getErrorMessage( $errMsgOrId ) : $errMsgOrId;
		$result['error']		= array('message'=>$message, 'status_code'=>$statusCode);
		$status_header			= 'HTTP/1.1 ' . $status . ' ' . self::getStatusCodeMessage($statusCode);
		header($status_header);
		// and the content type
		header( 'Content-type: ' . $content_type );	
		self::jsonOutput( $result );
		Yii::app()->end();
	}
	
	public function sendResponse( $result = '', $return = false, $content_type = 'text/html' ) {
		$status	= 200;
		if( true == is_array( $result ) && isset( $result['resultStatus'] )){
			$response['resultStatus']	= 1;
			$response['response']		= $result['response'];
			if ( isset($result['newAccessToken']) ) {
				$response['newAccessToken'] = $result['newAccessToken'];
			}
		} else {
			$response['resultStatus']	= 1;
			$response['response']		= $result;
		}	
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . self::getStatusCodeMessage( $status );
		header($status_header);
		// and the content type
		header( 'Content-type: ' . $content_type );
		
		self::jsonOutput($response);
	}
	
	/**
	 * Set status code message
	 * @param number $status
	 * @return string
	 */
	private function getErrorMessage( $errMsgId ) {
		// these could be stored in a .ini file and loaded
		// via parse_ini_file()... however, this will suffice
		// for an example
		$message = Array(
				//input error, missing
				'1001'	=> 'Input error!!!',
				
				//Authentication and token related
				'1011'	=> 'Invalid username/password',
				'1012'	=> 'Invalid token',
				'1013'	=> 'Log out failed',
				'1014'	=> 'Invalid token, please login',
				'1015'	=> 'Token expired, please login again',
				
				//alerts/result related
				'1021'	=> 'No records to show.',
				'1022'	=> 'Remove failed',
				//
				'1031'	=> 'Category update failed',
				'1032'	=> 'Publishers update failed',
				'1033'	=> 'Email failed!'
				
						);
			return (isset($message[$errMsgId])) ? $message[$errMsgId] : '';
	}
	
	/**
	 * Set status code message
	 * @param number $status
	 * @return string
	 */
	private function getStatusCodeMessage( $status ) {
		// these could be stored in a .ini file and loaded
		// via parse_ini_file()... however, this will suffice
		// for an example
		$codes = Array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);
		return ( isset( $codes[$status] )) ? $codes[$status] : '';
	}
	
	public function getCatcheData( $arr ) {
		
		if( $arr['id'] == NULL ) {
			$refIDCache = $arr['class'];
			} else {
				$refIDCache = $arr['id'].$arr['class'];				
			}					
			$value=Yii::app()->cache->get($refIDCache);
			return $value;	
	}
	
	public function setCatcheData( $arr ) {	
		if( $arr['id'] != NULL ) {
			$id = $arr['id'].$arr['class'];
		} else {
			$id = $arr['class'];
		}		
		//setting the whole model in cached		
		Yii::app()->cache->set( $id, $arr['value'], 10 );	
	}
	

}