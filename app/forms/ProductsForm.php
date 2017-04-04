<?php


use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Numericality;


class ProductsForm extends Form
{

    public function initialize($entry = null, $options = [])
    {
        if (!isset($options['edit'])){
            $element = new Text('id');

            $element->setLabel('Id');

            $this->add($element);
        }else{
            $this->add(
                new Hidden("id")
            );
        }

        $name = new Text("name");

        $name->setLabel("Title");

        $name->setFilters(
            [
                "striptags",
                "string"
            ]
        );

        $name->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Name is required",
                    ]
                )
            ]
        );

        $this->add($name);


        $type = new Select(

            "profilesId",
            ProductTypes::find(),
            [
                "using" => [
                             "id",
                            "name",
                ],

            'useEmpty' => true,
            'emptyText' => "...",
            'emptyValue' => "",
            ]
    );
        $this->add($type);

        $price = new Text('price');
        $price->setLabel('Price');
        $price->setFilters(
            [
                "float"
            ]
        );

        $price->addValidators(
            [
                new PresenceOf(
                    [
                        "message" => "Price is required",
                    ]
                ),

                new Numericality(
                    [
                        "message" => "Price is required",
                    ]
                )
            ]
        );
        $this->add($price);

    }
}