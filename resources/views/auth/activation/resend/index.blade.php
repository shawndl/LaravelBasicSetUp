@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Resend Activation Email
                </div><!-- /.panel-heading -->
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('activation.resend.store') }}" method="post">
                        {{ csrf_field() }}
                         <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                             <label for="email" class="control-label col-md-4">Email: </label>
                             <div class="col-md-6">
                                 <input class="form-control" id="email" type="email" name="email" value = {{ old('email') }}>
                                 @if ($errors->has('email'))
                                     <span class="help-block">
                                     <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                                 @endif
                             </div><!-- /.col -->
                         </div><!-- /.form-group -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div><!-- /.col -->
                        </div><!-- /.form-group -->
                    </form>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection