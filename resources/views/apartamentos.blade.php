@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/listar.css') }}" rel="stylesheet">
@endsection



@section('admincontent')

<div class="listando">  
    <h1>Listado de Apartamentos</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Piso</th>
            <th>Codigo</th>
            <th>Alicuota</th>
        </tr>
    </tr>
    @foreach ($apartamentos as $aparta)
        <tr>
            <td>{{$aparta->id}}</td>
            <td>{{$aparta->level}}</td>
            <td>{{$aparta->code}}</td>
            <td>{{number_format($aparta->aliquot*100,2)}} %</td>
        </tr>
    @endforeach
    </table>
</div>

@endsection




