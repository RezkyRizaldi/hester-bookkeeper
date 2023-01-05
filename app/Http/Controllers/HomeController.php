<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request): View|Factory
    {
        $brands = Brand::withCount(['products'])->get();
        $colors = Color::all();

        return view('index', compact('brands', 'colors'));
    }
}
