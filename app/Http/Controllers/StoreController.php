<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class StoreController extends Controller
{
    public function __construct(private Store $store)
    {
        $this->store = $store;
    }

    public function __invoke(): View|Factory
    {
        $stores = $this->store->paginate(10);

        return view('store', compact('stores'));
    }
}
