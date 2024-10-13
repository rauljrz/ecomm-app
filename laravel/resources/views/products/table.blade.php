@foreach($products as $product)
<tr>
    <td>{{ $product['id'] }}</td>
    <td>{{ $product['title'] }}</td>
    <td>${{ number_format($product['price'], 2) }}</td>
    <td>{{ $product['created_at'] }}</td>
    <td>
    @if(!auth()->user()->hasRole('viewer'))
        <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-sm btn-info">Editar</a>
        <button class="btn btn-sm btn-danger delete-product" data-id="{{ $product['id'] }}">Eliminar</button>
    @endif
    </td>
</tr>
@endforeach