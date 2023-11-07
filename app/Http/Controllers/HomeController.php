<?php

namespace App\Http\Controllers;

use App\Views\ViewModels\DealViewModel;

class HomeController extends Controller
{
    public function __invoke(): DealViewModel
    {
        return (new DealViewModel())->view('index');
    }
}
