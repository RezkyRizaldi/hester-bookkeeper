<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BrandController extends Controller
{
    public function __construct(private Brand $brand)
    {
        $this->brand = $brand;
    }

    public function __invoke(): View|Factory
    {
        $brands = $this->brand->paginate(10);

        return view('brand', compact('brands'));
    }
}
