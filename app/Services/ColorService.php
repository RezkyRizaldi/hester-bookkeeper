<?php

namespace App\Services;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;

class ColorService
{
    public function saveColor(ColorRequest $request, ?Color $color = null): RedirectResponse
    {
        try {
            $data = $request->validated();

            if ($color) {
                $color->update($data);
            } else {
                $color = Color::create($data);
            }

            return redirect()->route('colors.index')->with('success', 'Data berhasil ' . ($color->wasRecentlyCreated ? 'ditambahkan!' : 'diubah!'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteColor(Color $color): RedirectResponse
    {
        try {
            $color->delete();

            return redirect()->route('colors.index')->with('success', 'Data derhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('colors.index')->with('error', $e->getMessage());
        }
    }
}
