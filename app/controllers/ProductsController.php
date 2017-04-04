<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Pagination;
use Phalcon\Forms\Form;

class ProductsController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle(
            "Control your products!"
        );
        parent::initialize();
    }



    public function indexAction()
    {

        $form = new ProductsForm();

        $this->persistent->searchParams = null;



        $this->view->form = $form;


    }

    public function searchAction()
    {

        $currentPage = (int) $_GET['page'];

        if ($this->request->isPost()){
            $query = Criteria::fromInput(
                $this->di, "Products", $this->request->getPost()
            );
            $this->persistent->searchParams = $query->getParams();
        }else{
            $currentPage = $this->request->getQuery('page','int');
        }
            $parameters = [];

            if ($this->persistent->searchParams){
                $parameters = $this->persistent->searchParams = $query->getParams();
            }

            $products = Products::find($parameters);

            if (count($products) === 0){
                $this->flash->notice("The search did not find any products");


                return $this->dispatcher->forward(
                    [
                        "controller" => "products",
                        "action"     => "index",
                    ]
                );

            }



            $pagenation = new Pagination(
                [
                    "data"  => $products,
                    "limit" => 3,
                    "page"  => $currentPage
                ]
            );

        $page = $pagenation->getPaginate();

        $this->view->page = $page;


    }


    public function editAction($id)
    {
        if (!$this->request->isPost()){
            $product = Products::findFirstById($id);

            if (!$product){
                $this->flash->error("product not found");

                return $this->dispatcher->forward(
                    [
                        "controller" => "products",
                        "action"    =>"index",
                    ]
                );
            }

            $this->view->form = new ProductsForm(
                $product,
                [
                    "edit" => true,
                ]
            );
        }
    }


    public function newAction()
    {
        $this->view->form = new ProductsForm(null,"edit");
    }




        public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "index",
                ]
            );
        }
        $form = new ProductsForm;
        $product = new Products();
        $data = $this->request->getPost();
        if (!$form->isValid($data, $product)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "new",
                ]
            );
        }
        if ($product->save() == false) {
            foreach ($product->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "new",
                ]
            );
        }
        $form->clear();
        $this->flash->success("Product was created successfully");
        return $this->dispatcher->forward(
            [
                "controller" => "products",
                "action"     => "index",
            ]
        );
    }


    public function saveAction()
    {
        if (!$this->request->isPost()){
            return $this->dispatcher->forward([
                "controller" => "products",
                "action"     => "index"
            ]);
        }

        $id = $this->request->getPost("id", "int");
        $product = Products::findFirstById($id);

        if (!$product){
            $this->flash->error("Product does not exist");

            return $this->dispatcher->forward([
                "controller"  => "products",
                "action"        => "index",
            ]);
        }

        $form = new ProductsForm();

        $data = $this->request->getPost();

        if (!$form->isValid($data, $product)){
            $messages = $form->getMessages();

            foreach ($messages as $message){
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller"    => "products",
                    "action"        => "new",
                ]
            );
        }

        if ($product->save() === false){
            $messages = $product->getMessages();

            foreach ($messages as $message){
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(
                [
                    "controller" => "products",
                    "action"     => "new",
                ]
            );
        }

        $form->clear();

        $this->flash->success("Products success update!");

        return $this->dispatcher->forward(
            [
                "controller" => "products",
                "action"    => "index",
            ]
        );
    }

    public function deleteAction($id)
    {

        $product = Products::findFirstById($id);

        if ($product !== false){
            if ($product->delete() === false) {
                $this->flash->error("Dont del ...");

                $messages = $product->getMessages();

                foreach ($messages as $message){
                    $this->flash->error($message);
                }
                return $this->dispatcher->forward(
                    [
                        "controller" => "products",
                        "action"    => "search"
                    ]
                );

            }else{
                $this->flash->success("Success operation!!!");
                return $this->dispatcher->forward(
                    [
                        "controller" => "products",
                        "action"    => "index"
                    ]
                );
            }
        }


    }
}