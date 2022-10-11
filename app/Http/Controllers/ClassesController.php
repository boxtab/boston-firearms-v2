<?php

namespace App\Http\Controllers;


use App\Models\Event;

/**
 * Class ClassesController
 * @package App\Http\Controllers
 */
class ClassesController extends Controller
{
    public function index()
    {
        $topClasses = Event::active()->whereIn('id', [1,2])->get();
        $centralClass = Event::find(5);
        $additionalClasses = Event::active()->whereIn('id', [19,3,18])->get();
        return view('pages.classes', collect([
            'featured_classes' => $topClasses,
            'central_class' => $centralClass,
            'other_classes' => $additionalClasses
        ]));
    }
}
