<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Guardian;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $address;
    public $username;
    public $email;
    public $phone;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Guardian', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
			
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
			
            ['address', 'trim'],
            ['address', 'required'],
            ['address', 'string'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Guardian', 'message' => 'This email address has already been taken.'],
			
            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'max' => 15],
            ['phone', 'unique', 'targetClass' => '\common\models\Guardian', 'message' => 'This phone number has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs Guardian up.
     *
     * @return Guardian|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $guardian = new Guardian();
        $guardian->username = $this->username;
        $guardian->name = $this->name;
        $guardian->address = $this->address;
        $guardian->email = $this->email;
        $guardian->phone = $this->phone;
        $guardian->setPassword($this->password);
        $guardian->generateAuthKey();
        
        return $guardian->save() ? $guardian : null;
    }
}
