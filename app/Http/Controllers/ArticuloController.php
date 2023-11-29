<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Iva;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = $request->query('order', 'denominacion');
        $order_dir = $request->query('order_dir', 'asc');
        $articulos = Articulo::with(['iva', 'categoria'])
            ->leftJoin('categorias', 'articulos.categoria_id', '=', 'categorias.id')
            ->leftJoin('ivas', 'articulos.iva_id', '=', 'ivas.id')
            ->orderBy($order, $order_dir)
            ->orderBy('denominacion')
            ->paginate(3);
        return view('articulos.index', [
            'articulos' => $articulos,
            'order' => $order,
            'order_dir' => $order_dir,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articulos.create', [
            'categorias' => Categoria::all(),
            'ivas' => Iva::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validar($request);
        Articulo::create($validated);
        return redirect()->route('articulos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulo $articulo)
    {
        return view('articulos.edit', [
            'articulo' => $articulo,
            'categorias' => Categoria::all(),
            'ivas' => Iva::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articulo $articulo)
    {
        $validated = $this->validar($request);
        $articulo->update($validated);
        return redirect()->route('articulos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articulo $articulo)
    {
        $articulo->delete();
        return redirect()->route('articulos.index');
    }

    private function validar(Request $request)
    {
        return $request->validate([
            'denominacion' => 'required|max:255',
            'precio' => 'required|numeric|decimal:2|between:-9999.99,9999.99',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'iva_id' => 'required|integer|exists:ivas,id'
        ]);
    }
}
