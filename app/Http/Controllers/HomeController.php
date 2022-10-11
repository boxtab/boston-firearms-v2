<?php

namespace App\Http\Controllers;

use App\Models\Event;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.home', [
            'events' => Event::active()->hasAppointments()->orderBy('id')->get(),
        ]);
    }
}
