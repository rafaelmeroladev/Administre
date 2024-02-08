@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Visualizar Produto</h1>
    <div class="card">
        <div class="card-header">
            Produto #{{ $product->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text"><strong>Tamanho:</strong> {{ $product->size }}</p>
            <p class="card-text"><strong>Marca:</strong> {{ $product->brand }}</p>
            <p class="card-text"><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Voltar para a lista</a>
        </div>
    </div>
</div>
@endsection