<?php

namespace LACC\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LACC\Forms\ClassInformationForm;
use LACC\Http\Controllers\Controller;
use LACC\Models\ClassInformation;

class ClassInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_informations = ClassInformation::paginate(15);

        return view('admin.class_informations.index', compact('class_informations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(ClassInformationForm::class, [
            'url' => route('admin.class_informations.store'),
            'method' => 'POST'
        ]);

        return view('admin.class_informations.create', compact('form'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(ClassInformationForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        ClassInformation::create($data);

        $request->session()->flash('message', 'Class successfully registered');

        return redirect()->route('admin.class_informations.index');
    }

    /**
     * @param ClassInformation $classInformation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ClassInformation $classInformation)
    {
        return view('admin.class_informations.show', compact('subject'));
    }

    /**
     * @param ClassInformation $classInformation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ClassInformation $classInformation)
    {
        $form = \FormBuilder::create(ClassInformationForm::class, [
            'url' => route('admin.class_informations.update', ['user' => $classInformation->id]),
            'method' => 'PUT',
            'model' => $classInformation
        ]);

        return view('admin.class_informations.edit', compact('form'));
    }

    /**
     * @param ClassInformation $classInformation
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(ClassInformation $classInformation)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(ClassInformationForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $classInformation->update($data);
        session()->flash('message', 'Class successfully changed');
        return redirect()->route('admin.class_informations.index');
    }

    /**
     * @param ClassInformation $classInformation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ClassInformation $classInformation)
    {
        $classInformation->delete();
        session()->flash('message', 'Class deleted successfully');
        return redirect()->route('admin.class_informations.index');
    }
}
