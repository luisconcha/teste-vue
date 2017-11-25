@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>List Subjects</h3>
            {!! Button::primary('New class')->asLinkTo(route('admin.subjects.create'))!!}
        </div>

        <div class="row">
            {!!
             Table::withContents($subjects->items())
                ->striped()
                ->callback('Actions', function($fields, $model){
                    $linkEdit = route('admin.subjects.edit',['subjects'=> $model->id]);
                    $linkShow = route('admin.subjects.show',['subjects'=> $model->id]);

                    return Button::link(Icon::edit().' Edit')->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::eyeOpen().' View')->asLinkTo($linkShow);
                })
            !!}
        </div>

        {!! $subjects->links() !!}
    </div>
@endsection