<?php

use App\User;
use Carbon\Carbon;


function trackAudit($params){
    try{
        $user = auth()->user() ;


    

        return true;
    }catch (\Exception $ex) {
        return false;
    }
}

