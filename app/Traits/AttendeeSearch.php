<?php

namespace App\Traits;

use App\Constants\ResultPerPageConstant;
use App\Http\Requests\AttendeeSearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Trait AttendeeSearch
 * @package App\Traits
 */
trait AttendeeSearch
{
    /**
     * @param string $page
     * @param AttendeeSearchRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search(string $page, AttendeeSearchRequest $request)
    {
        Session::put("$page.byKeyword", $request->get('search_attendee')['by_keyword'] ?? null);
        Session::put("$page.byEvent", $request->get('search_attendee')['by_event'] ?? 0);
        Session::put("$page.resultsPerPage", $request->get('search_attendee')['results_per_page'] ?? ResultPerPageConstant::getFirstPagination());
        Session::put("$page.byDateStart", $request->get('search_attendee')['by_date_start'] ?? null);
        Session::put("$page.byDateEnd", $request->get('search_attendee')['by_date_end'] ?? null);

        return redirect()->route("platform.systems.$page")->withInput([
            'search_attendee.by_keyword' => Session::get("$page.byKeyword"),
            'search_attendee.by_event' => Session::get("$page.byEvent"),
            'search_attendee.results_per_page' => Session::get("$page.resultsPerPage"),
            'search_attendee.by_date_start' => Session::get("$page.byDateStart"),
            'search_attendee.by_date_end' => Session::get("$page.byDateEnd"),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $page = $request->get('page');

        session()->forget($page);

        return redirect()->route("platform.systems.$page")->withInput([
            'search_attendee.by_keyword' => null,
            'search_attendee.by_event' => null,
            'search_attendee.results_per_page' => null,
            'search_attendee.by_date_start' => null,
            'search_attendee.by_date_end' => null,
        ]);
    }

    /**
     * @param string $needleURL
     * @return bool
     */
    private function isAnotherPage(string $needleURL): bool
    {
        $referer = request()->headers->get('referer');
        return (
            empty($referer) ||
            (
                str_ends_with($referer, $needleURL) ||
                str_contains($referer, $needleURL . '?')
            )
        );
    }
}
