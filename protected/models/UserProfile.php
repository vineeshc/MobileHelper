<?php

/**
 * This is the model class for table "user_profile".
 *
 */
class UserProfile extends BaseUserProfile {
	/**
	 * Returns the static model of the specified Base class.
	 * @param string $className Base class name.
	 * @return UserProfile the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
