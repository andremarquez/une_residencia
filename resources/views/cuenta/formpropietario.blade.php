@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endsection

<?php
// Si viene el usuario es porque se va a editar
if(isset($user)){
    $tituloForm = 'Editar Cuenta Propietario';
} else{
    // se creara y se necesita inicializar el objecto del usuario
    $user = new \App\Models\User();
    $apartamento = new \App\Models\Apartamento();

    $tituloForm = 'Crear Cuenta Propietario';
    
}
?>


@section('admincontent')

<h1>{{$tituloForm}}</h1>
<form  action="{{$user->id?route('admin.propietario.update',['propietario'=>$user->id]):route('admin.propietario.store')}}" method="POST" >

    @csrf
    @if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Por favor, corrija los siguientes errores</strong></p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
    @if(session('message'))
        <div class="alert alert-danger">{{session('message')}}</div>
    @endif
    <div class="form-campo">
        
    <div class="form-group w-100">
        <div class="fw-bold ">Apartamento</div>
        <select class="custom-select w-100" {{$apartamento->id?'disabled':''}} class="w" name="apartamento_id"  required autofocus>
            <option value="" disabled selected ></option>
            @foreach ($apartamentos as $apart){

                @if($apart->id == old('apartamento_id')?old('apartamento_id'):$apartamento->id)
                    <option value="{{$apart->id}}" selected>{{$apart->level}}-{{$apart->code}}</option>    
                @else
                    <option value="{{$apart->id}}">{{$apart->level}}-{{$apart->code}}</option>
                @endif
                
            }
                
            @endforeach
            
        </select>

        @error('apartamento_id')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        
    </div>

    
    @if($user->id)
        <input type="hidden" name="_method" value="PUT" />
    @endif
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="first_name"  value="{{ old('first_name')??$user->first_name }}" required autofocus>
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
        <input type="email" name="email"   value="{{ old('email')??$user['email'] }}" required >
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

        <a class="btn btn-secondary" href="{{route('admin.propietario.index')}}" value="Registrar">
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