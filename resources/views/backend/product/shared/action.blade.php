@canany(['view-admins'])
    <div class="dropdown">
        <a class="btn btn-outline-primary dropdown-toggle px-2" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-list"></i>
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" role="menu">
            @can('view-admins')
                <a class="dropdown-item" href="{{ route('backend.product.edit', ['id' => $product->id]) }}"  data-toggle="tooltip" data-placement="bottom" title="@lang('Edit')">
                    <i class="fas fa-fw fa-edit"></i> @lang('Edit')
                </a>
            @endcan
            @can('view-admins')
                <a class="dropdown-item btn-delete" data-name="{{ $product->name }}" data-target="#destroy-form-{{ $product->id }}" href="{{ route('backend.product.destroy', $product->id) }}" title="{{ __('Delete :name', ['name' => $product->name]) }}">
                    <i class="fas fa-fw fa-eraser"></i> @lang('Delete')
                </a>
                <form id="destroy-form-{{ $product->id }}" method="POST" action="{{ route('backend.product.destroy', $product->id) }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endcan
        </div>
    </div>
@endcanany