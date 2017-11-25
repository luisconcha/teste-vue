<?php

namespace LACC\Http\Controllers\Admin;

use Kris\LaravelFormBuilder\Form;
use Illuminate\Http\Request;
use LACC\Forms\UserSettingsForm;
use LACC\Http\Controllers\Controller;

class UserSettingsController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.users.settings.update'),
            'method' => 'PUT'
        ]);

        return view('admin.users.settings', compact('form'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $data['password'] = bcrypt($data['password']);
        \Auth::user()->update($data);
        $request->session()->flash('message', 'Password change successfully');

        return redirect()->route('admin.users.settings.edit');
    }
}
