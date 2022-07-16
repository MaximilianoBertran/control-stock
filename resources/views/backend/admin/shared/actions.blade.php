@canany(['edit-admins', 'delete-admins'])
    <div class="dropdown">
        <a class="btn btn-outline-primary dropdown-toggle px-2" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-list"></i>
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" role="menu">
            @can('edit-admins')
                <a class="dropdown-item" href="{{ route('backend.admin.edit', ['id' => $admin->id]) }}"  data-toggle="tooltip" data-placement="bottom" title="{{ __('Edit :name', ['name' => $admin->username]) }}">
                    <i class="fas fa-fw fa-edit"></i> @lang('Edit')
                </a>
            @endcan
            @if($admin->id !== Auth::user()->id)
                @can('delete-admins')
                    <a class="dropdown-item btn-delete" data-name="{{ $admin->username }}" data-target="#destroy-form-{{ $admin->id }}" href="{{ route('backend.admin.destroy', $admin->id) }}" title="{{ __('Delete :name', ['name' => $admin->username]) }}">
                        <i class="fas fa-fw fa-eraser"></i> @lang('Delete')
                    </a>
                    <form id="destroy-form-{{ $admin->id }}" method="POST" action="{{ route('backend.admin.destroy', $admin->id) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                @endcan
            @endif
        </div>
    </div>
@endcan