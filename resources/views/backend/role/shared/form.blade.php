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
    <label for="display_name" class="col-md-4 col-form-label text-md-right">@lang('Display Name')</label>
    <div class="col-md-6">
        {!! Form::text('display_name', null, array('class' => 'form-control' . ($errors->has('display_name') ? ' is-invalid' : ''), 'required' => 'required', 'autocomplete' => 'display_name', 'autofocus' => 'autofocus')) !!}
        @error('display_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">@lang('Description')</label>
    <div class="col-md-6">
        {!! Form::text('description', null, array('class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'required' => 'required', 'autocomplete' => 'description', 'autofocus' => 'autofocus')) !!}
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('Permissions')</label>
    <div class="col-md-6">
        {!! Form::select('perms[]', $permissions, isset($permissionsSelected) ? $permissionsSelected : null, array('class' => 'custom-select select2-select', 'id' => 'perms', 'multiple' => 'multiple')) !!}
        @error('perms')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-outline-primary">
            @lang('Send')
        </button>
    </div>
</div>
