<?php

namespace App\Http\Controllers;

use App\Http\Requests\B24InstallRequest;
use Domain\B24\Actions\CreateEnvironmentAction;
use Domain\B24\Exceptions\InstallException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class B24Controller extends Controller
{
    /**
     * @throws InstallException
     */
    public function install(B24InstallRequest $request, CreateEnvironmentAction $action): View|Factory|Application
    {
        $action->execute(
            $request->createDTO()
        );

        return view('install');
    }
}
