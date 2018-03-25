<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Admission Check form to check if guardian is already present or not.
 */
class AdmissionCheckForm extends Model
{
    public $mobile;
	
    private $_guardian;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile'], 'required'],
        ];
    }

    /**
     * Validates the mobile number and return guardian model if found.
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function check()
    {
        if (!$this->hasErrors()) {
            $guardian = $this->getGuardian();
            if (!$guardian){
				return false;
            }
			return $guardian;
        }
    }

    /**
     * Finds guardian by [[mobile]]
     *
     * @return Guardian|null
     */
    protected function getGuardian()
    {
        if ($this->_guardian === null) {
            $this->_guardian = Guardian::findOne(['phone' => $this->mobile]);
        }

        return $this->_guardian;
    }
}
