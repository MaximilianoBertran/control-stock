<div class="card bg-light mb-4">
    <div class="card-body">
        {!! Form::open(array('id' => 'form-search', 'method' => 'GET', 'class' => 'form-horizontal col-lg-10 offset-lg-1')) !!}
            <div class="form-row">
                <div class="col-sm-6 form-group">
                    {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => __('Name'))) !!}
                </div>
                <div class="col-sm-6 form-group">
                    
                </div>
                <div class="col-sm-6 form-group">
                    {!! Form::text('display_name', null, array('class' => 'form-control', 'placeholder' => __('Display Name'))) !!}
                </div>
            </div>
            <hr/>
            <div class="text-right">
                <button type="submit" class="btn btn-outline-primary">@lang('Search')</button>
                <button type="button" class="btn btn-outline-secondary btn-clean">@lang('Clean')</button>        
            </div>
        {!! Form::close() !!}
    </div>
</div>
