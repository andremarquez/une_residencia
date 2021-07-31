@extends('layouts.private')

@section('menu')
<ul class="menu">
                <li><a href="#" class="item-options">Tesorero</a>
                    <ul class="Submenu">
                        <li><a href="{{route('admin.tesorero.create')}}">Registrar</a> </li>
                        <li><a href="">Modificar</a> </li>
                        <li><a href="">Deshabilitar</a> </li>
                    </ul> 
                </li>
                <li> <a href="#" class="item-options">Propietario</a>
                    <ul class="Submenu">
                        <li><a href="">Registrar</a></li>
                        <li><a href="">Modificar</a> </li>
                        <li><a href="">Listar</a></li>
                        <li><a href="">Deshabilitar</a></li>
                        <li><a href="">Listar morosos</a></li>
                    </ul>
                </li>
                <li><a href="#" class="item-options">Proveedor</a>
                    <ul class="Submenu">
                        <li><a href="RegistroProvee.html">Registrar</a></li>
                        <li><a href="">Modificar</a> </li>
                        <li><a href="">Listar</a></li>
                        <li><a href="">Deshabilitar</a></li>
                    </ul>
                </li>
                <li><a href="#" class="item-options">Gastos</a>
                    <ul class="Submenu">
                        <li><a href="">Registrar</a></li>
                        <li><a href="">Modificar</a> </li>
                    </ul>
                </li>
                <li> <a href="#" class="item-options">Factura</a>
                    <ul class="Submenu">
                        <li><a href="">Crear</a></li>
                        <li><a href="">Anular</a></li>
                        <li><a href="">Listar</a></li>
                        <li><a href="">Validar</a></li>
                    </ul>
                </li>
                <li> <a href="#" class="item-options">Comprobante</a>
                    <ul class="Submenu">
                        <li><a href="">Listar</a></li>
                        <li><a href="">Validar</a></li>
                    </ul>
                </li>
            </ul>
@endsection


@section('content')
    
    
        @if (Route::currentRouteName() == 'admin.dashboard')
          
        <div class="Arreglar">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid nulla minima molestiae totam accusantium? Dignissimos, rerum. Quibusdam eligendi corrupti totam, obcaecati maxime quas, accusantium officia alias architecto eum, deleniti maiores.        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid nulla minima molestiae totam accusantium? Dignissimos, rerum. Quibusdam eligendi corrupti totam, obcaecati maxime quas, accusantium officia alias architecto eum, deleniti maiores.
 
           accusantium officia alias architecto eum, deleniti maiores.
           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid nulla minima molestiae totam accusantium? Dignissimos, rerum. Quibusdam eligendi corrupti totam, obcaecati maxime quas, accusantium officia alias architecto eum, deleniti maiores.
           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid nulla minima molestiae totam accusantium? 
           
           
           
           ecati maxime quas, accusantium officia alias architecto eum, deleniti maiores.
           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid nulla minima molestiae totam accusantium? Dignissimos, rerum. Quibusdam eligendi corrupti totam, obcaecati maxime quas, accusantium officia alias architecto eum, deleniti maiores.
           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid nulla minima molestiae totam accusantium? Dignissimos, rerum. Quibusdam eligendi corrupti totam, obcaecati maxime quas, accusantium officia alias architecto eum, deleniti maiores.
           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid nulla minima molestiae totam accusantium? Dignissimos, rerum. Quibusdam eligendi corrupti totam, obcaecati maxime quas, accusantium officia alias architecto eum, deleniti maiores.
           Lore</div> 
        @else
        <div class="px-2 py-2">
            @yield('admincontent')
        </div>
            
        @endif
@endsection

