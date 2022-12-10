@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="alert alert-success alert-block"> 
       
        {{ __('Welcome to test page!') }}<br />
        {{ __('Go to') }} <a href="{{ route('products.index') }}" style="font-weight: bold">{{ __('products list') }}</a> @guest{{ __('or')}} <a href="{{ route('profile.update') }}" style="font-weight: bold">{{ __('log in')}}</a>@endguest to manage them. 
        </div>
            
        </div>
    </div>
</div>
@endsection
