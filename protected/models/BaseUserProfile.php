<?php

/**
 * This is the base model class for table "user_profile".
 *
 * The followings are the available columns in table 'user_profile':
 * @property string $UserName
 * @property integer $id
 * @property string $Password
 * @property string $LastName
 * @property string $FirstName
 * @property string $Address
 * @property integer $status
 * @property string $statusdate
 * @property string $cardtype
 * @property string $cardnumber
 * @property string $exactnameoncard
 * @property string $expiredate
 * @property string $State
 * @property string $Country
 * @property string $PostalCode
 * @property string $TelNos
 * @property string $EmailAdd
 * @property string $City
 * @property string $last_log
 * @property integer $is_online
 * @property integer $is_alerted
 * @property integer $notify_type
 * @property integer $membershiptype
 * @property integer $datestarts
 * @property integer $dateends
 * @property string $old_cardtype
 * @property string $old_cardno
 * @property string $old_exactname
 * @property string $old_expiration
 * @property string $wirelessno
 * @property string $serviceprovider
 * @property integer $mrgID
 * @property string $mypublisher
 * @property string $removednews
 * @property integer $regdate
 * @property string $mycategories
 * @property integer $isdirty
 * @property integer $logintime
 * @property string $relationship_status
 * @property string $birthday
 * @property string $facebook_access_token
 * @property string $gender
 * @property string $FacebookID
 * @property integer $subscription_flag
 */
