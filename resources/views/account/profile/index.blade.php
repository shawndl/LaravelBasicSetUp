@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Your Profile
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('account.profile.store') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @include('account.layouts._partials._register-form')
                        <input class="btn btn-success" type="submit">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </form>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
@endsection