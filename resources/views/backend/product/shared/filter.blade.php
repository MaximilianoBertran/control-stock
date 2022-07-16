<div class="well">
    <form id="filtros">   
        <div class="row">
            <div class="form-group col-md-6">  
                {!! Form::label('name', __('Name'), array('class' => 'col-sm-4 control-label', 'style' => 'width:150px;')) !!}
                <div class="col-md-9">
                {!! Form::text('name', $name, array('class' => 'form-control', 'id' => 'nombre'))  !!}
                </div>        
            </div>
            <div class="col-md-6">  
                {!! Form::label('code', __('Code'), array('class' => 'col-sm-4 control-label', 'style' => 'width:150px;')) !!}
                <div class="col-md-9">
                {!! Form::number('code', $code, array('class' => 'form-control', 'id' => 'titulo'))  !!}
                </div>        
            </div>
        </div>
        <br/>
        
        <div style="text-align:right;">
            <br/>
            <button type="submit" class="btn btn-primary">@lang('Search')</button>
            <button type="button" class="btn btn-secondary btn-clean">@lang('Clean')</button> 
        </div>       
    </form>
</div>