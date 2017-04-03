<?php

use Phalcon\Acl\Role;
use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;

class SecurityPlugin extends Plugin
{

    public function getAcl()
    {
        if (!isset($this->persistent->acl)){
            $acl = new AclList();
            $acl->setDefaultAction(Acl::DENY);

            $roles = [
                "users" => new Role(
                    "Users",
                    'Member privileges, granted after sign in.'
                ),
                "guest" => new Role(
                    "Guests",
                    "nyone browsing the site who is not signed in is considered to be a Guest."

                )
            ];

            foreach ($roles as $role){
                $acl->addRole($role);
            }

            $privateResources = [
                'companies' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
                'products' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
                'producttypes' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
                'invoices' => array('index', 'profile'),
            ];

            foreach ($privateResources as $resource => $actions){
                $acl->addResource(new Resource($resource), $actions);
            }

            $publicResource = [
                    'index'     => ['index'],
                    'about'     => ['index'],
                    'register'  => ['index'],
                    'errors'    => ['show401', 'show404', 'show500'],
                    'session'   => ['index', 'register','start', 'end'],
                    'contacts'  => ['index', 'send'],
            ];

            foreach ($publicResource as $resource => $actions){
                $acl->addResource(new Resource($resource), $actions);
            }

            foreach ($roles as  $role){
                foreach ($publicResource as $resource => $actions){
                    foreach ($actions as $action){
                        $acl->allow($role->getName(), $resource, $action);
                    }
                }

                $this->persistent->acl = $acl;
            }

            return $this->persistent->acl;
        }
    }


    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {

        $auth = $this->session->get("auth");

        if (!$auth){
            $role = "Guests";
        }else{
            $role = "Users";
        }

        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();

        $acl = $this->getAcl();

        $allowed = $acl->isAllowed($role, $controller, $action);

        if (!$allowed){
            $this->flash->error("You dont have access to this module");

            $dispatcher->forward([
                'controller'=>'index',
                'action'=>'show404',
            ]);
            return false;
        }
    }

}