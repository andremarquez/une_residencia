@section('assets')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endsection

<?php
use App\Models\Gasto;
use App\Models\GastoItem;

?>
@section('admincontent')

    <h1>Detalle de Gasto</h1>
    <div class="w-100" style="max-width: 1200px ">
        <!-- requerido para la session del usuario-->

        @csrf
        @if ($gasto['id'])
            <input type="hidden" name="_method" value="PUT" />
        @endif

        <div class="row justify-content-between">

            <div class="col-4">
                <h5 class="mb-1 border-bottom border-secondary fw-bold">Periodo del Gasto</h5>
                <div class="row">
                    <div class="col-auto">
                        <div class="fw-bold ">Año:</div>{{ $gasto->year }}
                    </div>

                    <div class=" col">
                        <div class="fw-bold ">Mes:</div>{{ ($gasto->month < 10 ? '0' : '') . $gasto->month }}
                    </div>
                </div>
            </div>


            <div class="col-4 text-center">


                <div class="fw-bold mb-1 border-bottom border-secondary">Status</div>
                <?php
                switch ($gasto->status) {
                    case Gasto::STATUS_INICIAL:
                        echo '<span class="text-warning">PENDIENTE</span>';
                        break;
                    case Gasto::STATUS_APROBADO:
                        echo '<span class="text-success">APROBADO</span>';
                        break;
                    case Gasto::STATUS_DENEGADO:
                        echo '<span class="text-danger">DENEGADO</span>';
                        break;
                    default:
                        # code...
                        break;
                }
                
                ?>


            </div>

            <div class="col-4">
                <div class="row ">
                    <div class="col-auto">
                        <div class="fw-bold mb-1 border-bottom border-secondary">Sub Total</div>
                        {{ number_format($gasto->subtotal, 2) }}

                    </div>
                    <div class="col-auto">
                        <div class="fw-bold mb-1 border-bottom border-secondary">Monto Iva</div>
                        {{ number_format($gasto->monto_iva, 2) }}
                    </div>
                </div>
                <div class="col text-right">
                    <div class="fw-bold fs-4 ">Total</div>{{ number_format($gasto->total, 2) }}
                </div>
            </div>
        </div>

        <h5 class="mt-4  border-bottom border-secondary">Lineas de Gastos</h5>


        <table class="table">
            <thead style="padding: 10px;background: rgb(0, 153, 255,0.5) 30%;color: solid black;">
                <tr>
                    <th>Proveedor</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Iva</th>
                </tr>
            </thead>
            <tbody id="lineasGastos">

                @foreach ($gasto->lineas as $keyLinea => $linea)
                    <tr id="linea-{{ $keyLinea }}">
                        <td>{{ $linea->proveedor->rif }} - {{ $linea->proveedor->name }}</td>
                        <td style="width:300px">
                            {{ $linea->descripcion }}</textarea>
                        </td>
                        <td style="width:80px">
                            {{ $linea->cantidad }}
                        </td>
                        <td style="width:150px">
                            {{ $linea->precio_u }}
                        </td>
                        <td style="width:80px">
                            {{ $linea->iva }} %
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>



        <div class="my-4 text-center row justify-content-evenly">



            @if ($gasto->status == Gasto::STATUS_INICIAL)

                <a class="btn btn-secondary" data-bs-toggle="modal"
                    onclick="setAccion('{{ route('gastos.denegar', ['gasto' => $gasto->id]) }}', '¿Seguro desea Denegar el Gasto?')"
                    data-bs-target="#ventanamodal">
                    DENEGAR
                </a>


                <button class="btn btn-primary " style="max-width: 260px" data-bs-toggle="modal"
                    onclick="setAccion('{{ route('gastos.aprobar', ['gasto' => $gasto->id]) }}', '¿Seguro desea Aprobar el Gasto. Automaticamente se generaran las facturas para las Cuentas de Propietarios?')"
                    data-bs-target="#ventanamodal">
                    Aprobar /Generar Facturas</button>
            @endif
        </div>

    </div>

@endsection
