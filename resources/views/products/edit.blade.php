@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::get('message'))
    <div class="alert alert-success alert-block">  
        {{ Session::get('message') }}
    </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Edit product') }}: <strong>{{ $product->name }}</strong></div>
            
                <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ $product->name }}"autocomplete="name" autofocus="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="description" value="{{ $product->description }}" autocomplete="name" autofocus="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="file" class="form-control " name="image" value="" autocomplete="name" autofocus="">
                                @if ($product->image)
                                <div class="row mt-3">
                                    <img src="{{ URL::to('/') }}/images/{{ $product->image }}" width="200" />
                                </div>
                                <input type="checkbox" name="deleteimage" value="1" /> {{ __('Delete image') }}
                                @endif
                            </div>
                        </div>         
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                {{ __('Edit product data') }}
                                </button>
                            </div>
                        </div>
                        @method('PUT')

                    </form>
                    <hr />
                    <div class="row mb-3">
                        <div class="col-md-4 col-form-label text-md-end">{{ __('Prices') }}</div>
                        <div class="col-md-6">
                        @if($product->prices)
                        <div class="mb-3 mt-3">
                            @foreach ($product->prices as $price)
                            <div><strong>{{ $price->name }}:</strong> {{ $price->price }} PLN </div> 
                            <form action="{{ route('prices.destroy', $price) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onClick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete price') }}</button>
                                <a href="{{ route('prices.edit', $price) }}" class="btn btn-primary">{{ __('Edit price') }}</a>
                            </form>      
                            @endforeach
                        </div>
                        @endif
                        <a href="{{ route('prices.create', $product->id) }}" class="btn btn-secondary">{{ __('Add new price for product') }}</a>
                        </div>
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection