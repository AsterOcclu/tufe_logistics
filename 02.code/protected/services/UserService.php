<?php

/**
 * User Service
 * @author AsterOcclu
 */

class UserService extends User
{
	public function register($model)
	{
		$repeat_user = $model->find(array(
		    'select'=>'name, email',
		    'condition'=>"name = '$this->name' OR email = '$this->email'",
		    ));
		if ($repeat_user === null) {
			$password_temp = $model->password;
			$model->create = time();
			$model->password = UserIdentity::encryptByMd5($model->password, $model->create);
			if($model->save(false)) {
				$this->rememberMe = true;
				$this->password = $password_temp;
				return $this->login();
			}
		}
		elseif (strcasecmp($repeat_user->name, $this->name) == 0) {
			$this->addError('name','用户名已存在，请更换');
		}
		else {
			$this->addError('email','邮箱已存在，请更换');
		}
		return false;
	}

	public function login()
	{
		if ($this->_identity === null) {
			$this->_identity = new UserIdentity($this->name, $this->password);
			$this->_identity->authenticate();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
			$duration = $this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
		else
			return false;
	}
}