<div class="form-group">
    <label for="{{$data->id}}">{{$data->label}}</label>
    <input type="text" class="form-control datepicker" name="{{$data->name}}" id="{{$data->id}}" placeholder="{{$data->placeholder}}" value="{{$data->value}}">
</div>
@section('custom-inline-content')
    $(document).ready(function() {
        larablend.initDateTimePicker();
    });
@endsection
