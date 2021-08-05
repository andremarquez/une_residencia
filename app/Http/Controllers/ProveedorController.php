<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();

        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'rif' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'description' => 'required'
        ]);

        Proveedor::create($request->all());

        return redirect()->route('admin.proveedor.index')->with('success','Proveedor creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedor.form',compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $request->validate([
            'name' => 'required',
            'rif' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'description' => 'required'
        ]);

        $proveedor->update($request->all());

        return redirect()->route('admin.proveedor.index')->with('success','Proveedor actualizado exitosamente');
    }

  /**
     * Disable the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function disable(Proveedor $proveedor)
    {
        $proveedor->status = false;
        $proveedor->save();

        return response()->json(['success'=>'Proveedor deshabilitado']);
    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function active(Proveedor $proveedor)
    {
        $proveedor->status = true;
        $proveedor->save();

        return response()->json(['success'=>'Proveedor activado']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        //
    }
}
