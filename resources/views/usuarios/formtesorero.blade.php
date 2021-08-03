@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endsection

<?php
// Si viene el usuario es porque se va a editar
if(isset($user)){
    $tituloForm = 'Editar Tesorero';
} else{
    // se creara y se necesita inicializar el objecto del usuario
    $user = [
        'id' => null,
        'first_name' => '',
        'last_name' => '',
        'ci' => '',
        'email' => '',
        'phone' => ''
    ];
    $tituloForm = 'Registrar Tesorero';
}

?>


@section('admincontent')

<h1>{{$tituloForm}}</h1>
<form  action="{{$user['id']?route('admin.tesorero.update',['tesorero'=>$user['id']]):route('admin.tesorero.store')}}" method="POST" >

    @csrf
    @if($user['id'])
        <input type="hidden" name="_method" value="PUT" />
    @endif
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="first_name"  value="{{ old('first_name')??$user['first_name'] }}" required autofocus>
        <span></span>
        <label >Nombre</label>
    </div>
    @error('first_name')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="last_name"  value="{{ old('last_name')??$user['last_name'] }}" required autofocus>
        <span></span>
        <label >Apellido</label>
    </div>
    @error('last_name')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="ci"   value="{{ old('ci')??$user['ci'] }}" required autofocus>
        <span></span>
        <label >Cédula de identidad</label>
    </div>
    @error('ci')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="phone"   value="{{ old('phone')??$user['phone'] }}" required autofocus>
        <span></span>
        <label >Teléfono</label>
    </div>
    @error('phone')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>

    <!-- campos de credenciales -->
    <div class="form-campo">
    <div class="campo">
        <input type="email" name="email"   value="{{ old('email')??$user['email'] }}" required autofocus>
        <span></span>
        <label >Correo electrónico</label>
    </div>
    @error('email')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>
    <div class="form-campo">
        <div class="campo">
            <input type="password" name="password"   value=""  
            @if(!$user['id'])
                required
            @endif
            
            autofocus>
            <span></span>
            <label >Password</label>
        </div>
        @error('password')
            <div class="invalid-feedback2" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
        </div>
        <div class="form-campo">
            <div class="campo">
                <input type="password" name="password_confirmation"   value=""
                @if(!$user['id'])
                required
            @endif
             autofocus>
                <span></span>
                <label >Confirmar Password</label>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback2" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            </div>

    <div class="my-4 text-center row justify-content-evenly" >

        <a class="btn btn-secondary" href="{{route('admin.tesorero.index')}}" value="Registrar">
            Cancelar
        </a> 
        @if($user['id'])
            <input type="submit" value="Actualizar" />
        @else 
            <input type="submit" value="Registrar" />
        @endif

    </div>
    
</form>

@endsection