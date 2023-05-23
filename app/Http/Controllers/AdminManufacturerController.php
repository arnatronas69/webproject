<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class AdminManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.manufacturers.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('admin.manufacturers.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            // Add validation rules for other fields
        ]);

        Manufacturer::create($validatedData);

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer created successfully');
    }

    public function show($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('admin.manufacturers.show', compact('manufacturer'));
    }

    public function edit($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            // Add validation rules for other fields
        ]);

        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->update($validatedData);

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer updated successfully');
    }

    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->delete();

        return redirect()->route('admin.manufacturers.index')->with('success', 'Manufacturer deleted successfully');
    }
}
