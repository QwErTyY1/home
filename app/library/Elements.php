<?php

use Phalcon\Mvc\User\Component;

class Elements extends Component
{


    private $_headerMenu = [
        'navbar-left' => [
            'index'=>[
                'caption'=>'Home',
                'action'=>'index'
            ],
            'invoices'=>[
                'caption'=>'Invoices',
                'action'=>'index'
            ],
             'aboutt'=>[
                'caption'=>'About',
                'action'=>'index'
           ],
           'contact'=>[
                'caption'=>'Contact',
                'action'=>'index'
            ],

            'products'=>[
                'caption'=>'Products',
                'action'=>'index'
            ],

        ],
        'navbar-right'=>[
            'session'=>[
                'caption'=>'Log In/Sign Up',
                'action'=>'index'
            ]
        ]

    ];

    private $_tabs = [
        'Invoices'=>[
            'controller'=>'invoices',
            'action'=> 'index',
            'any'=> false
        ],
        'Companies'=>[
            'controller'=>'companies',
            'action'=>'index',
            'any'=>true
        ],
        'Product Types'=>[
            'controller'=>'producttypes',
            'action'=>'index',
            'any'=>true
        ],
        'Your Profile'=>[
            'controller'=>'invoices',
            'action'=>'profile',
            'any'=>false
        ]
    ];

    public function getMenu()
    {

        $auth = $this->session->get('auth');

        if ($auth){
            $this->_headerMenu['navbar-right']['session'] = [

                'caption' => $auth['name'].' Log Out',
                'action'=>'end',


            ];


        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option){
                if ($controllerName == $controller){
                    echo "<li class='active'>";
                }else{
                    echo "<li>";
                }



                echo $this->tag->linkTo($controller .'/'. $option['action'], $option['caption']);
                echo "</li>";

            }
            echo "</ul>";
            echo "</div>";







        }
    }

    public function getTabs()
    {

    }

}