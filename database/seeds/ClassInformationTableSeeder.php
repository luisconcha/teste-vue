<?php

use Illuminate\Database\Seeder;
use LACC\Models\ClassInformation;

class ClassInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = \LACC\Models\Student::all();
        
        factory(ClassInformation::class, 50)
            ->create()
            ->each(function (ClassInformation $model) use ($students) {
                /** @var \Illuminate\Support\Collection $studentsCollection */
                $studentsCollection = $students->random(10);
                $model->students()->attach($studentsCollection->pluck('id'));
            });
    }
}
