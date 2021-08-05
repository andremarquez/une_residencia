<?php

namespace App\Http\Controllers;

use App\Models\CuentaApartamento;
use App\Models\Factura;
use App\Models\Gasto;
use App\Models\GastoItem;
use App\Models\Proveedor;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gasto::all();

        if(Auth::user()->role_id == Role::ROL_ADMIN){
            return view('gastos.index', compact('gastos'));
        }

        return view('gastos.indextesorero', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $proveedores = Proveedor::all();
        return view('gastos.form', compact('proveedores'));
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
            'year' => 'required',
            'month' => 'required',
            'proveedor.*' => 'required',
            'descripcion.*' => 'required',
            'precio_u.*' => 'required',
            'subtotal.*' => 'required',
            'iva.*' => 'required',
        ]);

        // validar que exista al menos una linea de gasto
        if (count($request->proveedor) < 1) {
            return back()->withErrors([
                'error' => 'Debe existir al menos una linea de gasto',
            ]);
        }

        // abrir transaccion porque son varias operaciones sobre tablas
        // para mantener consistencia
        DB::beginTransaction();
        try {

            $lineas = array();
            $subtotal = 0;
            $montoiva = 0;
            foreach ($request->proveedor as $key => $proveedor_id) {

                $lineas[] = new GastoItem([
                    'proveedor_id' => $proveedor_id,
                    'descripcion' => $request->descripcion[$key],
                    'cantidad' => $request->cantidad[$key],
                    'precio_u' => $request->precio_u[$key],
                    'iva' => $request->iva[$key],
                ]);

                $monto = $request->cantidad[$key] * $request->precio_u[$key];

                $subtotal = $subtotal + $monto;

                if ($request->iva[$key] > 0) {
                    $montoiva = $montoiva + $monto * $request->iva[$key] / 100;
                }
            }

            $gasto =  new Gasto([
                'year' => $request->year,
                'month' => $request->month,
                'subtotal' => $subtotal,
                'monto_iva' => $montoiva,
                'total' => $subtotal + $montoiva
            ]);

            // guarda en bases de datos
            $gasto->save();


            //guardar lineas de gasto
            foreach ($lineas as $linea) {
                $linea->gasto_id = $gasto->id;
                $linea->save();
            }

            // confirmar cambios en bases de datos
            DB::commit();

            return redirect()->route('gastos.index')->with('success', 'Gasto registrado satisfactoriamente.');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error con la bases de datos',
                $e->getMessage()
            ]);
        }

        return back()->withErrors([
            'error' => 'Error desconocido',
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function show(Gasto $gasto)
    {
        $proveedores = Proveedor::all();

        if(Auth::user()->role_id == Role::ROL_ADMIN){
            return view('gastos.show', compact('proveedores','gasto'));
        }

        return view('gastos.showtesorero', compact('proveedores','gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function edit(Gasto $gasto)
    {
        $proveedores = Proveedor::all();
        return view('gastos.form', compact('proveedores','gasto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gasto $gasto)
    {
        $request->validate([
            'proveedor.*' => 'required',
            'descripcion.*' => 'required',
            'precio_u.*' => 'required',
            'subtotal.*' => 'required',
            'iva.*' => 'required',
        ]);

        // validar que exista al menos una linea de gasto
        if (count($request->proveedor) < 1) {
            return back()->withErrors([
                'error' => 'Debe existir al menos una linea de gasto',
            ]);
        }

        // abrir transaccion porque son varias operaciones sobre tablas
        // para mantener consistencia
        DB::beginTransaction();
        try {

            $lineas = array();
            $subtotal = 0;
            $montoiva = 0;
            foreach ($request->proveedor as $key => $proveedor_id) {

                $lineas[] = new GastoItem([
                    'proveedor_id' => $proveedor_id,
                    'descripcion' => $request->descripcion[$key],
                    'cantidad' => $request->cantidad[$key],
                    'precio_u' => $request->precio_u[$key],
                    'iva' => $request->iva[$key],
                ]);

                $monto = $request->cantidad[$key] * $request->precio_u[$key];

                $subtotal = $subtotal + $monto;

                if ($request->iva[$key] > 0) {
                    $montoiva = $montoiva + $monto * $request->iva[$key] / 100;
                }
            }
            // siempre que se actualice un Gasto por parte del administrador
            // se llevara a estado inicial
            // un Admin no puede modificar un Gasto ya aprobado por tesoreria
            // porque al momento de aprobar, se generan las facturas
            $gasto->update([
                'status' => Gasto::STATUS_INICIAL,
                'subtotal' => $subtotal,
                'monto_iva' => $montoiva,
                'total' => $subtotal + $montoiva
            ]);

            // guarda en bases de datos
            $gasto->lineas()->delete();


            //guardar lineas de gasto
            foreach ($lineas as $linea) {
                $linea->gasto_id = $gasto->id;
                $linea->save();
            }

            // confirmar cambios en bases de datos
            DB::commit();

            return redirect()->route('gastos.index')->with('success', 'Gasto actualizado satisfactoriamente.');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withErrors([
                'error' => 'Error con la bases de datos',
                $e->getMessage()
            ]);
        }

        return back()->withErrors([
            'error' => 'Error desconocido',
        ]);

    }

    // funciones para APROBAR O DENEGAR gastos


    /**
     * Disable the specified resource from storage.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function aprobar(Gasto $gasto)
    {


        DB::beginTransaction();
        try {
            // confirmar cambios en bases de datos
            
            $gasto->status = Gasto::STATUS_APROBADO;
            $gasto->save();


            // generar facturas para todas las cuenta de apartamentos 
            // que no tengan fecha fin

            $cuentaApartamentosActivos = CuentaApartamento::whereNull('end_date')->with(['apartamento'])->get();

            foreach($cuentaApartamentosActivos as $cuenta){
                Factura::create([
                    'cuenta_apartamento_id' => $cuenta->id,
                    'gasto_id' => $gasto->id,
                    'alicuota' =>$cuenta->apartamento->aliquot,
                    // monto a pagar dependiendo de la alicuota
                    'monto' =>$cuenta->apartamento->aliquot * $gasto->total
                ]);

            }

            DB::commit();

            return response()->json(['success'=>'Gasto Aprobado y generadas las facturas']);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'error' => 'Error con la bases de datos',
                $e->getMessage()
            ], 419);
        }

        return response()->json([
            'error' => 'Error desconocido',
        ], 419);


    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function denegar(Gasto $gasto)
    {
        $gasto->status = Gasto::STATUS_DENEGADO;
        $gasto->save();

        return response()->json(['success'=>'Gasto denegado']);
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gasto $gasto)
    {
        //
    }
}
