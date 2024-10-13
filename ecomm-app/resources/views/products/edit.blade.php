@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form id="edit-product-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $product['title'] }}" required>
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product['price'] }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#edit-product-form').on('submit', function(e) {
        e.preventDefault();
        
        var title = $('#title').val();
        var price = parseFloat($('#price').val());
        var errors = [];
        
        if (title.trim() === '' || title.length < 5) {
            errors.push('El título debe tener al menos 5 caracteres.');
        }
        
        if (isNaN(price) || price <= 0) {
            errors.push('El precio debe ser mayor que cero.');
        }
        
        if (errors.length > 0) {
            alert('Errores de validación:\n' + errors.join('\n'));
            return;
        }
        
        $.ajax({
            url: '{{ route("products.update", $product['id']) }}',
            type: 'PUT',
            data: $(this).serialize(),
            success: function(result) {
                alert('Producto actualizado con éxito');
                window.location.href = '{{ route("products.index") }}';
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value + '\n';
                });
                alert('Error al actualizar el producto:\n' + errorMessage);
            }
        });
    });
});
</script>
@endsection
