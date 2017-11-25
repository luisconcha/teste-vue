<?php

namespace LACC\Http\Controllers\Admin;

use Kris\LaravelFormBuilder\Form;
use LACC\Forms\UserProfileForm;
use LACC\Http\Controllers\Controller;
use LACC\Models\User;

class UserProfileController extends Controller
{


    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserProfileForm::class, [
            'url' => route('admin.users.profile.update', ['id' => $user->id]),
            'method' => 'PUT',
            'model' => $user->profile,
            'data' => ['user' => $user]
        ]);

        return view('admin.users.profile.edit', compact('form'));
    }

    /**
     * @param User $user
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(User $user)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserProfileForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $user->profile->address ? $user->profile->update($data) : $user->profile()->create($data);

        session()->flash('message', 'Profile change successfully');

        return redirect()->route('admin.users.profile.update', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
