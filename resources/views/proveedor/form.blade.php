@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endsection

<?php
// Si viene el proveedor es porque se va a editar
if(isset($proveedor)){
    $tituloForm = 'Editar Proveedor';
} else{
    // se creara y se necesita inicializar el objecto del proveedor
    $proveedor = new \App\Models\Proveedor();
    $tituloForm = 'Registrar Proveedor';
}

?>


@section('admincontent')

<h1>{{$tituloForm}}</h1>
<form  action="{{$proveedor['id']?route('admin.proveedor.update',['proveedor'=>$proveedor['id']]):route('admin.proveedor.store')}}" method="POST" >
    <!-- requerido para la session del usuario-->
    @csrf
    @if($proveedor['id'])
        <input type="hidden" name="_method" value="PUT" />
    @endif
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="name"  value="{{ old('name')??$proveedor['name'] }}" required autofocus>
        <span></span>
        <label >Nombre del Proveedor</label>
    </div>
    @error('name')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="rif"  value="{{ old('rif')??$proveedor['rif'] }}" required autofocus>
        <span></span>
        <label >Rif</label>
    </div>
    @error('rif')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="address"   value="{{ old('address')??$proveedor['address'] }}" required autofocus>
        <span></span>
        <label >Dirección</label>
    </div>
    @error('address')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>
    <div class="form-campo">
    <div class="campo">
        <input type="text" name="phone"   value="{{ old('phone')??$proveedor['phone'] }}" required autofocus>
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
        <input type="text" name="description"   value="{{ old('description')??$proveedor['description'] }}" required autofocus>
        <span></span>
        <label >Descripción</label>
    </div>
    @error('description')
        <div class="invalid-feedback2" role="alert">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
    </div>


    <div class="my-4 text-center row justify-content-evenly" >

        <a class="btn btn-secondary" href="{{route('admin.proveedor.index')}}" value="Registrar">
            Cancelar
        </a> 
        @if($proveedor['id'])
            <input type="submit" value="Actualizar" />
        @else 
            <input type="submit" value="Registrar" />
        @endif

    </div>
    
</form>

@endsection