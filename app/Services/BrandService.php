<?php

namespace App\Services;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;

class BrandService
{
    public function saveBrand(BrandRequest $request, ?Brand $brand = null): RedirectResponse
    {
        try {
            $data = $request->validated();

            dd($data);

            if ($brand) {
                $brand->update($data);
            } else {
                $brand = Brand::create($data);
            }

            return redirect()->route('brands.index')->with('success', 'Data berhasil '.($brand->wasRecentlyCreated ? 'ditambahkan!' : 'diubah!'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteBrand(Brand $brand): RedirectResponse
    {
        try {
            $brand->delete();

            return redirect()->route('brands.index')->with('success', 'Data derhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('brands.index')->with('error', $e->getMessage());
        }
    }
}
