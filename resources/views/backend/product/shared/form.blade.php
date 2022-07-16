<div class="form-group row">
	<div class="form-group col-md-4">
		    {!! Form::label('name', __('Name'), array('class' => 'col-md-9 control-label')) !!}
		    <div class="col-md-9">
		        {!! Form::text('name', null, array('class' => 'form-control', 'required' => 'required'))  !!}
		    </div>
	</div>
	<div class="form-group col-md-4">
		    {!! Form::label('code', "Código", array('class' => 'col-md-9 control-label')) !!}
		    <div class="col-md-9">
		        {!! Form::number('code', null, array('class' => 'form-control', 'required' => 'required'))  !!}
		    </div>
	</div>
	<div class="form-group col-md-4">
		{!! Form::label('stock', "Stock", array('class' => 'col-md-9 control-label')) !!}
		<div class="col-md-9">
			{!! Form::number('stock', null, array('class' => 'form-control', 'required' => 'required', 'min' => 0))  !!}
		</div>
	</div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
        <a href="{{ action('Backend\ProductsController@index') }}" class="btn btn-danger" ><span class="fa fa-arrow-left" aria-hidden="true"></span> @lang('Cancel')</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> @lang('Save')</button>
    </div>
</div>