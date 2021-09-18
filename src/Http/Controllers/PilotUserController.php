<?php

namespace PEAVEL\Pilot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PEAVEL\Pilot\Facades\Pilot;

class PilotUserController extends PilotBaseController
{
    public function profile(Request $request)
    {
        $route = '';
        $dataType = Pilot::model('DataType')->where('model_name', Auth::guard(app('PilotGuard'))->getProvider()->getModel())->first();
        if (!$dataType && app('PilotGuard') == 'web') {
            $route = route('pilot.users.edit', Auth::user()->getKey());
        } elseif ($dataType) {
            $route = route('pilot.'.$dataType->slug.'.edit', Auth::user()->getKey());
        }

        return Pilot::view('pilot::profile', compact('route'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        if (Auth::user()->getKey() == $id) {
            $request->merge([
                'role_id'                              => Auth::user()->role_id,
                'user_belongstomany_role_relationship' => Auth::user()->roles->pluck('id')->toArray(),
            ]);
        }

        return parent::update($request, $id);
    }
}
