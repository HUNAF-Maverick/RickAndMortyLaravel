@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Főoldal') }}</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('syncEpisodes') }}">{{ __('Start episode sync') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
