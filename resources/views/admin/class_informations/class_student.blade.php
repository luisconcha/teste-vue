@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Classroom administration</h3>
        </div>

        <class-student class-information="{{$class_information->id}}"></class-student>

    </div>
@endsection