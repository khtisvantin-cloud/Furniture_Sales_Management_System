<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Furniture;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FurnitureController extends Controller
{
    public function index(Request $request): View
    {
        $furnitures = Furniture::with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($furnitureQuery) use ($request) {
                    $furnitureQuery->where('name', 'like', "%{$request->search}%")
                        ->orWhere('furniture_code', 'like', "%{$request->search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('furnitures.index', compact('furnitures'));
    }

    public function create(): View|RedirectResponse
    {
        if (! Category::exists()) {
            return to_route('categories.create')->with(
                'warning',
                'Create a category before adding furniture.'
            );
        }

        return view('furnitures.form', ['furniture' => new Furniture(), 'categories' => Category::all()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Furniture::create($this->validatedData($request));

        return to_route('furnitures.index')->with('success', 'Furniture saved successfully.');
    }

    public function show(Furniture $furniture): View
    {
        $furniture->load('category');

        return view('furnitures.show', compact('furniture'));
    }

    public function edit(Furniture $furniture): View
    {
        return view('furnitures.form', compact('furniture') + ['categories' => Category::all()]);
    }

    public function update(Request $request, Furniture $furniture): RedirectResponse
    {
        $furniture->update($this->validatedData($request, $furniture));

        return to_route('furnitures.index')->with('success', 'Furniture updated successfully.');
    }

    public function destroy(Furniture $furniture): RedirectResponse
    {
        if ($furniture->image) {
            Storage::disk('public')->delete($furniture->image);
        }

        $furniture->delete();

        return back()->with('success', 'Furniture deleted successfully.');
    }

    private function validatedData(Request $request, ?Furniture $furniture = null): array
    {
        $data = $request->validate([
            'furniture_code' => ['required', 'string', 'max:50', Rule::unique('furnitures')->ignore($furniture)],
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'material' => ['nullable', 'string', 'max:100'],
            'color' => ['nullable', 'string', 'max:100'],
            'size' => ['nullable', 'string', 'max:100'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ], [
            'category_id.required' => 'Please select a furniture category.',
            'category_id.exists' => 'The selected category is invalid. Please select a category again.',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('furniture', 'public');
        }

        $data['status'] = $data['quantity'] > 0 ? 'available' : 'out_of_stock';

        return $data;
    }
}
