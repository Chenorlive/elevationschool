<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installment;
use Illuminate\Routing\Controller;

class InstallmentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    
    public function index()
    {
        $installments = Installment::all();
        return view('installments.index', [
            'title' => 'Installments',
            'installments'=> $installments
        ]);
    }

    public function create()
    {
        return view('installments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Installment::create($request->all());

        return redirect()->route('installments.index')->with('success', 'Installment created successfully.');
    }

    public function show(Installment $installment)
    {
        return view('installments.show', [
            'title' => 'Installment Details',
            'installment' => $installment,
        ]);
    }

    public function edit(Installment $installment)
    {
        return view('installments.edit', compact('installment'));
    }

    public function update(Request $request, Installment $installment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $installment->update($request->all());

        return redirect()->route('installments.index')->with('success', 'Installment updated successfully.');
    }

    public function destroy(Installment $installment)
    {
        $installment->delete();

        return redirect()->route('installments.index')->with('success', 'Installment deleted successfully.');
    }
    
}
