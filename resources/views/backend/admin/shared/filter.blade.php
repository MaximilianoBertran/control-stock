<div class="card bg-light mb-4">
    <div class="card-body">
        {!! Form::open(array('id' => 'form-search', 'method' => 'GET', 'class' => 'form-horizontal col-xl-10 offset-xl-1')) !!}
            <div class="form-row">
                <div class="col-sm-6 form-group">
                    {!! Form::text('username', null, array('class' => 'form-control', 'placeholder' => __('Username'))) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::select('permission_id', $permissions, null, array('class' => 'custom-select select2-select', 'placeholder' => __('All :name', ['name' => __('Permissions')]))) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => __('Name'))) !!}
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::text('lastname', null, array('class' => 'form-control', 'placeholder' => __('Lastname'))) !!}
                </div>
            </div>
            <hr/>
            <div class="text-right">
                @can('create-admins')
                    <a href="{{ route('backend.admin.create') }}" class="btn btn-outline-success"><span class="fas fa-fw fa-plus" aria-hidden="true"></span> @lang('Add')</a>
                @endcan
                <button type="submit" class="btn btn-outline-primary">@lang('Search')</button>
                <button type="button" class="btn btn-outline-secondary btn-clean">@lang('Clean')</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>