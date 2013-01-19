<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error) {
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new UserService('login');
		if(isset($_POST['UserService'])) {
			$model->attributes = $_POST['UserService'];
			if($model->validate() && $model->login()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$this->render('login', array('model'=>$model));
	}


	/**
	 * Displays the register page
	 */
	public function actionRegister()
	{
		$model = new UserService('register');
		if(isset($_POST['UserService'])) {
			$model->attributes = $_POST['UserService'];
			if($model->validate() && $model->register($model)) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$this->render('register', array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}