<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenditureRequest;
use App\Models\Expenditure;
use App\Models\Product;
use App\Services\ExpenditureService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ExpenditureController extends Controller
{
    private array $types;

    public function __construct(private Expenditure $expenditure, private ExpenditureService $expenditureService, private Product $product)
    {
        $this->expenditure = $expenditure;
        $this->expenditureService = $expenditureService;
        $this->product = $product;
        $this->types = ['Kaos Jadi'];
    }

    public function index(): View|Factory
    {
        $expenditures = $this->expenditure
            ->with(['product'])
            ->get()
            ->groupBy(fn (Expenditure $query) => Carbon::parse($query->date)->translatedFormat('F'));

        return view('expenditure.index', compact('expenditures'));
    }

    public function create(): View|Factory
    {
        return view('expenditure.create', [
            'products' => $this->product->all(),
            'types' => $this->types,
        ]);
    }

    public function store(ExpenditureRequest $request): RedirectResponse
    {
        return $this->expenditureService->saveExpenditure($request);
    }

    public function edit(Expenditure $expenditure): View|Factory
    {
        return view('expenditure.edit', [
            'expenditure' => $expenditure,
            'products' => $this->product->all(),
            'types' => $this->types,
        ]);
    }

    public function update(ExpenditureRequest $request, Expenditure $expenditure): RedirectResponse
    {
        return $this->expenditureService->saveExpenditure($request, $expenditure);
    }

    public function destroy(Expenditure $expenditure): RedirectResponse
    {
        return $this->expenditureService->deleteExpenditure($expenditure);
    }
}
