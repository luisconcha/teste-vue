<?php

namespace LACC\Forms;

use Kris\LaravelFormBuilder\Form;
use LACC\Models\User;

class UserForm extends Form
{
    public function buildForm()
    {
        $idUser = $this->getData('id');

        $this
            ->add('name', 'text', [
                'label' => 'Name:',
                'rules' => 'required|max:255'
            ])
            ->add('email', 'email', [
                'label' => 'Email:',
                'rules' => "required|unique:users,email,{$idUser}"
            ])
            ->add('type', 'select', [
                'label' => 'User type',
                'choices' => $this->roles(),
                'rules' => 'required|in:' . implode(',', array_keys($this->roles()))
            ])
            ->add('send_mail', 'checkbox', [
                'label' => 'Send email welcome?',
                'values' => true,
                'checked' => false
            ]);
    }

    protected function roles()
    {
        return [
            User::ROLE_ADMIN => 'Administrator',
            User::ROLE_TEACHER => 'Teacher',
            User::ROLE_STUDENT => 'Student',
        ];
    }
}
