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
        <h1>Facturas</h1>
        <table>
            <tr>
                <th>Numero Factura</th>
                <th>Año/Mes</th>
                <th>Subtotal Gastos</th>
                <th>Monto Iva</th>
                <th>Total Gastos</th>
                <th>Apartamento</th>
                <th>Alicuota</th>
                <th>Monto</th>
            </tr>
            </tr>
            @foreach ($facturas as $fact)
                <tr>
                    <td>{{ $fact->id }}</td>
                    <td>{{ $fact->gasto->year }}/{{ ($fact->gasto->month < 10 ? '0' : '').$fact->gasto->month  }}</td>
                    <td>{{ number_format($fact->gasto->subtotal,2) }}</td>
                    <td>{{number_format( $fact->gasto->monto_iva,2) }}</td>
                    <td>{{ number_format($fact->gasto->total,2) }}</td>
                    <td>{{ $fact->cuenta->apartamento->level }} - {{ $fact->cuenta->apartamento->code }}</td>
                    <td>{{ number_format($fact->alicuota*100,2)}} %</td>
                    <td>{{ number_format($fact->monto,2) }}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
