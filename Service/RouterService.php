<?php

/**
 * Created by PhpStorm.
 * User: apple
 * Date: 29/05/17
 * Time: 1:04 AM
 */

namespace Service;

class RouterService
{

    private $deliveryExecutive;
    private $orderList;
    private $destinations;
    private $timePassed = 0;
    private $currentLocation;

    const DELIVERY_SPEED = 20000; // m/HR
    /**
     * RouterService constructor.
     */
    public function __construct($deliveryExecutive, $orderList)
    {
        $this->deliveryExecutive = $deliveryExecutive;
        $this->orderList = $orderList;
        $this->preProcessRoute();
    }

    private function preProcessRoute()
    {
        $this->destinations = [];
        foreach ($this->orderList as $order) {
            $this->destinations[] = $order;
        }
        $this->timePassed = 0;
        $this->currentLocation = $this->deliveryExecutive->getLocation();
    }

    public function getMinimumTimeConsumedPathDetails() {
        $minTime = null;
        $path = [];
        foreach ($this->destinations as $destination){
            $destinationsBackup = $this->destinations;
            $timePassedBackup = $this->timePassed;
            $currentLocation = $this->currentLocation;
            $this->visit($destination);
            $timeSpentInDestination = $this->timePassed - $timePassedBackup;
            $minimumPathDetails = $this->getMinimumTimeConsumedPathDetails();
            if (!isset($minTime) ||  $minTime > $timeSpentInDestination + $minimumPathDetails['time']) {
                $minTime = $timeSpentInDestination + $minimumPathDetails['time'];
                $path = array_merge([$destination->getName()], $minimumPathDetails['path']);
            }
            $this->reset($destinationsBackup, $timePassedBackup, $currentLocation);
        }
        return [
            'time' => $minTime ?? 0,
            'path' => $path
        ];
    }

    private function visit($destination) {
        $destinationLocation = $destination->getLocation();
        foreach ($this->destinations as $key => $value) {
            if ($value == $destination) {
                unset($this->destinations[$key]);
            }
        }
        if($destination instanceof \Models\Order) {
            $this->destinations[] = $destination->getCustomer();
            $this->timePassed = max($this->timePassed + $this->currentLocation->getDistance($destinationLocation)/self::DELIVERY_SPEED, $destination->getTimeToProcessMeal());
        } else {
            $this->timePassed = $this->timePassed + $this->currentLocation->getDistance($destinationLocation)/self::DELIVERY_SPEED;
        }
        $this->currentLocation = $destinationLocation;
    }

    private function reset($destinations, $timePassed, $currentLocation) {
      $this->destinations = $destinations;
      $this->timePassed = $timePassed;
      $this->currentLocation = $currentLocation;
    }

}