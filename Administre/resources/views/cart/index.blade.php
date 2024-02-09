@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Carrinho de Compras</h2>

    @if ($cart)
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->price }}</td>
                        <td>
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" onchange="updateQuantity( {{$item->id}} , this.value)">
                        </td>
                        <td>{{ $item->product->price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <h4>Total: {{ $cart->totalPrice }}</h4>
            <a href="{{ route('cart.confirm') }}" class="btn btn-primary">Confirmar Pedido</a>
        </div>
    @else
        <p>O seu carrinho está vazio.</p>
    @endif
</div>
<script>
function updateQuantity(itemId, newQuantity) {
    // Enviar solicitação AJAX para atualizar a quantidade
    $.ajax({
        url: '/cart/' + itemId,
        type: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            quantity: newQuantity
        },
        success: function(response) {
            // Atualizar a página ou fazer outras ações necessárias
            window.location.reload();
        },
        error: function(xhr) {
            // Lidar com erros, se necessário
            console.error(xhr.responseText);
        }
    });
}
</script>
@endsection