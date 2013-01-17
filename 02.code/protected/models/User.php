<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $name
 * @property string $password
 * @property integer $create
 * @property string $email
 */
class User extends CActiveRecord
{
	public $rememberMe;  // for cookie
	public $password2;  // repeat your password

	protected $_identity;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, password', 'required'),
			array('name', 'length', 'min'=>3, 'max'=>32),
			array('email, password2', 'required', 'on'=>'register'),
			array('password2', 'compare', 'compareAttribute'=>'password', 'on'=>'register'),
			array('password', 'length', 'min'=>6, 'max'=>32, 'on'=>'register'),
			array('password', 'authenticate', 'on'=>'login'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			// array('id, name, password, create, email', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'password' => 'Password',
			'password2' => 'Repeat your password',
			'email' => 'Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	// public function search()
	// {
	// 	// Warning: Please modify the following code to remove attributes that
	// 	// should not be searched.

	// 	$criteria=new CDbCriteria;

	// 	$criteria->compare('id',$this->id,true);
	// 	$criteria->compare('name',$this->name,true);
	// 	$criteria->compare('password',$this->password,true);
	// 	$criteria->compare('create',$this->create);
	// 	$criteria->compare('email',$this->email,true);

	// 	return new CActiveDataProvider($this, array(
	// 		'criteria'=>$criteria,
	// 	));
	// }

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$this->_identity = new UserIdentity($this->name, $this->password);
			if (!$this->_identity->authenticate()) {
				$this->addError('password', 'Incorrect username or password.');
			}
		}
	}



}