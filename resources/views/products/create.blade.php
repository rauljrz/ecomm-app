@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Producto</h1>
    <form id="create-product-form">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Producto</button>
    </form>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#create-product-form').on('submit', function(e) {
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
            url: '{{ route("products.store") }}',
            type: 'POST',
            data: $(this).serialize(),
            success: function(result) {
                alert('Producto creado con éxito');
                window.location.href = '{{ route("products.store") }}';
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                $.each(errors, function(key, value) {
                    errorMessage += value + '\n';
                });
                alert('Error al crear el producto:\n' + errorMessage);
            }
        });
    });
});
</script>
@endsection
