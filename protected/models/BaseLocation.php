<?php

/**
 * This is the base model class for table "location".
 *
 * The followings are the available columns in table 'location':
 * @property string $user_id
 * @property string $latitude
 * @property string $longitude
 * @property string $update_time
 */
class BaseLocation extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Location the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array( 'user_id', 'length', 'max'=>20),
			array( 'latitude, longitude', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'user_id, latitude, longitude, update_time', 'safe', 'on'=>'search' ),
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
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'update_time' => 'Update Time',
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
		$criteria->compare( 'latitude', $this->latitude, true );
		$criteria->compare( 'longitude', $this->longitude, true );
		$criteria->compare( 'update_time', $this->update_time, true );

		return new CActiveDataProvider( $this, array(
			'criteria'=>$criteria,
		));
	}
}
