<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SubscriptionServices;

class SubscriptionController extends Controller {
    public function subscribe(Request $request){
        return SubscriptionServices::subscribe($request);
    }

    public function webhook(Request $request){
        return SubscriptionServices::webhook($request);
    }
}