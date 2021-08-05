<?php
use App\Models\Gasto;
use App\Models\Role;

$user = Auth::user();
?>


@section('assets')
    <link href="{{ asset('/css/listar.css') }}" rel="stylesheet">
@endsection



@section('admincontent')

    <div class="listando">
        <h1>Gastos de la Residencia</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Año/Mes</th>
                <th>Subtotal</th>
                <th>Monto Iva</th>
                <th>Total</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
            </tr>
            @foreach ($gastos as $gasto)
                <tr>
                    <td>{{ $gasto->id }}</td>
                    <td>{{ $gasto->year }}/{{ ($gasto->month < 10 ? '0' : '').$gasto->month  }}</td>
                    <td>{{ $gasto->subtotal }}</td>
                    <td>{{ $gasto->monto_iva }}</td>
                    <td>{{ $gasto->total }}</td>
                    <td><?php
                    switch ($gasto->status) {
                        case Gasto::STATUS_INICIAL:
                            echo 'pendiente';
                            break;
                        case Gasto::STATUS_APROBADO:
                            echo 'APROBADO';
                            break;
                        case Gasto::STATUS_DENEGADO:
                            echo 'DENEGADO';
                            break;
                        default:
                            # code...
                            break;
                    }
                    
                    ?></td>

                    <td>
                        <!-- solo puede editar usuario Admin y que el gasto no este aprobado -->
                        @if ($user->role_id == Role::ROL_ADMIN && $gasto->status != Gasto::STATUS_APROBADO)
                            <a class="link_editar" href="{{ route('gastos.edit', ['gasto' => $gasto['id']]) }}"
                                class="link_editar">Editar</a>
                        @else
                            <a class="link_view" href="{{ route('gastos.show', ['gasto' => $gasto['id']]) }}"
                                class="link_view fa fa-view">
                                
                                @if($gasto->status == Gasto::STATUS_INICIAL)
                                    ir Revisar/Aprobar
                                @else
                                    Ver
                                @endif

                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
