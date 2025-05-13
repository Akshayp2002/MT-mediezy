<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $products = Products::get();
        return view('dashboard',compact('products'));
    }
}
