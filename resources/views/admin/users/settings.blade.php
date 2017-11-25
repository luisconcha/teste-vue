@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Edit my user profile</h3>
            {!!
                form(
                    $form
                    ->add('insert','submit',[
                        'attr'=> ['class'=>'btn btn-primary btn-block'],
                        'label' => Icon::floppyDisk().' Save'
                    ]
                ))
             !!}
        </div>
    </div>
@endsection