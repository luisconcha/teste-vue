@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3>Edit class</h3>
                {!!
                    form($form->add('edit','submit', [
                        'attr'=> ['class'=>'btn btn-primary btn-block'],
                         'label' => Icon::edit().' Edit'
                    ]))
                 !!}
            </div>

        </div>
    </div>
@endsection