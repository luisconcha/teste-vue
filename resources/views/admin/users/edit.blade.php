@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            @component('admin.users.tabs-components',['user'=>$form->getModel()])
                <div class="col-md-12">
                    <h3>Edit User</h3>
                    {!!
                        form($form->add('edit','submit', [
                            'attr'=> ['class'=>'btn btn-primary btn-block'],
                             'label' => Icon::edit().' Edit'
                        ]))
                     !!}
                </div>
            @endcomponent
        </div>
    </div>
@endsection