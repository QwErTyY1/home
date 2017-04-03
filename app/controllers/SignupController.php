<?php

class SignupController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function registerAction()
    {
        $user = new Users();


        $success = $user->save(
            $this->request->getPost(),
            [
                "name",
                "email",
            ]
        );
        if ($success){
            echo "Thanks for registering!";
        } else {
            echo "Sorry, the following problems were generated: ";

            $messages = $user->getMessages();

            foreach ($messages as $message){
                echo $message->getMessage();
            }
        }
        $this->view->disable();
    }

}

