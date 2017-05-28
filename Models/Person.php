<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 29/05/17
 * Time: 1:03 AM
 */

namespace Models;


class Person
{
    private $location;
    private $name;

    /**
     * Person constructor.
     * @param $name
     * @param $location
     */
    public function __construct($name, $location)
    {
        $this->name = $name;
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getName()
    {
        return $this->name;
    }
}