@extends('account.layouts.default')

@section('account.content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Change Your Password
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <form class="form-horizontal" action="{{ route('account.password.store') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                         <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                             <label class="col-md-4 control-label" for="current_password">Current Password: </label>
                             <div class="col-md-6">
                                 <input class="form-control" type="password" id="current_password" name="current_password">
                                 @if ($errors->has('current_password'))
                                     <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                     </span>
                                 @endif
                             </div>
                         </div><!-- /.form-group -->
                        @include('account.layouts._partials._password-form')
                        <input class="btn btn-success" type="submit">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </form>
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
@endsection