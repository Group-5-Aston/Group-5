<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ReturnItem;

class AdminDashboardController extends Controller
{
    public function home() {
    
        return view(newpages.newadminpages.admindashboard);
    }
}
