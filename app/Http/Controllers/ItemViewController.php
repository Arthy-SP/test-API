<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ItemViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    private $apiBaseUrl = 'http://localhost:8000/api';

    public function index()
    {
        $token = session('api_token');
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/items");
        $items = $response->json();

        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $token = session('api_token');
        $response = Http::withToken($token)->post("{$this->apiBaseUrl}/items", $request->all());

        if ($response->successful()) {
            return redirect()->route('items.index')->with('success', 'Item created successfully.');
        } else {
            return back()->withErrors($response->json())->withInput();
        }
    }

    public function edit($id)
    {
        $token = session('api_token');
        $response = Http::withToken($token)->get("{$this->apiBaseUrl}/items/{$id}");

        if ($response->successful()) {
            $item = $response->json();
            return view('items.edit', compact('item'));
        } else {
            return redirect()->route('items.index')->with('error', 'Failed to fetch item.');
        }
    }

    public function update(Request $request, $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->put("{$this->apiBaseUrl}/items/{$id}", $request->all());

        if ($response->successful()) {
            return redirect()->route('items.index')->with('success', 'Item updated successfully.');
        } else {
            return back()->withErrors($response->json())->withInput();
        }
    }


    public function destroy($id)
    {

        $token = session('api_token');
        $response = Http::withToken($token)->delete("{$this->apiBaseUrl}/items/{$id}");

        if ($response->successful()) {
            return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
        } else {
            return redirect()->route('items.index')->with('error', 'Failed to delete item.');
        }
    }
}
