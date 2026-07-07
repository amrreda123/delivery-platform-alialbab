<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreRequest;
use App\Services\StoreService;
use App\Models\Category;
use App\Models\Store;

class StoreController
{
    public function __construct(
        private readonly StoreService $storeService
    ) {}

    public function index()
    {
        $stores = $this->storeService->getAllStores();
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.stores.create', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        $this->storeService->createStore($request->validated());

        return redirect()->route('admin.stores.index')
                         ->with('success', 'تم إضافة المتجر بنجاح!');
    }

    public function edit(Store $store)
    {
        $categories = Category::all();
        return view('admin.stores.edit', compact('store', 'categories'));
    }

    public function update(StoreRequest $request, Store $store)
    {
        $this->storeService->updateStore($store, $request->validated());

        return redirect()->route('admin.stores.index')
                         ->with('success', 'تم تحديث بيانات المتجر بنجاح!');
    }

    public function destroy(Store $store)
    {
        $this->storeService->deleteStore($store);

        return redirect()->route('admin.stores.index')
                         ->with('success', 'تم حذف المتجر بنجاح!');
    }
}