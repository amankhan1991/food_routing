<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 20/05/17
 * Time: 8:08 PM
 */

use Models\DeliveryExecutive;
use Models\Location;
use Models\Customer;
use Models\Order;
use Service\RouterService;

function __autoload($class)
{
    $parts = explode('\\', $class);
    $className = join('/', $parts);
    require $className . '.php';
}

function testRoute() {
    $deliveryPerson = new DeliveryExecutive('Aman', new Location(0,0));
    $customer1 = new Customer('C1', new Location(0, 20));
    $restaurant1 = new \Models\Restaurant('R1', new Location(0, 10));
    $order1 = new Order($customer1, $restaurant1, 0);
    $customer2 = new Customer('C2', new Location(0, 25));
    $restaurant2 = new \Models\Restaurant('R2', new Location(0, -30));
    $order2 = new Order($customer2, $restaurant2, 0);
    $service = new RouterService($deliveryPerson, [$order1, $order2]);
    $routePath = $service->getMinimumTimeConsumedPathDetails();
    assert($routePath['path'] == ['R2', 'R1', 'C1', 'C2'], 'Route path received is '.join(', ', $routePath['path']));
}

testRoute();