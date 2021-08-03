<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use App\Models\CuentaApartamento;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CuentaApartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $propietarios = DB::table('users')->select(
            'users.id',
            'users.first_name',
            'users.last_name',
            'users.phone',
            'users.ci',
            'users.email',
            'users.status',
            'CP.apartamento_id',
            'CP.start_date',
            'CP.end_date',
            'A.level',
            'A.code'
        )
            ->where('role_id', '=', Role::ROL_PROPIETARIO)
            ->join('cuenta_apartamentos as CP', 'CP.propietario_id', '=', 'users.id')
            ->join('apartamentos as A', 'A.id', '=', 'CP.apartamento_id')
            ->get();
        return view('cuenta.listapropietarios', compact('propietarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartamentos = Apartamento::whereNotIn('id', function ($query) {
            // seleccionar cuenta apartamentos con propietarios
            return $query->select('apartamento_id')
                ->from('cuenta_apartamentos')->whereNull('end_date');
        })->get();

        return view('cuenta.formpropietario', ['apartamentos' => $apartamentos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'email' => ['required', 'email', 'unique:users'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'ci' => ['required'],
                'phone' => ['required'],
                'password' => ['required', 'min:6', 'confirmed'],
                'apartamento_id' => ['required', 'exists:apartamentos,id']
            ],
            [
                'email.unique' => 'El email ya se encuentra registrado'
            ]
        );



        $user = new User();

        $user->role_id = Role::ROL_PROPIETARIO;

        //agregar los datos validos al objeto User
        $user->fill($data);
        // encriptar password
        $user->password = Hash::make($request->password);

        // inicio de transaccion, ya que se guarda en varias tablas
        DB::beginTransaction();
        try {
            //code...

            //se guarda usuario de tipo propietario
            $user->save();

            // crear cuenta usuario

            $cuentaApartamento =  new CuentaApartamento(
                [
                    'propietario_id' => $user->id,
                    'apartamento_id' => $request->apartamento_id,
                    'start_date' => date('Y-m-d')

                ]
            );

            $cuentaApartamento->save();

            DB::commit();
            //confirma cambio en bases de datos
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'Error creando cuenta Propietario',
                    $e->getMessage()
                ]);
        }

        return redirect()->route('admin.propietario.index')->withSuccess('Cuenta Propietario agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuentaApartamento  $cuentaApartamento
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaApartamento $cuentaApartamento)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuentaApartamento  $cuentaApartamento
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {


        // obteniendo apartamento asociado al usuario
        $apartamentos = DB::table('apartamentos')->whereIn('id', function ($query) use ($user) {
            return $query->select('apartamento_id')
                ->from('cuenta_apartamentos')
                ->where('propietario_id', $user->id);
        })->limit(1)->orderBy('id', 'desc')->get();
        $apartamento = $apartamentos[0];

        return view('cuenta.formpropietario', compact('user',  'apartamentos', 'apartamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuentaApartamento  $cuentaApartamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'email' => ['required', 'email'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'ci' => ['required'],
            'phone' => ['required']
        ];


        // si viene el password es porque se esta editando
        $password = null;
        if ($request->has('password') && $request->password != '') {
            $rules['password'] = ['required', 'min:6', 'confirmed'];
            $password = Hash::make($request->password);
        }

        // si cambia el email debo  validar que no exista
        if ($request->email != $user->email) {
            $rules['email'][] = 'unique:users';
        }


        $data = $request->validate(
            $rules,
            [
                'email.unique' => 'El email ya se encuentra registrado'
            ]
        );
        //agregar los datos validos al objeto User
        $user->fill($data);

        // si es distinto de null entonces actualizo
        if ($password) {
            $user->password = $password;
        }

        // inicio de transaccion, ya que se guarda en varias tablas
        DB::beginTransaction();
        try {
            //code...


            //se guarda usuario de tipo propietario
            $user->save();

            // crear cuenta usuario
            // no se permit actualizar el apartamento asignado
            /*
                $cuentaApartamento =  new CuentaApartamento(
                    [
                        'propietario_id' => $user->id,
                        'apartamento_id' => $request->apartamento_id,
                        'start_date' => date('Y-m-d')

                    ]
                );
                $cuentaApartamento->save()
                */



            DB::commit();
            //confirma cambio en bases de datos
        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'Error creando cuenta Propietario',
                    $e->getMessage()
                ]);
        }

        return redirect()->route('admin.propietario.index')->withSuccess('Cuenta Propietario agregada exitosamente');
    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function disable(User $user)
    {
        $user->status = false;
        $user->save();

        return response()->json(['success' => 'Usuario deshabilitado']);
    }

    /**
     * Acitve the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function active(User $user)
    {
        $user->status = true;
        $user->save();

        return response()->json(['success' => 'Usuario activado']);
    }

    public function liberar(User $user)
    {

        DB::beginTransaction();
        try {

            DB::table('cuenta_apartamentos')->where('propietario_id', $user->id)->update(
                ['end_date' => date('Y-m-d')]
            );

            $user->status = false;
            $user->save();

            DB::commit();

            return response()->json(['success' => 'Cuenta de usuario desactivada']);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json(['error' => 'error desconocido', 'message' => $e->getMessage()], 419);
        }

        return response()->json(['error' => 'error desconocido'], 419);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuentaApartamento  $cuentaApartamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaApartamento $cuentaApartamento)
    {
        //
    }
}
