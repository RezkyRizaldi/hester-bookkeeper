<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): View|Factory
    {
        $products = Product::with(['brand'])->latest()->paginate(10);

        return view('product.index', compact('products'));
    }

    public function create(): View|Factory
    {
        $brands = Brand::all();
        $colors = Color::all();

        return view('product.create', compact('brands', 'colors'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $exists_product = Product::withTrashed()->where('brand_id', $data['brand_id'])->latest()->first();
            $products = Product::create($data);
            $brand = Brand::find($data['brand_id']);

            if (!empty($products['id']) && !empty($brand)) {
                $number_code = '01';

                if (!empty($exists_product)) {
                    $code_exists = explode('-', $exists_product['code']);
                    $result_code = $code_exists[1] + 1;
                    $number_code = $result_code <= 10 ? '0' . $result_code : $result_code;
                }

                $code = $brand->code . '-' . $number_code;
                Product::where('id', $products['id'])->update(['code' => $code]);
                DB::commit();

                return redirect()->route('products.index')->with('success', 'Data berhasil ditambahkan!');
            } else {
                DB::rollback();

                return redirect()->route('products.create')->with('error', 'Data gagal ditambahkan!');
            }
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('products.create')->with('error', $e->getMessage());
        }
    }

    public function edit(Product $product): View|Factory
    {
        $brands = Brand::all();
        $colors = Color::all();

        return view('product.edit', compact('product', 'brands', 'colors'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $exist_product = Product::withTrashed()->where('brand_id', $data['brand_id'])->latest()->first();
            $products = $product->update($data);
            $brand = Brand::find($data['brand_id']);

            if (!empty($products['id']) && !empty($brand)) {
                $number_code = '01';

                if (!empty($exist_product)) {
                    $code_exist = explode('-', $exist_product['code']);
                    $result_code = $code_exist[1] + 1;
                    $number_code =  $result_code <= 10 ? '0' . $result_code : $result_code;
                }

                $code = $brand->code . '-' . $number_code;
                Product::where('id', $products['id'])->update(['code' => $code]);
                DB::commit();

                return redirect()->route('products.index')->with('success', 'Data berhasil diubah!');
            } else {
                DB::rollback();

                return redirect()->route('products.edit')->with('error', 'Data gagal diubah!');
            }
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('products.edit')->with('error', $e->getMessage());
        }
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
