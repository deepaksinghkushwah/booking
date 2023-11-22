<?php

namespace App\Helpers;

class GeneralHelper {

    public static function getTimeSlots($startTime, $endTime, $timeStep) {
        $startTime = new \DateTime($startTime);
        $endTime = new \DateTime($endTime);
        $timeArray = array();
        while ($startTime <= $endTime) {
            $timeArray[] = $startTime->format('H:i');
            $startTime->add(new \DateInterval('PT' . $timeStep . 'M'));
        }
        return $timeArray;
    }

}
