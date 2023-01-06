<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function saveProduct(ProductRequest $request, ?Product $product = null): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $exists_product = Product::withTrashed()->where('brand_id', $data['brand_id'])->latest()->first();
            $brand = Brand::find($data['brand_id']);
            if ($product) {
                $product->update($data);
            } else {
                $number_code = '01';
                if ($exists_product) {
                    $result_code = (int) explode('-', $exists_product['code'])[1] + 1;
                    $number_code = $result_code <= 10 ? "0{$result_code}" : $result_code;
                }
                $data['code'] = "{$brand->code}-{$number_code}";
                $product = Product::create($data);
            }
            if ($product['id'] && $brand) {
                DB::commit();
                return redirect()->route('products.index')->with('success', 'Data berhasil ' . ($product->wasRecentlyCreated ? 'ditambahkan!' : 'diubah!'));
            } else {
                DB::rollback();

                return back()->with('error', 'Data gagal ' . ($product->wasRecentlyCreated ? 'ditambahkan!' : 'diubah!'));
            }
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }
}
