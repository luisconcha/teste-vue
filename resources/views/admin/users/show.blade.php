@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>View User: <b>{!! $user->name !!}</b></h3>
            @php
                $linkEdit = route('admin.users.edit',['user'=> $user->id]);
                $linkDelete = route('admin.users.destroy',['user'=>$user->id]);
                $linkListUsers = route('admin.users.index');
            @endphp
            {!! Button::primary(Icon::pencil())->asLinkTo($linkEdit) !!}
            {!!
            Button::danger(Icon::trash())->asLinkTo($linkDelete)
            ->addAttributes([
            'onClick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"
            ])
            !!}
            {!! Button::warning(Icon::arrowLeft().' return to the list')->asLinkTo($linkListUsers) !!}

            @php
                $formDelete = FormBuilder::plain([
                   'id'=>'form-delete',
                   'url'=> $linkDelete,
                   'method'=>'DELETE',
                   'style'=>'display:none'
                ]);
            @endphp

            {!! form($formDelete) !!}
            <br><br>


            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th scope="row">ID</th>
                    <td>{{$user->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <th scope="row">E-mail</th>
                    <td>{{$user->email}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection