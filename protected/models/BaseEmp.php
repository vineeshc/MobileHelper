<?php

/**
 * This is the base model class for table "emp".
 *
 * The followings are the available columns in table 'emp':
 * @property integer $emp_id
 * @property string $emp_name
 * @property string $emp_email
 * @property string $emp_age
 */
class BaseEmp extends CActiveRecord {
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Emp the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'emp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array( 'emp_name, emp_email, emp_age', 'required' ),
			array( 'emp_name, emp_email, emp_age', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array( 'emp_id, emp_name, emp_email, emp_age', 'safe', 'on'=>'search' ),
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
			'emp_id' => 'Emp',
			'emp_name' => 'Emp Name',
			'emp_email' => 'Emp Email',
			'emp_age' => 'Emp Age',
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

		$criteria->compare( 'emp_id', $this->emp_id );
		$criteria->compare( 'emp_name', $this->emp_name, true );
		$criteria->compare( 'emp_email', $this->emp_email, true );
		$criteria->compare( 'emp_age', $this->emp_age, true );

		return new CActiveDataProvider( $this, array(
			'criteria'=>$criteria,
		));
	}
}
