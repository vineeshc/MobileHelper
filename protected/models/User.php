<?php

/**
 * This is the model class for table "users".
 *
 */
class User extends BaseUser {
	/**
	 * Returns the static model of the specified Base class.
	 * @param string $className Base class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
