<?php

namespace LACC\Forms;

use Kris\LaravelFormBuilder\Form;

class SubjectForm extends Form
{
    public function buildForm()
    {
        $idSubject = $this->getData('id');

        $this
            ->add('name', 'text', [
                'label' => 'Name',
                'rules' => "required|max:255|unique:subjects,name,{$idSubject}"
            ]);
    }
}
