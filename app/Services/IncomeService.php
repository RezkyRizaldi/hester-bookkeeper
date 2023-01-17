<?php

namespace App\Services;

use App\Http\Requests\IncomeRequest;
use App\Models\Income;
use Illuminate\Http\RedirectResponse;

class IncomeService
{
    public function saveIncome(IncomeRequest $request, ?Income $income = null): RedirectResponse
    {
        try {
            $data = $request->validated();

            if ($income) {
                $income->update($data);
            } else {
                $income = Income::create($data);
            }

            return redirect()->route('incomes.index')->with('success', 'Data berhasil '.($income->wasRecentlyCreated ? 'ditambahkan!' : 'diubah!'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteIncome(Income $income): RedirectResponse
    {
        try {
            $income->delete();

            return redirect()->route('incomes.index')->with('success', 'Data derhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('incomes.index')->with('error', $e->getMessage());
        }
    }
}
