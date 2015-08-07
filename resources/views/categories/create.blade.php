@extends('welcome')

@section('content')

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    {!! Form::open(array('url' => 'api/categories/', 'class' => 'form')) !!}

    <div class="form-group">
        {!! Form::label('Category') !!}
        {!! Form::text('name', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Category name')) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit!',
          array('class'=>'btn btn-primary')) !!}
    </div>
    {!! Form::close() !!}
@endsection