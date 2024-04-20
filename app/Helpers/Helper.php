<?php

function getStateName($stateId) {
    // Query the 'states' table to retrieve the name based on the state ID
    $state = \App\Models\States::find($stateId);
    return $state ? $state->state : 'Unknown';
}

function getCityName($cityId) {
    // Query the 'cities' table to retrieve the name based on the city ID
    $city = \App\Models\Cities::find($cityId);
    return $city ? $city->city : 'Unknown';
}

function getPincode($pincodeId) {
    // Query the 'pincodes' table to retrieve the code based on the pincode ID
    $pincode = \App\Models\Pincode::find($pincodeId);
    return $pincode ? $pincode->pincode : 'Unknown';
}
