<?php

namespace App\Http\Controllers;

use App\Models\Iva;
use Illuminate\Http\Request;

class IvaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ivas.index', [
            'ivas' => Iva::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ivas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validar($request);
        Iva::create($validated);
        return redirect()->route('iva.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Iva $iva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Iva $iva)
    {
        return view('categorias.edit', [
            'iva' => $iva,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Iva $iva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Iva $iva)
    {
        //
    }
    private function validar(Request $request)
    {
        return $request->validate([
            'tipo' => 'required|max:255',
            'porcentaje' => 'required|numeric|decimal:0|between:0,100',

        ]);
    }
}
