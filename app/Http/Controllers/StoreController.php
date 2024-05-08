<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return response()->json($stores);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'active' => 'required|boolean',
        ]);

        $store = Store::create($request->all());

        return response()->json($store, 201);
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);
        return response()->json($store);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'active' => 'required|boolean',
        ]);

        $store = Store::findOrFail($id);
        $store->update($request->all());

        return response()->json($store, 200);
    }

    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return response()->json(["message" => "Delete success"], 202);
    }
}