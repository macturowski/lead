@extends('layouts.app')

@section('content')

<div class="container">
    @if (Session::get('message'))
    <div class="alert alert-success alert-block">  
        {{ Session::get('message') }}
    </div>
    @endif
    {{ __('Sort by name') }} <a href="{{ route('products.index') }}?sort=name" @if ($sort != '-name') style="font-weight: bold" @endif> A-Z</a> | <a href="{{ route('products.index') }}?sort=-name" @if ($sort == '-name') style="font-weight: bold" @endif>Z-A</a>
    <form action="{{ route('products.index') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="filter[name]" placeholder="{{ __('Enter product name...') }}" value="{{ $search }}" />
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">{{ __('Search') }}</button>
        </div>
    </form>
    <div class="d-flex flex-row flex-wrap">
    @foreach ($products as $product)
    @if ($product->image == '') @php $product->image = 'noimage.png' @endphp @endif

        <div class="card" style="width: calc(33.3% - 10px) ;margin: 5px;">
            <img class="card-img-top" src="{{ asset('images') }}/{{ $product->image }}" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>

                @if($product->prices)
                <strong>{{ __('Product options:') }}</strong>
                <div class="mb-3 mt-3">
                    @foreach ($product->prices as $price)
                    <div><strong>{{ $price->name }}:</strong> {{ $price->price }} PLN </div> 
                    @endforeach
                </div>
                @endif
                <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">{{ __('View') }}</a>
                @auth
                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onClick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                </form>      
                @endauth
            </div>
        </div>
    @endforeach
    {{ $products->links() }}
    </div>
</div>
@endsection