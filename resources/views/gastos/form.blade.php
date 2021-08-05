@extends('dashboard.admin')

@section('assets')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endsection

<?php

use App\Models\GastoItem;

// Si viene el Gasto es porque se va a editar
if (isset($gasto)) {
    $tituloForm = 'Editar Gasto';
    $actionURL = route('gastos.update', ['gasto' => $gasto['id']]);
} else {
    // se creara y se necesita inicializar el objecto del Gasto
    $gasto = new \App\Models\Gasto();
    $tituloForm = 'Registrar Gasto';
    $actionURL = route('gastos.store');
}

// funcion para crear el select de los proveedores
function getSelectProveedores($proveedores,$seleccionado = null)
{
    $selectProveedores = '<select name="proveedor[]" class="w-100" required>
    <option value="" disabled selected ></option>';

    foreach ($proveedores as $proveedor) {
        if ($proveedor->id == $seleccionado) {
            $selectProveedores .= '<option value="' . $proveedor->id . '" selected >' . $proveedor->rif . ' - ' . $proveedor->name . '</option>';
        } else {
            $selectProveedores .= '<option value="' . $proveedor->id . '" >' . $proveedor->rif . ' - ' . $proveedor->name . '</option>';
        }
    }

    $selectProveedores .= '</select>';

    return $selectProveedores;
}

$formNuevaLinea =
    '
    var form = `
    <tr id="linea-${idRow}">
        <td>' .
    getSelectProveedores($proveedores) .
    '</td>
        <td style="width:300px">
            <textarea name="descripcion[]" class="w-100" required ></textarea>    
        </td>
        <td style="width:80px">
            <input type="number" name="cantidad[]" class="w-100" required />    
        </td>
        <td style="width:150px">
            <input type="number" name="precio_u[]" class="w-100" required/>    
        </td>
        <td style="width:80px">
            <input type="number" name="iva[]" class="w-100" required/>    
        </td>
        <td >
            <button class="btn-danger" type="button" onclick="eliminarLinea(\'linea-${idRow}\')" >    
                Eliminar
            </button>
        </td>
    </tr>
    `;';

$lineas = [];

// si viene por error o es edicions
if (isset($gasto->lineas) && count($gasto->lineas) > 0) {
    $lineas = $gasto->lineas;
} elseif (old('proveedor') && count(old('proveedor')) > 0) {
    // viene porque ocurrio un error en el controlador

    foreach (old('proveedor') as $key => $proveedor_id) {
        $lineas[] = new GastoItem([
            'proveedor_id' => $proveedor_id,
            'descripcion' => old('descripcion')[$key],
            'cantidad' => old('cantidad')[$key],
            'precio_u' => old('precio_u')[$key],
            'iva' => old('iva')[$key],
        ]);
    }
}

?>


@section('admincontent')

    <h1>{{ $tituloForm }}</h1>
    <form action="{{ $actionURL }}" method="POST" class="w-100" style="max-width: 1200px ">
        <!-- requerido para la session del usuario-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <p><strong>Por favor, corrija los siguientes errores</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif

        @csrf
        @if ($gasto['id'])
            <input type="hidden" name="_method" value="PUT" />
        @endif
        <h5>Periodo del Gasto</h5>
        <div class="row justify-start">
            <div class="form-campo col-auto">

                <div class="fw-bold ">Año</div>

                <select name="year" {{ $gasto->id ? 'disabled' : '' }} required autofocus>
                    <option value="" selected disabled></option>
                    <?php
                    for ($year = 2020; $year <= 2030; $year++) {
                        if ($year == (old('year') ? old('year') : $gasto->year)) {
                            echo '<option value="' . $year . '" selected>' . $year . '</option>';
                        } else {
                            echo '<option value="' . $year . '" >' . $year . '</option>';
                        }
                    }
                    ?>
                </select>
                <!-- si ocurre un error asociado al campo lo muestra-->
                @error('year')
                    <div class="invalid-feedback2" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="form-campo col">
                <div class="fw-bold ">Mes</div>

                <select name="month" {{ $gasto->id ? 'disabled' : '' }} required autofocus>
                    <option value="" selected disabled></option>
                    <?php
                    for ($month = 1; $month <= 12; $month++) {
                        if ($month == (old('month') ? old('month') : $gasto->month)) {
                            echo '<option value="' . $month . '" selected>' . ($month < 10 ? '0' : '') . $month . '</option>';
                        } else {
                            echo '<option value="' . $month . '" >' . ($month < 10 ? '0' : '') . $month . '</option>';
                        }
                    }
                    ?>
                </select>
                <!-- si ocurre un error asociado al campo lo muestra-->
                @error('month')
                    <div class="invalid-feedback2" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>

        <h5>Detalle de Gastos</h5>


        <table class="table">
            <thead style="padding: 10px;background: rgb(0, 153, 255,0.5) 30%;color: solid black;">
                <tr>
                    <th>Proveedor</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Iva</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="lineasGastos">

                @foreach ($lineas as $keyLinea => $linea)
                    <tr id="linea-{{ $keyLinea }}">
                        <td><?php echo getSelectProveedores($proveedores, $linea->proveedor_id) ?></td>
                        <td style="width:300px">
                            <textarea name="descripcion[]" class="w-100" required>{{ $linea->descripcion }}</textarea>
                        </td>
                        <td style="width:80px">
                            <input type="number" name="cantidad[]" class="w-100" value="{{ $linea->cantidad }}"
                                required />
                        </td>
                        <td style="width:150px">
                            <input type="number" name="precio_u[]" class="w-100" value="{{ $linea->precio_u }}"
                                required />
                        </td>
                        <td style="width:80px">
                            <input type="number" name="iva[]" class="w-100" value="{{ $linea->iva }}" required />
                        </td>
                        <td>
                            <button class="btn-danger" type="button" onclick="eliminarLinea('linea-{{ $keyLinea }}')">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>



        <div class="text-left my-2">
            <button type="button" class="btn-sm btn-primary px-2" onclick="agregarLineaDeGasto()">Agregar Linea</button>
        </div>


        <div class="my-4 text-center row justify-content-evenly">

            <a class="btn btn-secondary" href="{{ route('gastos.index') }}">
                Cancelar
            </a>
            @if ($gasto['id'])
                <input type="submit" value="Actualizar" />
            @else
                <input type="submit" value="Registrar Gasto" />
            @endif

        </div>

    </form>

@endsection

<script>
    function eliminarLinea(idLineaGasto) {
        document.getElementById(idLineaGasto).remove();
    }

    function agregarLineaDeGasto() {

        var lineasGastosElement = jQuery('#lineasGastos');

        var idRow = new Date().getTime();

        <?php echo $formNuevaLinea; ?>

        lineasGastosElement.append(jQuery.parseHTML(form));


    }
</script>
