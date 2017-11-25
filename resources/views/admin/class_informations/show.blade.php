@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>View Class: <b>{!! $class_infromations->id !!}</b></h3>
            @php
                $linkEdit = route('admin.class_informations.edit',['class_informations'=> $class_infromations->id]);
                $linkDelete = route('admin.class_informations.destroy',['class_informations'=>$class_infromations->id]);
                $linkListClass = route('admin.class_informations.index');
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
                    <td>{{$class_infromations->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Start date</th>
                    <td>{{$class_infromations->date_start->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <th scope="row">Final date</th>
                    <td>{{$class_infromations->date_end->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <th scope="row">Cycle</th>
                    <td>{{$class_infromations->cycle}}</td>
                </tr>
                <tr>
                    <th scope="row">Subdivision</th>
                    <td>{{$class_infromations->subdivision}}</td>
                </tr>
                <tr>
                    <th scope="row">Year</th>
                    <td>{{$class_infromations->year}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection