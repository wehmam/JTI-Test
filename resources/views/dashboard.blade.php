@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card w-75 d-flex justify-center m-auto">
            <div class="card-body">
                <h5 class="card-title">INPUT</h5>
                <a target="_blank" href="{{ url('input') }}" class="btn btn-primary">GO</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card w-75 d-flex justify-center m-auto">
            <div class="card-body">
                <h5 class="card-title">Output</h5>
                <a target="_blank" href="{{ url('output') }}" class="btn btn-primary">GO</a>
            </div>
        </div>
    </div>
</div>
@endsection
