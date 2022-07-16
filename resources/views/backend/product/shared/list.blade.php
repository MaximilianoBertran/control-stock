<div class="tab-content">
    <div id="pines" class="tab-pane active">
        <br/>
        <div style="text-align: left">
            @canany(['view-clients'])
                <a href="#" class="btn btn-success fa fa-print" title="Exportar datos a XLS"> XLS</a>
                <a href="{{ action('Backend\ProductsController@create') }}" class="btn btn-primary fa fa-plus" title=""> Añadir Producto</a>
            @endcanany
        </div>
        <br/>
        <div class="table-responsive row">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <th>@lang('Name')</th>
                    <th>@lang('Code')</th>
                    <th>@lang('Stock')</th>
                    @canany(['view-admins'])
                        <th>@lang('Actions')</th>
                    @endcanany
                </thead>
                <tbody>
                    
                    @forelse($products as $tp)
                        <tr>
                            <td>{{ $tp->name }}</td>
                            <td>{{ $tp->code }}</td>
                            <td>{{ $tp->stock }}</td>
                            @canany(['view-admins'])
                                <td>@include('backend.product.shared.action', array('product' => $tp))</td>
                            @endcanany

                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">
                                @lang('No results found')
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
            <div class="d-flex">
                <div class="mx-auto">
                    {!! $products->appends(Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Solicitar siempre confirmación -->
    <div class="modal fade" id="confirmarEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('Confirmation')</h4>
                </div>
                <div class="modal-body">
                    <h3 id='lblEliminar'></h3>
                    @lang('Once deleted, your data will not be displayed in the system')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Cancel')</button>
                    <button type="button" class="btn btn-primary" id="butConfirmarEliminar">@lang('Accept')</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $( document ).ready(function() {
        var eliminarForm;
        
        $('.frmEliminar').unbind().click(function(){
            
            var descripcion = $(this).attr('data-punto-nombre');
            
            eliminarForm = $(this).parent();
            
            $('#lblEliminar').html('¿Confirma que desea eliminar ' + descripcion + '?');
            $('#confirmarEliminar').modal('show');
            
        });
        
        $('#butConfirmarEliminar').click(function(){
            eliminarForm.submit();
        });
    });

    function cleanFilters(){
        $('#name').val('');
        $('#code').val('');
    }
    
</script>