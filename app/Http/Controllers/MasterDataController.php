<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MasterDataController extends Controller
{
    private const MODELS = [
        'categories' => Category::class,
        'customers' => Customer::class,
        'suppliers' => Supplier::class,
    ];

    public function index(string $type): View
    {
        $model = $this->modelFor($type);

        return view('master.index', ['type' => $type, 'records' => $model::latest()->paginate(12)]);
    }

    public function create(string $type): View
    {
        $model = $this->modelFor($type);

        return view('master.form', ['type' => $type, 'record' => new $model()]);
    }

    public function store(Request $request, string $type): RedirectResponse
    {
        $model = $this->modelFor($type);
        $model::create($this->validatedData($request, $type));

        return to_route("{$type}.index")->with('success', 'Record created successfully.');
    }

    public function edit(string $type, int $id): View
    {
        $model = $this->modelFor($type);

        return view('master.form', ['type' => $type, 'record' => $model::findOrFail($id)]);
    }

    public function update(Request $request, string $type, int $id): RedirectResponse
    {
        $model = $this->modelFor($type);
        $model::findOrFail($id)->update($this->validatedData($request, $type, $id));

        return to_route("{$type}.index")->with('success', 'Record updated successfully.');
    }

    public function destroy(string $type, int $id): RedirectResponse
    {
        $model = $this->modelFor($type);
        $model::findOrFail($id)->delete();

        return back()->with('success', 'Record deleted successfully.');
    }

    /** @return class-string<Model> */
    private function modelFor(string $type): string
    {
        abort_unless(array_key_exists($type, self::MODELS), 404);

        return self::MODELS[$type];
    }

    private function validatedData(Request $request, string $type, ?int $id = null): array
    {
        $rules = ['name' => ['required', 'string', 'max:255']];

        if ($type === 'categories') {
            $rules['description'] = ['nullable', 'string', 'max:255'];
        } else {
            $rules['email'] = ['nullable', 'email', Rule::unique($type, 'email')->ignore($id)];
            $rules['phone'] = ['nullable', 'string', 'max:50'];
            $rules['address'] = ['nullable', 'string', 'max:500'];
        }

        return $request->validate($rules);
    }
}
