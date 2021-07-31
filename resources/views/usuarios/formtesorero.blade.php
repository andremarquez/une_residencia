@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endsection

@section('admincontent')
<link rel="stylesheet" href="/css/form.css">
<h1>Registrar Tesorero</h1>
<form  action="Inicio.html" method="POST" >
    <div class="campo">
        <input type="text" required>
        <span></span>
        <label >Nombre</label>
    </div>
    <div class="campo">
        <input type="text" required>
        <span></span>
        <label >Apellido</label>
    </div>
    <div class="campo">
        <input type="number" required>
        <span></span>
        <label >Cédula de identidad</label>
    </div>
    <div class="campo">
        <input type="number" required>
        <span></span>
        <label >Teléfono</label>
    </div>
    <div class="campo">
        <input type="email" required>
        <span></span>
        <label >Correo electrónico</label>
    </div>
    
    <input type="submit" value="Registrar"> 
    
</form>

@endsection