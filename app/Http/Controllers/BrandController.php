<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BrandController extends Controller
{
    public function __construct(private Brand $brand, private BrandService $brandService)
    {
        $this->brand = $brand;
        $this->brandService = $brandService;
    }

    public function index(): View|Factory
    {
        $brands = $this->brand->paginate(10);

        return view('brand.index', compact('brands'));
    }

    public function create(): View|Factory
    {
        return view('brand.create');
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        return $this->brandService->saveBrand($request);
    }

    public function edit(Brand $brand): View|Factory
    {
        return view('brand.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand): RedirectResponse
    {
        return $this->brandService->saveBrand($request, $brand);
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        return $this->brandService->deleteBrand($brand);
    }
}
