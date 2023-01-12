<?php

namespace App\Services;

use App\Http\Requests\ExpenditureRequest;
use App\Models\Expenditure;
use Illuminate\Http\RedirectResponse;

class ExpenditureService
{
    public function saveExpenditure(ExpenditureRequest $request, ?Expenditure $expenditure = null): RedirectResponse
    {
        try {
            $data = $request->validated();

            if ($expenditure) {
                $expenditure->update($data);
            } else {
                $expenditure = Expenditure::create($data);
            }


            return redirect()->route('expenditures.index')->with('success', 'Data berhasil ' . ($expenditure->wasRecentlyCreated ? 'ditambahkan!' : 'diubah!'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteExpenditure(Expenditure $expenditure): RedirectResponse
    {
        try {
            $expenditure->delete();

            return redirect()->route('incomes.index')->with('success', 'Data derhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('incomes.index')->with('error', $e->getMessage());
        }
    }
}
