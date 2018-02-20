@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('account.layouts._partials._nav')
        </div><!-- /.col -->
        <div class="col-md-9">
            @yield('account.content')
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection