@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos</h1>
    {{-- <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Crear Nuevo Producto</a>

    <div class="mb-3">
        <form id="search-form" class="form-inline">
            <input type="text" id="search" class="form-control mr-2" placeholder="Buscar productos...">
            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
        </form>
    </div> --}}

    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Nuevo Producto</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form id="search-form" class="form-inline">
                <div class="input-group">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar productos...">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <table class="table" id="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products['data'] as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['title'] }}</td>
                <td>${{ number_format($product['price'], 2) }}</td>
                <td>{{ $product['created_at'] }}</td>
                <td>
                    <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-sm btn-info">Editar</a>
                    <button class="btn btn-sm btn-danger delete-product" data-id="{{ $product['id'] }}">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
    <div id="products-table-container">
        @include('products.table')
    </div>

    <div id="pagination">
        {{-- {{ $products->links() }} --}}
    </div>
</div>

@endsection

@section('scripts')
{{-- <script>
$(document).ready(function() {
    // Manejo de eliminación
    $('.delete-product').on('click', function() {
        if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '/products/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(result) {
                    location.reload();
                }
            });
        }
    });

    // Manejo de búsqueda
    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        var searchTerm = $('#search').val();
        $.ajax({
            url: '{{ route("products.index") }}',
            type: 'GET',
            data: {
                search: searchTerm
            },
            success: function(result) {
                $('#products-table tbody').html(result);
            }
        });
    });
});
</script> --}}
<script>
$(document).ready(function() {
    function loadProducts(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#products-table-container').html(data);
            },
            error: function(xhr) {
                console.error('Error cargando productos:', xhr.responseText);
            }
        });
    }

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        loadProducts(url);
    });

    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        var searchTerm = $('#search').val();
        loadProducts('{{ route("products.index") }}?search=' + searchTerm);
    });
});
</script>
@endsection
