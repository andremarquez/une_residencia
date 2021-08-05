@extends('layouts.private')

@section('assets')
    <link href="{{ asset('/css/inicio.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
@endsection
<?php

    $user = Auth::user();

?>

@section('menu')
<ul class="menu">
                <li><a href="#" class="item-options">Tesorero</a>
                    <ul class="Submenu">
                        <li><a href="{{route('admin.tesorero.create')}}">Registrar</a> </li>
                        <li><a href="{{route('admin.tesorero.index')}}">Consultar</a> </li>
                    </ul> 
                </li>
                <li> <a href="#" class="item-options">Propietario</a>
                    <ul class="Submenu">
                        <li><a href="{{route('admin.propietario.create')}}">Registrar</a></li>
                        <li><a href="{{route('admin.propietario.index')}}">Consultar</a> </li>
                        <li><a href="{{route('admin.apartamentos.index')}}">Listar Apartamentos</a> </li>
                    </ul>
                </li>
                <li><a href="#" class="item-options">Proveedor</a>
                    <ul class="Submenu">
                        <li><a href="{{route('admin.proveedor.create')}}">Registrar</a> </li>
                        <li><a href="{{route('admin.proveedor.index')}}">Consultar</a> </li>
                    </ul>
                </li>
                <li><a href="#" class="item-options">Gastos</a>
                    <ul class="Submenu">
                        <li><a href="{{route('gastos.create')}}">Registrar</a></li>
                        <li><a href="{{route('gastos.index')}}">Consultar</a> </li>
                    </ul>
                </li>
                <li> <a href="#" class="item-options">Factura</a>
                    <ul class="Submenu">
                        <li><a href="{{route('facturas.index')}}">Consultar</a></li>
                    </ul>
                </li>
                <li> <a href="#" class="item-options">Comprobante</a>
                    <!--ul class="Submenu">
                        <li><a href="">Listar</a></li>
                        <li><a href="">Validar</a></li>
                    </ul-->
                </li>
            </ul>
@endsection


@section('content')
    
    
        @if (Route::currentRouteName() == 'admin.dashboard')
          
       
            
        
            <section class="seccion-perfil-usuario">
                <div class="perfil-usuario-header">
                    <div class="perfil-usuario-portada">
                        <div class="perfil-usuario-avatar">
                            <img src="img/pics/logo.png" alt="img-avatar">
                            
                        </div>
                    </div>
                </div>
                <div class="perfil-usuario-body">
                    <div class="perfil-usuario-bio">
                        <h3 class="titulo">{{$user->first_name}} {{$user->last_name}}</h3>
                        <p class="texto">Bienvenido al sistema Residencias Uneistas, donde nuestro lema es Vivir en tranquilidad</p>
                    </div>
                    <div class="perfil-usuario-footer">
                        <ul class="lista-datos">
                            
                            <li><i class="icono fas fa-phone-alt"></i> Telefono: {{$user->phone}}</li>
                            <li><i class="icono fas fa-envelope"></i>Correo: {{$user->email}}</li>
                        </ul>
                        <ul class="lista-datos">
                            
                            <li><i class="icono fas fa-id-card"></i>Cedula de identidad:
                                {{$user->ci}}
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            
        
        
        @else
        <div class="px-2 py-2">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('admincontent')
        </div>
            
        @endif
@endsection



<!-- Modal -->

<div  style="display: none" class="modal fade"  id="ventanamodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="tituloventana" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 id="tituloventana">¡ALERTA!</h1>
                <button class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-sucess">
                    <h5 id="mensajeModal"></h5>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="aplicarAccion()">Aceptar</button>
                <button class="btn btn-danger"  data-bs-dismiss="modal" aria-label="Cerrar">
                    Cancelar
                </button>
                
            </div>
        </div>
    </div>
</div>

