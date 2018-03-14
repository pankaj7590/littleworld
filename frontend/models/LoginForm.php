<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Guardian;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_guardian;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $guardian = $this->getGuardian();
            if (!$guardian || !$guardian->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a guardian using the provided email/mobile and password.
     *
     * @return bool whether the guardian is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getGuardian(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds guardian by [[username]]
     *
     * @return guardian|null
     */
    protected function getGuardian()
    {
        if ($this->_guardian === null) {
            $this->_guardian = Guardian::findByUsername($this->username);
        }

        return $this->_guardian;
    }
}
