
<table id="" class="table table-striped table-bordered datatable custom-datatable" cellspacing="0" width="100%">
    <thead class="text-capitalize font-weight-bold">
    <tr>
        @foreach($data->entry_keys as $key)
            <td>{{str_replace('_', ' ', $key)}}</td>
        @endforeach
        @if($data->action)<td class="disabled-sorting text-right">Actions</td>@endif
    </tr>
    </thead>
    <tbody>
    @foreach($data->data as $entry)
    <tr>
        @foreach($data->entry_keys as $key)
            <td>
                @if(isset($entry->$key->title))
                    {{$entry->$key->title}}
                @elseif(isset($entry->$key->name))
                    {{isset($entry->$key->name)}}
                @elseif(isset($entry->$key->first_name))
                    {{$entry->$key->first_name . ' ' . $entry->$key->last_name}}
                @else
                    {{$entry->$key}}
                @endif
            </td>
        @endforeach
        @if($data->action)
        <td class="text-right">
            <a href="/{{$data->route}}/edit/{{$entry->id}}" class="btn btn-warning btn-link btn-icon btn-sm edit"><i class="fa fa-edit"></i></a>
            <a href="/{{$data->route}}/delete/{{$entry->id}}" class="btn btn-danger btn-link btn-icon btn-sm remove"><i class="fa fa-times"></i></a>
        </td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
