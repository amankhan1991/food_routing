<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 29/05/17
 * Time: 1:01 AM
 */

namespace Models;


class Location
{
    private $latitude;
    private $longitude;

    /**
     * Location constructor.
     * @param $latitude
     * @param $longitude
     */
    public function __construct($latitude , $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param $location
     * @return number in meters
     */
    public function getDistance($location)
    {
        return abs($this->haversineGreatCircleDistance($this->latitude, $this->longitude, $location->getLatitude(), $location->getLongitude()));
    }

    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}