<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 * @author AsterOcclu
	 */
	public function authenticate()
	{
		$model = new User('login');
		$user = $model->findByAttributes(array('name' => $this->name));
		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		elseif (self::encryptByMd5($this->password, $user->create) !== $user->password) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else {
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * Encrypt code by MD5.
	 * @author AsterOcclu
	 */
	public static function encryptByMd5($password, $salt = 'tufe09jk')
	{
		return md5(md5($password).$salt);
	}
}