@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>View Class: <b>{!! $subject->id !!}</b></h3>
            @php
                $linkEdit = route('admin.subjects.edit',['subjects'=> $subject->id]);
                $linkDelete = route('admin.subjects.destroy',['subjects'=>$subject->id]);
                $linkListClass = route('admin.subjects.index');
            @endphp
            {!! Button::primary(Icon::pencil())->asLinkTo($linkEdit) !!}
            {!!
            Button::danger(Icon::trash())->asLinkTo($linkDelete)
            ->addAttributes([
            'onClick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"
            ])
            !!}
            {!! Button::warning(Icon::arrowLeft().' return to the list')->asLinkTo($linkListClass) !!}

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
                    <td>{{$subject->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{$subject->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection