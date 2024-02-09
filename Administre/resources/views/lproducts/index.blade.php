@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Produtos</h2>
    <div class="row">
        @foreach ($products as $index => $product)
            <div class="col-3">
                <div class="card me-1" style="">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Alguma descrição</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Marca: {{ $product->brand }}</li>
                        <li class="list-group-item">Tamanho: {{ $product->size }}</li>
                        <li class="list-group-item">Preço: {{ $product->price }}</li>
                    </ul>
                    <div class="card-body">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                        </form>
                        <a href="{{ route('lproducts.show', $product->id) }}" class="btn btn-primary">Visualizar</a>
                    </div>
                </div>
            </div>
            @if (($index + 1) % 4 == 0)
                </div><div class="row">
            @endif
        @endforeach
    </div>
</div>
@endsection
