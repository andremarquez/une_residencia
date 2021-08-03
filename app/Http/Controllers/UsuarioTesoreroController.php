<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Tesorero;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioTesoreroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // busca en bases de datos usuarios con rol id igual a Tesorero
        $usuarios = User::where('role_id','=',Role::ROL_TESORERO)->get();
        return view('usuarios.listatesoreros',['usuarios'=>$usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.formtesorero');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'ci' => ['required'],
            'phone' => ['required'],
            'password' => ['required', 'min:6', 'confirmed']
        ],
        [
            'email.unique' => 'El email ya se encuentra registrado'
        ]
        );

        

        $user = new User();

        $user->role_id = Role::ROL_TESORERO;

        //agregar los datos validos al objeto User
        $user->fill($data);
        // encriptar password
        $user->password = Hash::make($request->password);
        //guardar en bases de datos
        $user->save();

        return redirect()->route('admin.tesorero.index')->withSuccess('Tesorero agregado exitosamente');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('usuarios.formtesorero', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
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
        if($request->has('password') && $request->password != ''  ) {
            $rules['password'] = ['required', 'min:6', 'confirmed'];
            $password = Hash::make($request->password);
        }
        
        // si cambia el email debo  validar que no exista
        if($request->email != $user->email ){
            $rules['email'][] = 'unique:users';
        }

        
        $data = $request->validate(
            $rules,
        [
            'email.unique' => 'El email ya se encuentra registrado'
        ]
        );

        $user->fill($data);

        // si es distinto de null entonces actualizo
        if($password){
            $user->password = $password;
        }

        $user->save();
        /*
        return view('usuarios.formtesorero', ['user' => $user,
        'mensaje' => 'Tesorero editado exitosamente'
    ]);*/
    return redirect()->route('admin.tesorero.index')->withSuccess('Tesorero editado exitosamente');
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

        return response()->json(['success'=>'Usuario deshabilitado']);
    }

    /**
     * Disable the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function active(User $user)
    {
        $user->status = true;
        $user->save();

        return response()->json(['success'=>'Usuario activado']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    
}
