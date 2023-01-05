<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ColorController extends Controller
{
    public function index(): View|Factory
    {
        $colors = Color::all();

        return view('color.index', compact('colors'));
    }

    public function create(): View|Factory
    {
        return view('color.create');
    }

    public function store(ColorRequest $request): RedirectResponse
    {
        Color::create($request->validated());

        return redirect()->route('colors.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Color $color): View|Factory
    {
        return view('color.edit', compact('color'));
    }

    public function update(ColorRequest $request, Color $color): RedirectResponse
    {
        $color->update($request->validated());

        return redirect()->route('colors.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Color $color): RedirectResponse
    {
        $color->delete();

        return redirect()->route('colors.index')->with('success', 'Data berhasil dihapus!');
    }
}
