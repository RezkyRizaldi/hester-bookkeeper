<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use App\Services\ColorService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ColorController extends Controller
{
    private Color $color;
    private ColorService $colorService;

    public function __construct(Color $color, ColorService $colorService)
    {
        $this->color = $color;
        $this->colorService = $colorService;
    }

    public function index(): View|Factory
    {
        $colors = $this->color->paginate(10);

        return view('color.index', compact('colors'));
    }

    public function create(): View|Factory
    {
        return view('color.create');
    }

    public function store(ColorRequest $request): RedirectResponse
    {
        return $this->colorService->saveColor($request);
    }

    public function edit(Color $color): View|Factory
    {
        return view('color.edit', compact('color'));
    }

    public function update(ColorRequest $request, Color $color): RedirectResponse
    {
        return $this->colorService->saveColor($request, $color);
    }

    public function destroy(Color $color): RedirectResponse
    {
        return $this->colorService->deleteColor($color);
    }
}
