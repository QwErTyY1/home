<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form
{

    public function initialize($entry = null)
    {
        //name
        $name = new Text('name');
        $name->setLabel("Your Full Name");
        $name->setFilters(array('striptags','string'));
        $name->addValidators(array(
            new PresenceOf(array(
                "message" => "Name is required"
            ))
        ));
        $this->add($name);

        //username
        $username = new Text('username');
        $username->setLabel("Username");
        $username->setFilters(array('alpha'));
        $username->addValidators(array(
            new PresenceOf(array(
                "message" => "Please enter your desired user name"
            ))
        ));
        $this->add($username);

        //email
        $email = new Text("email");
        $email->setLabel("E-mail");
        $email->setFilters('email');
        $email->addValidators(array(
            new PresenceOf(array(
                "message" => "The e-mail is required"
            )),

        ));
        $this->add($email);

        //password
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators(array(
           new PresenceOf(array(
               'message' => 'Password is required'))
        ));
        $this->add($password);




        //confirm password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel("Repeat Password");
        $repeatPassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'Confirmation password is required'
            ))
        ));
        $this->add($repeatPassword);
    }

}