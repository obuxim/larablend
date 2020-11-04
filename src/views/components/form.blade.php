
@if(isset($data))
    <form action="{{$data->action}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($data->inputs) && count($data->inputs) > 0)
            @foreach($data->inputs as $input)
                @include('larablend::components.inputs.'.$input->type, ['data' => $input])
            @endforeach
        @endif
        @yield('inject-inputs')
        <div class="form-group">
            <button class="btn btn-primary form-submit" type="submit">Save</button>
        </div>
    </form>
@endif
