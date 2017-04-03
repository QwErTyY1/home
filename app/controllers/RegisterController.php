<?php


class RegisterController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Sign Up');
        parent::initialize();

    }

    public function indexAction()
    {
        $form = new RegisterForm();

        $this->view->form = $form;

        if ($this->request->isPost()) {

            $name = $this->request->getPost('name', array('string', 'striptags'));
            $username = $this->request->getPost('username','alphanum');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');

            if ($password !== $repeatPassword){
                $this->flash->error('Passwords are different');
                return false;
            }

            $user = new Users();

            $user->name = $name;
            $user->user_name = $username;
            $user->user_email = $email;
            $user->user_password = sha1($password);

            $date = new DateTime();

            $user->created_at = $date->format('Y-m-d H:i:s');

            $user->users_active = 'Y';




            if ($user->save() === false){
                foreach ($user->getMessages() as $message){
                    $this->flash->error((string) $message);
                }
            }else{
                $this->tag->setDefault('email','');
                $this->tag->setDefault('password','');
                $this->flash->success('Thanks for sign-up, please log-in to start generating invoices');

                return $this->dispatcher->forward(
                    [
                        "controller" => "session",
                        "action" => "index",
                    ]
                );
            }






        }

    }

}