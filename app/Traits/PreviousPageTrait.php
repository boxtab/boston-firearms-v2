<?php

namespace App\Traits;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * Trait PreviousPageTrait
 * @package App\Traits
 */
trait PreviousPageTrait
{
    /**
     * @param string $pageName
     */
    private function rememberPage(string $pageName)
    {
        Session::put("$pageName.back-url", request()->headers->get('referer'));
    }

    /**
     * @param string $pageName
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectBack(string $pageName)
    {
        if (Session::exists("$pageName.back-url")) {
            $backURL = Session::get("$pageName.back-url");
            session()->forget("$pageName");
            return Redirect::to($backURL);
        } else {
            return redirect()->back();
        }
    }
}
