<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">@lang('Username')</label>
    <div class="col-md-6">
        {!! Form::text('username', null, array('class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''), 'required' => 'required', 'autocomplete' => 'username', 'autofocus' => 'autofocus')) !!}
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name')</label>
    <div class="col-md-6">
        {!! Form::text('name', null, array('class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'required' => 'required', 'autocomplete' => 'name', 'autofocus' => 'autofocus')) !!}
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="lastname" class="col-md-4 col-form-label text-md-right">@lang('Lastname')</label>
    <div class="col-md-6">
        {!! Form::text('lastname', null, array('class' => 'form-control' . ($errors->has('lastname') ? ' is-invalid' : ''), 'required' => 'required', 'autocomplete' => 'lastname', 'autofocus' => 'autofocus')) !!}
        @error('lastname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address')</label>
    <div class="col-md-6">
        {!! Form::email('email', null, array('class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required' => false, 'autocomplete' => 'email')) !!}
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>
    <div class="col-md-6">
        {!! Form::password('password', array('class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'required' => !isset($admin), 'autocomplete' => 'new-password')) !!}
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">@lang('Confirm Password')</label>
    <div class="col-md-6">
        {!! Form::password('password_confirmation', array('class' => 'form-control', 'required' => !isset($admin), 'autocomplete' => 'new-password')) !!}
    </div>
</div>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-outline-primary">
            @lang('Send')
        </button>
    </div>
</div>
