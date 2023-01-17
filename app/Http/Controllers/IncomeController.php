<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Models\Income;
use App\Models\Product;
use App\Models\Store;
use App\Services\IncomeService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IncomeController extends Controller
{
    public function __construct(
        private Income $income,
        private IncomeService $incomeService,
        private Product $product,
        private Store $store
    ) {
        $this->income = $income;
        $this->incomeService = $incomeService;
        $this->product = $product;
        $this->store = $store;
    }

    public function index(): View|Factory
    {
        $incomes = $this->income
            ->with(['product', 'store'])
            ->get()
            ->groupBy(fn (Income $query) => Carbon::parse($query->date)->translatedFormat('F'));

        return view('income.index', compact('incomes'));
    }

    public function create(): View|Factory
    {
        return view('income.create', [
            'stores' => $this->store->all(),
            'products' => $this->product->all(),
        ]);
    }

    public function store(IncomeRequest $request): RedirectResponse
    {
        return $this->incomeService->saveIncome($request);
    }

    public function edit(Income $income): View|Factory
    {
        return view('income.edit', [
            'income' => $income,
            'stores' => $this->store->all(),
            'products' => $this->product->all(),
        ]);
    }

    public function update(IncomeRequest $request, Income $income): RedirectResponse
    {
        return $this->incomeService->saveIncome($request, $income);
    }

    public function destroy(Income $income): RedirectResponse
    {
        return $this->incomeService->deleteIncome($income);
    }
}
