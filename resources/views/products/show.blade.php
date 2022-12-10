@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('View') }}: <strong>{{ $product->name }}</strong></div>
                <div class="row m-3">
                    <div class="col-md-12 mb-3">
                        <h3>{{ $product->name }}</h3>
                    </div>
                    <div class="col-md-6">
                        @if ($product->image == '') @php $product->image = 'noimage.png' @endphp @endif
                        <img class="card-img-top" src="{{ asset('images') }}/{{ $product->image }}" alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-6">
                        {{ $product->description }}
                    </div>
                    <div class="col-md-2 mb-3 mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection