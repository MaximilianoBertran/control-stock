<div class="tab-content">
    <div id="pines" class="tab-pane active">
        <br/>
        <div class="table-responsive row">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <th>@lang('Name')</th>
                    <th>@lang('Code')</th>
                    <th>@lang('Stock')</th>
                </thead>
                <tbody>
                    
                    @forelse($products as $tp)
                        <tr>
                            <td>{{ $tp->name }}</td>
                            <td>{{ $tp->code }}</td>
                            <td>{{ $tp->stock }}</td>
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
</div>

<script type="text/javascript">

    function cleanFilters(){
        $('#name').val('');
        $('#code').val('');
    }
    
</script>