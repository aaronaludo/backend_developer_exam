<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $total_products = Product::count();
        $total_admins = User::count();
        $total_categories = Category::count();
        $latest_products = Product::orderBy('id', 'desc')->limit(5)->get();
        
        return view('dashboard.index', compact('total_products', 'total_admins', 'total_categories', 'latest_products'));
    }
}
