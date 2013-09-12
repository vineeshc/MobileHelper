<?php

/**
 * This is the base model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $user_id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $profile_pic
 * @property string $gender
 * @property integer $age
 * @property string $birthday
 * @property string $email
 * @property string $country
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $update_time
 * @property string $access_token
 */
class BaseUsers extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'update_time', 'required' ),
			array( 'age', 'numerical', 'integerOnly'=>true ),
			array( 'user_id', 'length', 'max'=>20),
			array( 'username, firstname, lastname, gender', 'length', 'max'=>50),
			array( 'profile_pic', 'length', 'max'=>100),
			array( 'birthday', 'length', 'max'=>250),
			array( 'email, access_token', 'length', 'max'=>2500),
			array( 'country, city, state', 'length', 'max'=>125),
			array( 'zip', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'user_id, username, firstname, lastname, profile_pic, gender, age, birthday, email, country, city, state, zip, update_time, access_token', 'safe', 'on'=>'search' ),
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
			'user_id' => 'User',
			'username' => 'Username',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'profile_pic' => 'Profile Pic',
			'gender' => 'Gender',
			'age' => 'Age',
			'birthday' => 'Birthday',
			'email' => 'Email',
			'country' => 'Country',
			'city' => 'City',
			'state' => 'State',
			'zip' => 'Zip',
			'update_time' => 'Update Time',
			'access_token' => 'Access Token',
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

		$criteria->compare( 'user_id', $this->user_id, true );
		$criteria->compare( 'username', $this->username, true );
		$criteria->compare( 'firstname', $this->firstname, true );
		$criteria->compare( 'lastname', $this->lastname, true );
		$criteria->compare( 'profile_pic', $this->profile_pic, true );
		$criteria->compare( 'gender', $this->gender, true );
		$criteria->compare( 'age', $this->age );
		$criteria->compare( 'birthday', $this->birthday, true );
		$criteria->compare( 'email', $this->email, true );
		$criteria->compare( 'country', $this->country, true );
		$criteria->compare( 'city', $this->city, true );
		$criteria->compare( 'state', $this->state, true );
		$criteria->compare( 'zip', $this->zip, true );
		$criteria->compare( 'update_time', $this->update_time, true );
		$criteria->compare( 'access_token', $this->access_token, true );

		return new CActiveDataProvider( $this, array(
			'criteria'=>$criteria,
		));
	}
}
