<table class="table table-bordered table-striped table-condensed table-custom">
    <thead>
        <th style="width: 10%;" class="text-center">@lang('ID')</th>
        <th style="width: 25%;">@lang('Name')</th>
        <th>@lang('Display Name')</th>
        <th>@lang('Roles')</th>
        <th>@lang('Users')</th>
    </thead>
    <tbody>
        @forelse($permissions as $permission)
            <tr>
                <td class="text-center">{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->display_name }}</td>
                <td>{{ $permission->roles->count() }}</td>
                <td>{{ $permission->admins->count() }}</td>
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
        {!! $permissions->appends(Request::except('page'))->render() !!}
    </div>
</div>
