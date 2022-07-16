<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed table-custom">
   <thead>
        <th style="width: 10%;" class="text-center">@lang('ID')</th>
        <th>@lang('Username')</th>
        <th>@lang('Name')</th>
        <th>@lang('Lastname')</th>
        @can('view-roles')
            <th style="min-width: 200px;"><span class="pl-3">@lang('Roles')</span></th>
        @endcan
        @can('view-permissions')
            <th style="min-width: 250px;"><span class="pl-3">@lang('Permissions')</span></th>
        @endcan
        <th style='width:10%;'>@lang('Actions')</th>
    </thead>
    <tbody>
        @forelse($admins as $admin)
            <tr>
                <td class="text-center">{{ $admin->id }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->lastname }}</td>
                @can('view-roles')
                    <td>
                        @include('backend.shared.collapsable-list', ['name' => __('Roles'), 'id' => "roles-$admin->id", 'items' => $admin->roles->pluck('display_name')])
                    </td>
                @endcan
                @can('view-permissions')
                    <td>
                        @include('backend.shared.collapsable-list', ['name' => __('Permissions'), 'id' => "permissions-$admin->id", 'items' => $admin->permissions->pluck('display_name')])
                    </td>
                @endcan
                <td class='text-center'>@include('backend.admin.shared.actions', ['admin' => $admin])</td>
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
</div>
<div class="d-flex">
    <div class="mx-auto">
        {!! $admins->appends(Request::except('page'))->render() !!}
    </div>
</div>
