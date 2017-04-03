<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    public function initialize()
    {

        $this->tag->prependTitle('INVO | ');
        $this->view->setTemplateAfter('main');
    }

}
