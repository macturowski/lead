@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Edit price') }}: <strong>{{ $price->name }}</strong> {{__('for product:')}} <strong>{{ $product->name }}</strong></div>
            
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
                    <form method="POST" action="{{ route('prices.update', $price->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ $price->name }}"autocomplete="name" autofocus="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="price" value="{{ $price->price }}" autocomplete="name" autofocus="">
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                        @method('PUT')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection