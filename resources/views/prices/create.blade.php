@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Add price') }} {{__('for product:')}} <strong>{{ $product->name }}</strong></div>
            
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
                    <form method="POST" action="{{ route('prices.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}"autocomplete="name" autofocus="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="price" value="{{ old('price') }}" autocomplete="name" autofocus="">
                            </div>
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                        <input id="name" type="hidden" class="form-control " name="product_id" value="{{ $product->id }}" autocomplete="name" autofocus="">
                        @method('POST')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection