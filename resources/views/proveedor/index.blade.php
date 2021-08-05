
@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/listar.css') }}" rel="stylesheet">
@endsection



@section('admincontent')

<div class="listando">  
    <h1>Listado de Proveedores</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Rif</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Status</th>
            <th>Descripción</th>
            <th colspan="2">Acciones</th>
        </tr>
    </tr>
    @foreach ($proveedores as $proveedor)
        <tr>
            <td>{{$proveedor->id}}</td>
            <td>{{$proveedor->name}}</td>
            <td>{{$proveedor->rif}}</td>
            <td>{{$proveedor->address}}</td>
            <td>{{$proveedor->phone}}</td>
            <td>{{$proveedor->status?'Activo':'Inactivo'}}</td>
            <td>{{$proveedor->description}}</td>
            <td>
                <a class="link_editar" href="{{route('admin.proveedor.edit',['proveedor'=>$proveedor['id']])}}" class="link_editar">Editar</a>
            </td>
            <td>
                @if($proveedor['status'])
                    <a  href="#" data-bs-toggle="modal" onclick="setAccion('{{route('admin.proveedor.disable',['proveedor'=>$proveedor['id']])}}', '¿Seguro desea Desactivar?')" data-bs-target="#ventanamodal">
                    <label class="text-danger" >
                        Desactivar
                    </label>
                    </a>
                @else
                <a  href="#" data-bs-toggle="modal" onclick="setAccion('{{route('admin.proveedor.active',['proveedor'=>$proveedor['id']])}}','¿Seguro desea Activar?')" data-bs-target="#ventanamodal">
                    <label class="text-primary" >
                        Activar
                    </label>
                    </a>
                @endif

            </td>
        </tr>
    @endforeach
    </table>
</div>

@endsection




