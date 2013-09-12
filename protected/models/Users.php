<?php

/**
 * This is the model class for table "users".
 *
 */
class Users extends BaseUsers {
	/**
	 * Returns the static model of the specified Base class.
	 * @param string $className Base class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
