@canany(['edit-roles', 'delete-roles'])
    <div class="dropdown">
        <a class="btn btn-outline-primary dropdown-toggle px-2" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-list"></i>
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" role="menu">
            @can('edit-roles')
                <a class="dropdown-item" href="{{ route('backend.role.edit', ['id' => $role->id]) }}" data-toggle="tooltip" data-placement="bottom" title="@lang('Edit :name', ['name' => $role->display_name])">
                    <i class="fas fa-fw fa-edit"></i> @lang('Edit')
                </a>
            @endcan
            @if(!$role->admins_count)
                @can('delete-roles')
                    <a class="dropdown-item" data-target="#destroy-form-{{ $role->id }}" href="{{ route('backend.role.destroy', $role->id) }}" title="{{ __('Delete :name', ['name' => $role->display_name]) }}"
                       onclick="event.preventDefault(); $($(this).data('target')).submit();"
                    >
                        <i class="fas fa-fw fa-eraser"></i> @lang('Delete')
                    </a>
                    <form id="destroy-form-{{ $role->id }}" method="POST" action="{{ route('backend.role.destroy', $role->id) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endcan
            @endif
        </div>
    </div>
@endcanany
