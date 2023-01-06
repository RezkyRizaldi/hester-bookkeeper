<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    private $brand;
    private $color;
    private $product;
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->brand = new Brand();
        $this->color = new Color();
        $this->product = new Product();
        $this->productService = $productService;
    }

    public function index(): View|Factory
    {
        $products = $this->product->with(['brand'])->latest()->get();

        return view('product.index', compact('products'));
    }

    public function create(): View|Factory
    {
        return view('product.create', [
            'brands' => $this->brand->all(),
            'colors' => $this->color->all(),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        return $this->productService->saveProduct($request);
    }

    public function edit(Product $product): View|Factory
    {
        return view('product.edit', [
            'brands' => $this->brand->all(),
            'colors' => $this->color->all(),
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        return $this->productService->saveProduct($request, $product);
    }

    public function destroy(Product $product): RedirectResponse
    {
        try {
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Data derhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', $e->getMessage());
        }
    }
}
