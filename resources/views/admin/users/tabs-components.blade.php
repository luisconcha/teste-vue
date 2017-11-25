@php
    $tabs = [
        ['title'=>'Information', 'link'=>route('admin.users.edit',['user'=> $user->id])],
        ['title'=>'Profile', 'link'=>route('admin.users.profile.edit',['user'=> $user->id])],
    ];
@endphp

<h3>Manage users</h3>
<div class="text-right">
    {!! Button::link('Users list')->asLinkTo(route('admin.users.index')) !!}
</div>

{!! Navigation::tabs($tabs) !!}
 
<div>
    {!! $slot !!}
</div>

