@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos</h1>

    <div class="mb-3">
        @if(!auth()->user()->hasRole('viewer'))
            <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Nuevo Producto</a>
        @else
            <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Nuevo Producto</a>
        @endif
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

    <table class="table" id="products-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Fecha de Creación</th>
            @if(!auth()->user()->hasRole('viewer'))
                <th>Acciones</th>
            @endif
            </tr>
        </thead>
        <tbody id="products-table-container">
            @include('products.table', ['products' => $products['data']])
        </tbody>
    </table>

    <div id="pagination-container">
        @include('products.pagination', ['paginator' => $products])
    </div>

</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
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
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        alert('No tienes permiso para eliminar este producto. Solo los administradores pueden realizar esta acción.');
                    } else {
                        alert('Ha ocurrido un error al intentar eliminar el producto. Por favor, inténtalo de nuevo más tarde.');
                    }
                }
            });
        }
    });

    function loadProducts(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#products-table-container').html(data.table);
                $('#pagination-container').html(data.pagination);
            },
            error: function(xhr) {
                console.error('Error cargando productos:', xhr.responseText);
            }
        });
    }

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var searchTerm = $('#search').val();
        if (searchTerm) {
            url += (url.includes('?') ? '&' : '?') + 'search=' + encodeURIComponent(searchTerm);
        }
        loadProducts(url);
    });

    $('#search-form').on('submit', function(e) {
        e.preventDefault();
        var searchTerm = $('#search').val();
        loadProducts('{{ route("products.index") }}?search=' + encodeURIComponent(searchTerm));
    });
});
</script>
@endsection
