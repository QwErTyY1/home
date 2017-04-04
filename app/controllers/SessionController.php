<?php


class SessionController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    public function indexAction()
    {


    }

    private function _registerSession(Users $user)
    {

        $this->session->set("auth", array(
            'id' => $user->user_id,
            'name' => $user->user_name,

        ));

    }

    public function startAction()
    {

        if ($this->request->isPost()){
            $email = $this->request->getPost("email");
            $password = $this->request->getPost("password");




            $shaPassword =  sha1($password);
            $user = Users::findFirst(
                [
                 "(user_email = :email: OR user_name =:email:) AND user_password = :password: AND users_active ='Y'",
                    "bind" =>[
                        "email" =>$email,
                        "password" => $shaPassword,
                    ]
                ]
            );

            if ($user != false){
                $this->_registerSession($user);

                $this->flash->success("Welcome ". $user->user_name);

                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action" => "index",
                    ]
                );
            }
            $this->flash->error("Wrong email/password");
        }
            return $this->dispatcher->forward(
                [
                    "controller" => "session",
                    "action" => "index",
                ]
            );

    }

    public function endAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Good Luck!!');

        return $this->dispatcher->forward(
            [
                'controller'    =>'index',
                'action'        =>'index',
            ]
        );

    }

}