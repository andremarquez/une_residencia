@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/listar.css') }}" rel="stylesheet">
@endsection


@section('admincontent')

<div class="listando">  
    <h1>Listado de Propietarios</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula de identidad</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Status</th>
            <th>Apartamento</th>
            <th colspan="2">Acciones</th>
        </tr>
    </tr>

    @foreach ($propietarios as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->ci}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->status?'Activo':'Inactivo'}}</td>
            <td>{{$user->level}} - {{$user->code}}</td>
            <td>
                <a class="link_editar" href="{{route('admin.propietario.edit',['propietario'=>$user->id])}}" class="link_editar">Editar</a>
            </td>
            <td>
                @if($user->status)
                    <a  href="#" data-bs-toggle="modal" onclick="setAccion('{{route('admin.propietario.disable',['propietario'=>$user->id])}}', '¿Seguro desea Desactivar?')" data-bs-target="#ventanamodal">
                    <label class="text-danger" >
                        Desactivar 
                    </label>
                    </a>
                @else
                <a  href="#" data-bs-toggle="modal" onclick="setAccion('{{route('admin.propietario.active',['propietario'=>$user->id])}}','¿Seguro desea Activar?')" data-bs-target="#ventanamodal">
                    <label class="text-primary" >
                        Activar
                    </label>
                    </a>
                @endif

            </td>
            <td>
                @if($user->end_date == null)
                    <a class="btn btn-primary btn-sm" title="Liberar para asignar a otro Propietario"  href="#" data-bs-toggle="modal" onclick="setAccion('{{route('admin.propietario.liberar',['propietario'=>$user->id])}}','¿Seguro desea Liberar el Apartamento?')" data-bs-target="#ventanamodal">
                        <label class="" >
                            Liberar
                        </label>
                        </a>
                @endif

            </td>
        </tr>
    @endforeach
    </table>
</div>

@endsection