class BaseUserProfile extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserProfile the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'user_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'last_log', 'required' ),
			array( 'status, is_online, is_alerted, notify_type, membershiptype, datestarts, dateends, mrgID, regdate, isdirty, logintime, subscription_flag', 'numerical', 'integerOnly'=>true ),
			array( 'UserName, Password, LastName, FirstName, cardtype, cardnumber, exactnameoncard, expiredate, State, Country, PostalCode, TelNos, EmailAdd, City, old_cardtype, relationship_status', 'length', 'max'=>50),
			array( 'old_cardno, old_exactname, old_expiration', 'length', 'max'=>255),
			array( 'facebook_access_token', 'length', 'max'=>500),
			array( 'gender', 'length', 'max'=>6),
			array( 'FacebookID', 'length', 'max'=>100),
			array( 'Address, statusdate, wirelessno, serviceprovider, mypublisher, removednews, mycategories, birthday', 'safe' ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'UserName, id, Password, LastName, FirstName, Address, status, statusdate, cardtype, cardnumber, exactnameoncard, expiredate, State, Country, PostalCode, TelNos, EmailAdd, City, last_log, is_online, is_alerted, notify_type, membershiptype, datestarts, dateends, old_cardtype, old_cardno, old_exactname, old_expiration, wirelessno, serviceprovider, mrgID, mypublisher, removednews, regdate, mycategories, isdirty, logintime, relationship_status, birthday, facebook_access_token, gender, FacebookID, subscription_flag', 'safe', 'on'=>'search' ),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'UserName' => 'User Name',
			'id' => 'ID',
			'Password' => 'Password',
			'LastName' => 'Last Name',
			'FirstName' => 'First Name',
			'Address' => 'Address',
			'status' => 'Status',
			'statusdate' => 'Statusdate',
			'cardtype' => 'Cardtype',
			'cardnumber' => 'Cardnumber',
			'exactnameoncard' => 'Exactnameoncard',
			'expiredate' => 'Expiredate',
			'State' => 'State',
			'Country' => 'Country',
			'PostalCode' => 'Postal Code',
			'TelNos' => 'Tel Nos',
			'EmailAdd' => 'Email Add',
			'City' => 'City',
			'last_log' => 'Last Log',
			'is_online' => 'Is Online',
			'is_alerted' => 'Is Alerted',
			'notify_type' => 'Notify Type',
			'membershiptype' => 'Membershiptype',
			'datestarts' => 'Datestarts',
			'dateends' => 'Dateends',
			'old_cardtype' => 'Old Cardtype',
			'old_cardno' => 'Old Cardno',
			'old_exactname' => 'Old Exactname',
			'old_expiration' => 'Old Expiration',
			'wirelessno' => 'Wirelessno',
			'serviceprovider' => 'Serviceprovider',
			'mrgID' => 'Mrg',
			'mypublisher' => 'Mypublisher',
			'removednews' => 'Removednews',
			'regdate' => 'Regdate',
			'mycategories' => 'Mycategories',
			'isdirty' => 'Isdirty',
			'logintime' => 'Logintime',
			'relationship_status' => 'Relationship Status',
			'birthday' => 'Birthday',
			'facebook_access_token' => 'Facebook Access Token',
			'gender' => 'Gender',
			'FacebookID' => 'Facebook',
			'subscription_flag' => 'Subscription Flag',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare( 'UserName', $this->UserName, true );
		$criteria->compare( 'id', $this->id );
		$criteria->compare( 'Password', $this->Password, true );
		$criteria->compare( 'LastName', $this->LastName, true );
		$criteria->compare( 'FirstName', $this->FirstName, true );
		$criteria->compare( 'Address', $this->Address, true );
		$criteria->compare( 'status', $this->status );
		$criteria->compare( 'statusdate', $this->statusdate, true );
		$criteria->compare( 'cardtype', $this->cardtype, true );
		$criteria->compare( 'cardnumber', $this->cardnumber, true );
		$criteria->compare( 'exactnameoncard', $this->exactnameoncard, true );
		$criteria->compare( 'expiredate', $this->expiredate, true );
		$criteria->compare( 'State', $this->State, true );
		$criteria->compare( 'Country', $this->Country, true );
		$criteria->compare( 'PostalCode', $this->PostalCode, true );
		$criteria->compare( 'TelNos', $this->TelNos, true );
		$criteria->compare( 'EmailAdd', $this->EmailAdd, true );
		$criteria->compare( 'City', $this->City, true );
		$criteria->compare( 'last_log', $this->last_log, true );
		$criteria->compare( 'is_online', $this->is_online );
		$criteria->compare( 'is_alerted', $this->is_alerted );
		$criteria->compare( 'notify_type', $this->notify_type );
		$criteria->compare( 'membershiptype', $this->membershiptype );
		$criteria->compare( 'datestarts', $this->datestarts );
		$criteria->compare( 'dateends', $this->dateends );
		$criteria->compare( 'old_cardtype', $this->old_cardtype, true );
		$criteria->compare( 'old_cardno', $this->old_cardno, true );
		$criteria->compare( 'old_exactname', $this->old_exactname, true );
		$criteria->compare( 'old_expiration', $this->old_expiration, true );
		$criteria->compare( 'wirelessno', $this->wirelessno, true );
		$criteria->compare( 'serviceprovider', $this->serviceprovider, true );
		$criteria->compare( 'mrgID', $this->mrgID );
		$criteria->compare( 'mypublisher', $this->mypublisher, true );
		$criteria->compare( 'removednews', $this->removednews, true );
		$criteria->compare( 'regdate', $this->regdate );
		$criteria->compare( 'mycategories', $this->mycategories, true );
		$criteria->compare( 'isdirty', $this->isdirty );
		$criteria->compare( 'logintime', $this->logintime );
		$criteria->compare( 'relationship_status', $this->relationship_status, true );
		$criteria->compare( 'birthday', $this->birthday, true );
		$criteria->compare( 'facebook_access_token', $this->facebook_access_token, true );
		$criteria->compare( 'gender', $this->gender, true );
		$criteria->compare( 'FacebookID', $this->FacebookID, true );
		$criteria->compare( 'subscription_flag', $this->subscription_flag );

		return new CActiveDataProvider( $this, array(
			'criteria'=>$criteria,
		));
	}
}
