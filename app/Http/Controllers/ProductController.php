<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Goods;
use App\Models\Product;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    private Brand $brand;
    private Color $color;
    private Goods $goods;
    private Product $product;
    private ProductService $productService;
    private array $sizes;

    public function __construct(Brand $brand, Color $color, Goods $goods, Product $product, ProductService $productService)
    {
        $this->brand = $brand;
        $this->color = $color;
        $this->goods = $goods;
        $this->product = $product;
        $this->productService = $productService;
        $this->sizes = ['S', 'M', 'L', 'XL'];
    }

    public function index(): View|Factory
    {
        $products = $this->product->with(['brand', 'color'])->latest()->paginate(10);

        return view('product.index', compact('products'));
    }

    public function create(): View|Factory
    {
        return view('product.create', [
            'brands' => $this->brand->all(),
            'colors' => $this->color->all(),
            'sizes'  => $this->sizes,
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        return $this->productService->saveProduct($request);
    }

    public function show(Product $product): View|Factory
    {
        $goods = $this->goods
            ->withTrashed()
            ->where('product_id', $product->id)
            ->get()
            ->groupBy(fn (Goods $query) => Carbon::parse($query->created_at)->translatedFormat('F'));

        return view('product.show', compact('goods'));
    }

    public function edit(Product $product): View|Factory
    {
        $product->load(['goods']);

        return view('product.edit', [
            'brands'  => $this->brand->all(),
            'colors'  => $this->color->all(),
            'product' => $product,
            'sizes'   => $this->sizes,
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        return $this->productService->saveProduct($request, $product);
    }

    public function destroy(Product $product): RedirectResponse
    {
        return $this->productService->deleteProduct($product);
    }
}
