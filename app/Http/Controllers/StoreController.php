<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StoreController extends Controller
{
    private Store $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function __invoke(): View|Factory
    {
        $stores = $this->store->paginate(10);

        return view('store', compact('stores'));
    }
}
