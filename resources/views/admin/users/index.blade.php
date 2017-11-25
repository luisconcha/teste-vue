@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>List User</h3>
            {!! Button::primary('New User')->asLinkTo(route('admin.users.create'))!!}
        </div>

        <div class="row">
            {!!
             Table::withContents($users->items())
                ->striped()
                ->callback('Actions', function($fields, $model){
                    $linkEdit = route('admin.users.edit',['user'=> $model->id]);
                    $linkShow = route('admin.users.show',['user'=> $model->id]);

                    return Button::link(Icon::edit().' Edit')->asLinkTo($linkEdit).'|'.
                            Button::link(Icon::eyeOpen().' View')->asLinkTo($linkShow);
                })
            !!}
        </div>

        {!! $users->links() !!}
    </div>
@endsection