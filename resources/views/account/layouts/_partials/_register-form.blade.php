<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
    <label for="first_name" class="col-md-4 control-label">First Name</label>

    <div class="col-md-6">
        <input id="first_name"
               type="text"
               class="form-control"
               name="first_name"
               value="{{ old('first_name', optional(Auth::user())->first_name) }}" required autofocus>

        @if ($errors->has('first_name'))
            <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
    <label for="last_name" class="col-md-4 control-label">Last Name</label>

    <div class="col-md-6">
        <input id="last_name"
               type="text"
               class="form-control"
               name="last_name"
               value="{{ old('last_name', optional(Auth::user())->last_name) }}" required autofocus>

        @if ($errors->has('last_name'))
            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <label for="username" class="col-md-4 control-label">Username</label>

    <div class="col-md-6">
        <input id="username"
               type="text"
               class="form-control"
               name="username"
               value="{{ old('username', optional(Auth::user())->username) }}" required autofocus>

        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
        <input id="email"
               type="email"
               class="form-control"
               name="email"
               value="{{ old('email',optional(Auth::user())->email) }}"
               required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>