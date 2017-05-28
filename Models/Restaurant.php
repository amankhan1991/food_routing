<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 29/05/17
 * Time: 12:57 AM
 */

namespace Models;


class Restaurant
{
    private $location;
    private $name;

    /**
     * Restaurant constructor.
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