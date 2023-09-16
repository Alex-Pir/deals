<?php

namespace App\Http\Controllers;

use App\Http\Requests\B24InstallRequest;
use Domain\B24\Actions\CreateEnvironmentAction;
use Illuminate\Http\RedirectResponse;

class B24Controller extends Controller
{
    public function install(B24InstallRequest $request, CreateEnvironmentAction $action): RedirectResponse
    {
        $action->execute(
            $request->createDTO()
        );

        return redirect()->route('home');
    }
}
