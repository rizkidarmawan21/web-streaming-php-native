<?php

require_once __DIR__ . './../models/User.php';
require_once __DIR__ . './../models/UserSubcription.php';

/**
 * Check is user subcription or not
 * 
 */
function checkSubcription($id)
{
    $data = User::getUserSubcription($id);
    $count = $data->rowCount();
    if ($count > 0) {
        $user_subcription = $data->fetch();
        return [
            'status' => true,
            'expired' => $user_subcription['expirate_date']
        ];
    } else {
        return [
            'status' => false,
            'expired' => null
        ];
    }
}

function getUserSubcriptionPlan($id)
{
    $data = User::getUserSubcription($id);
    $count = $data->rowCount();
    if ($count > 0) {
        return $data->fetch();
    }
}

function getSubcriptionPlan($id){
    $data = UserSubcription::getSubcriptionPlan($id);
    $count = $data->rowCount();
    if ($count > 0) {
        return $data->fetch();
    }
}
