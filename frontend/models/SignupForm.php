<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use himiklab\yii2\recaptcha\ReCaptchaValidator;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $start_time;
    public $nickname;
    public $country;
    public $city;
    public $surname;
    public $surname_latin;
    public $name;
    public $name_latin;
    public $secname;
    public $birthdate;
    public $document_type;
    public $document_name;
    public $document_serial;
    public $document_number;
    public $document_issuedby;
    public $document_receivedate;
    public $address;
    public $postal_code;
    public $mobile;
    public $email;
    public $password;
    public $password2;
    public $telephone_pass;
    public $check1;
    public $check2;
    public $check3;
    public $check4;
    public $check5;
    public $verifyCode;
    public $birthdate_min_date = "-70 years";
    public $birthdate_max_date = "-18 years";
    public $document_receivedate_min_date = "-20 years";
    public $document_receivedate_max_date = "now";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['start_time', 'filter', 'filter' => 'trim'],
            ['start_time', 'required'],
            ['start_time', 'integer'],

            ['nickname', 'filter', 'filter' => 'trim'],
            ['nickname', 'required'],
            ['nickname', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['nickname', 'string', 'min' => 3, 'max' => 16],
            ['nickname', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'Your username can only contain alphanumeric characters, underscores and dashes.'],

            ['country', 'required'],

            ['city', 'filter', 'filter' => 'trim'],
            ['city', 'required'],
            ['city', 'string', 'min' => 3, 'max' => 32],

            ['surname', 'filter', 'filter' => 'trim'],
            ['surname', 'required'],
            ['surname', 'string', 'min' => 3, 'max' => 16],
            ['surname', 'match', 'pattern' => '/^[a-zA-Z\x{0400}-\x{04FF}-]+$/u', 'message' => 'Your surname can only contain alpha characters and dashes.'],

            ['surname_latin', 'filter', 'filter' => 'trim'],
            ['surname_latin', 'required'],
            ['surname_latin', 'string', 'min' => 3, 'max' => 16],
            ['surname_latin', 'match', 'pattern' => '/^[a-zA-Z-]+$/', 'message' => 'Your surname can only contain alpha characters and dashes.'],

            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 3, 'max' => 16],
            ['name', 'match', 'pattern' => '/^[a-zA-Z\x{0400}-\x{04FF}-]+$/u', 'message' => 'Your name can only contain alpha characters and dashes.'],

            ['name_latin', 'filter', 'filter' => 'trim'],
            ['name_latin', 'required'],
            ['name_latin', 'string', 'min' => 3, 'max' => 16],
            ['name_latin', 'match', 'pattern' => '/^[a-zA-Z-]+$/', 'message' => 'Your name can only contain alpha characters and dashes.'],

            ['secname', 'filter', 'filter' => 'trim'],
            //['secname', 'required'],
            ['secname', 'string', 'min' => 3, 'max' => 16],
            ['secname', 'match', 'pattern' => '/^[a-zA-Z\x{0400}-\x{04FF}-]+$/u', 'message' => 'Your secname can only contain alpha characters and dashes.'],

            ['birthdate', 'filter', 'filter' => 'trim'],
            ['birthdate', 'required'],
            ['birthdate', 'yii\validators\DateValidator', 'format' => 'yyyy-mm-dd', 'min' => date("Y-m-d", strtotime($this->birthdate_min_date)), 'max' => date("Y-m-d", strtotime($this->birthdate_max_date))],

            ['document_type', 'filter', 'filter' => 'trim'],
            ['document_type', 'required'],

            ['document_name', 'filter', 'filter' => 'trim'],
            ['document_name', 'required'],
            ['document_name', 'string', 'max' => 16],

            ['document_serial', 'filter', 'filter' => 'trim'],
            ['document_serial', 'required'],
            ['document_serial', 'string', 'max' => 16],

            ['document_number', 'filter', 'filter' => 'trim'],
            ['document_number', 'required'],
            ['document_number', 'string', 'max' => 16],

            ['document_issuedby', 'filter', 'filter' => 'trim'],
            ['document_issuedby', 'required'],
            ['document_issuedby', 'string', 'max' => 32],

            ['document_receivedate', 'filter', 'filter' => 'trim'],
            ['document_receivedate', 'required'],
            ['document_receivedate', 'yii\validators\DateValidator', 'format' => 'yyyy-mm-dd', 'min' => date("Y-m-d", strtotime($this->document_receivedate_min_date)), 'max' => date("Y-m-d", strtotime($this->document_receivedate_max_date))],

            ['address', 'filter', 'filter' => 'trim'],
            ['address', 'required'],
            ['address', 'string', 'max' => 32],

            ['postal_code', 'filter', 'filter' => 'trim'],
            ['postal_code', 'required'],
            ['postal_code', 'string', 'max' => 16],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 64],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['mobile', 'filter', 'filter' => 'trim'],
            ['mobile', 'required'],
            ['mobile', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['mobile', 'match', 'pattern' => '/^\+\d{11,14}$/', 'message' => 'Your mobile can only contain numeric characters with plus character ahead.'],

            ['password', 'filter', 'filter' => 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 8, 'max' => 32],
            //['password', 'match', 'pattern' => '/^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8,32}$/', 'message' => 'Your password need to contain two characters in upper case, three characters in lower case and one specific character (!@#$&*).'],
            ['password2', 'filter', 'filter' => 'trim'],
            ['password2', 'required'],
            ['password2', 'string', 'min' => 8, 'max' => 32],
            ['password2', 'compare', 'compareAttribute' => 'password'],

            ['telephone_pass', 'filter', 'filter' => 'trim'],
            ['telephone_pass', 'required'],
            ['telephone_pass', 'string', 'min' => 6, 'max' => 16],
            ['telephone_pass', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'Your telephone password can only contain alphanumeric characters, underscores and dashes.'],

            ['check1', 'required', 'requiredValue' => 1],
            ['check2', 'required', 'requiredValue' => 1],
            ['check3', 'required', 'requiredValue' => 1],
            ['check4', 'required', 'requiredValue' => 1],
            ['check5', 'required', 'requiredValue' => 1],

            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
            ['verifyCode', ReCaptchaValidator::className(), 'secret' => '6Ld15woTAAAAACU7nYuJOc8MEgG2zmHyQs3hGVnK'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode'=> 'Verification Code',
            'password2' => 'Repeat Password',

            'check1'    => '«Регламент обработки и исполнения клиентских распоряжений»',
            'check2'    => '«Регламент торговых операций»',
            'check3'    => '«Клиентский договор»',
            'check4'    => '«Уведомление о рисках»',
            'check5'    => '«Регламент предоставления услуги ПАММ-счет»',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            return null;
            $user = new User();
            $user->nickname = $this->nickname;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
