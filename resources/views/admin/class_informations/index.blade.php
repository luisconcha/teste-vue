@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>List Class</h3>
            {!! Button::primary('New class')->asLinkTo(route('admin.class_informations.create'))!!}
        </div>

        <div class="row">
            {!!
             Table::withContents($class_informations->items())
                ->striped()
                ->callback('Actions', function($fields, $model){
                    $linkEdit = route('admin.class_informations.edit',['class_informations'=> $model->id]);
                    $linkShow = route('admin.class_informations.show',['class_informations'=> $model->id]);
                    $linkStudents = route('admin.class_informations.students.index',['class_informations'=> $model->id]);

                    return Button::link(Icon::edit().' Edit')->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::eyeOpen().' View')->asLinkTo($linkShow).'|'.
                            Button::link(Icon::home().' home')->asLinkTo($linkStudents);
                })
            !!}
        </div>

        {!! $class_informations->links() !!}
    </div>
@endsection