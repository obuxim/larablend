<div class="form-group">
    <div class="">
        <select class="selectpicker" data-size="3" data-style="btn btn-primary btn-round" title="{{$data->label}}" name="{{$data->name}}" data-live-search="true" data-width="50%" data-actions-box="true">
            @foreach($data->all as $option)
                <option value="{{$option->id}}" @if($option->id == $data->value) selected @endif>
                    @if($option->name)
                        {{$option->name}}
                    @elseif($option->title)
                        {{$option->title}}
                    @elseif($option->first_name)
                        {{$option->first_name.' '.$option->last_name}}
                    @else
                        {{$option->id}}
                    @endif
                </option>
            @endforeach
        </select>
        @if(str_contains($data->id, '_id'))
            <button type="button" class="btn btn-default m-0" data-toggle="modal" data-target="#{{$data->id}}_modal"><i class="nc-icon nc-simple-add"></i></button>
            @section('modals')
                <div class="modal fade" id="{{$data->id}}_modal" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Create {{ucfirst(substr($data->id, 0, -3))}}</h3>
                        </div>
                        <div class="modal-body">
                            @include('larablend::components.form', ['data' => $data->form])
                        </div>
                    </div>
                </div>
            </div>
            @endsection
        @endif
    </div>
</div>
