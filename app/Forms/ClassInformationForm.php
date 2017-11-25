<?php

namespace LACC\Forms;

use Carbon\Carbon;
use Kris\LaravelFormBuilder\Form;

class ClassInformationForm extends Form
{
    public function buildForm()
    {
        $formatDate = function ($value) {
            return ($value && $value instanceof Carbon) ? $value->format('Y-m-d') : $value;
        };

        $this
            ->add('date_start', 'date', [
                'label' => 'Start date',
                'rules' => 'required|date',
                'value' => $formatDate
            ])
            ->add('date_end', 'date', [
                'label' => 'Final date',
                'rules' => 'required|date',
                'value' => $formatDate
            ])
            ->add('cycle', 'number', [
                'label' => 'Cycle',
                'rules' => 'required|integer'
            ])
            ->add('subdivision', 'number', [
                'label' => 'Subdivision',
                'rules' => 'integer'
            ])
            ->add('semester', 'number', [
                'label' => 'Half (1 or 2)',
                'rules' => 'required|in:1,2'
            ])
            ->add('year', 'number', [
                'label' => 'Year',
                'rules' => 'required|integer'
            ]);
    }
}
