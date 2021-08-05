<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  Auth::user();

        if ($user->role_id == Role::ROL_PROPIETARIO) {
            $facturas = Factura::with(['gasto', 'cuenta'])
                ->whereIn(
                    'cuenta_apartamento_id',
                    function ($query) use ($user) {
                        return $query->select('id')->from('cuenta_apartamentos')->where('propietario_id', $user->id);
                    }
                )->get();
        } else {
            $facturas = Factura::with(['gasto', 'cuenta'])->get();
        }

        if ($user->role_id == Role::ROL_ADMIN) {
            return view('facturas.index', compact('facturas'));
        }

        if ($user->role_id == Role::ROL_TESORERO) {
            return view('facturas.indextesorero', compact('facturas'));
        }

        return view('facturas.indexpropietario', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
