<?php

namespace Models;

/**
 * Created by PhpStorm.
 * User: apple
 * Date: 29/05/17
 * Time: 12:55 AM
 */
class Order
{

    private $customer;
    private $restaurant;
    private $timeToProcessMeal;

    /**
     * Order constructor.
     * @param $customer
     * @param $restaurant
     * @param $timeToProcessMeal
     */
    public function __construct($customer , $restaurant, $timeToProcessMeal)
    {
        $this->customer = $customer;
        $this->restaurant = $restaurant;
        $this->timeToProcessMeal = $timeToProcessMeal;
    }

    public function getTimeToProcessMeal()
    {
        return $this->timeToProcessMeal;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getRestaurant()
    {
        return $this->restaurant;
    }

    public function getLocation()
    {
        return $this->restaurant->getLocation();
    }

    public function getName()
    {
        return $this->getRestaurant()->getName();
    }
}