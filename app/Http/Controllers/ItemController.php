<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $items = Item::where('user_id', auth()->id())->latest()->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->id();

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item added successfully!');
    }

    public function show(Item $item)
    {
        $this->authorize('view', $item);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $this->authorize('update', $item);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item moved to trash!');
    }

    public function trash()
    {
        $items = Item::where('user_id', auth()->id())->onlyTrashed()->get();
        return view('items.trash', compact('items'));
    }

    public function restore($id)
    {
        $item = Item::where('user_id', auth()->id())->onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $item);
        $item->restore();
        return redirect()->route('items.trash')->with('success', 'Item restored successfully!');
    }

    public function forceDelete($id)
    {
        $item = Item::where('user_id', auth()->id())->onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $item);
        $item->forceDelete();
        return redirect()->route('items.trash')->with('success', 'Item permanently deleted!');
    }
}