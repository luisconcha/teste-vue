<?php

namespace LACC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LACC\Forms\SubjectForm;
use LACC\Http\Controllers\Controller;
use LACC\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(15);

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(SubjectForm::class, [
            'url' => route('admin.subjects.store'),
            'method' => 'POST'
        ]);

        return view('admin.subjects.create', compact('form'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SubjectForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        Subject::create($data);

        $request->session()->flash('message', 'Discipline successfully registered');

        return redirect()->route('admin.subjects.index');
    }

    /**
     * @param Subject $subject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * @param Subject $subject
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Subject $subject)
    {
        $form = \FormBuilder::create(SubjectForm::class, [
            'url' => route('admin.subjects.update', ['user' => $subject->id]),
            'method' => 'PUT',
            'model' => $subject
        ]);

        return view('admin.subjects.edit', compact('form'));
    }

    /**
     * @param Subject $subject
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Subject $subject)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(SubjectForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $subject->update($data);
        session()->flash('message', 'Discipline successfully changed');
        return redirect()->route('admin.subjects.index');
    }

    /**
     * @param Subject $subject
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        session()->flash('message', 'Discipline deleted successfully');
        return redirect()->route('admin.subjects.index');
    }
}
