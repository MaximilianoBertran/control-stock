<div class="table-responsive">
<table class="table table-bordered table-striped table-condensed table-custom">
    <thead>
        <th style="width: 10%;" class="text-center">@lang('ID')</th>
        <th style="width: 20%;">@lang('Display Name')</th>
        <th>@lang('Description')</th>
        <th style="width: 30%; min-width: 150px;"><span class="pl-3">@lang('Permissions')</span></th>
        <th style="width:10%;">@lang('Actions')</th>
    </thead>
    <tbody>
        @forelse($roles as $role)
            <tr>
                <td class="text-center">{{ $role->id }}</td>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->description }}</td>
                <td>
                    @include('backend.shared.collapsable-list', ['name' => __('Permissions'), 'id' => "permissions-$role->id", 'items' => $role->permissions->pluck('display_name')])
                </td>
                <td class="text-center">
                    @include('backend.role.shared.actions', ['role' => $role])
                </td>
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
        {!! $roles->appends(Request::except('page'))->render() !!}
    </div>
</div>
