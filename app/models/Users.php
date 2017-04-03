<?php


use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=20, nullable=false)
     */
    public $user_id;



    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    public $user_name;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=false)
     */
    public $user_password;

    /**
     *
     * @var string
     * @Column(type="string", length=120, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    public $user_email;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $users_active;


//    public function validation()
//    {
//        $validator = new Validation();
//
//        $validator->add(
//            'email',
//            new UniquenessValidator([
//                'message' => 'Sorry, The email was registered by another user'
//            ]));
//        $validator->add(
//            'username',
//            new UniquenessValidator([
//                'message' => 'Sorry, That username is already taken'
//            ]));
//
//        return $this->validate($validator);
//    }



    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field user_name
     *
     * @param string $user_name
     * @return $this
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * Method to set the value of field user_password
     *
     * @param string $user_password
     * @return $this
     */
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field user_email
     *
     * @param string $user_email
     * @return $this
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param integer $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field users_active
     *
     * @param string $users_active
     * @return $this
     */
    public function setUsersActive($users_active)
    {
        $this->users_active = $users_active;

        return $this;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field user_name
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * Returns the value of field user_password
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->user_password;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field user_email
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * Returns the value of field created_at
     *
     * @return integer
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field users_active
     *
     * @return string
     */
    public function getUsersActive()
    {
        return $this->users_active;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("vova");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vv_users';
    }


    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }


    public static function findFirst($parameters = null)
    {

        return parent::findFirst($parameters);
    }

}
