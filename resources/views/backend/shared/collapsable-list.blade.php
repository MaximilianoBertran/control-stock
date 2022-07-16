@if($items->count())
    <div class="collapse" id="collapse-{{ $id }}">
        <ul class="list-unstyled list-group-flush">
            @foreach($items AS $item)
                <li class="list-group-item pl-3 bg-transparent">{{ $item }}</li>
            @endforeach
        </ul>
    </div>
    <a id="btn-collapse-{{ $id }}" class="btn-collapse pl-3 collapsed" data-toggle="collapse" href="#collapse-{{ $id }}" role="button" aria-expanded="false" aria-controls="collapse-{{ $id }}">
        <span class="hide">@lang('Hide :name', ['name' => $name])</span>
        <span class="show">@lang('Show :name', ['name' => $name])</span>
    </a>
@else
    <div class="pl-3">
        -
    </div>
@endif