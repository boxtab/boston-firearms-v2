<?php

namespace App\Orchid\Screens\InfoSource;

use App\Http\Requests\InfoSourceSaveRequest;
use App\Models\InfoSource;
use App\Orchid\Layouts\InfoSource\InfoSourceEditLayout;
use App\Orchid\Layouts\InfoSource\InfoSourceListLayout;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

/**
 * Class InfoSourceScreen
 * @package App\Orchid\Screens\InfoSource
 *
 */
class InfoSourceScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'infoSource' => InfoSource::filters()->defaultSort('id', 'asc')->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        $infoCount = InfoSource::count();
        return "Info Source($infoCount)";
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All info source';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block([
                InfoSourceEditLayout::class,
            ])
                ->vertical()
                ->title('Create info source'),

            InfoSourceListLayout::class,
        ];
    }

    /**
     * @param InfoSourceSaveRequest $request
     * @param InfoSource $infoSource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buttonCreate(InfoSourceSaveRequest $request, InfoSource $infoSource)
    {
        $infoSource->fill([
            'title' => $request->get('info-source')['title'],
            'added_by' => Auth::id(),
        ]);
        $infoSource->save();

        return redirect()->route('platform.systems.info-source');
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        InfoSource::on()->findOrFail($request->get('infoSourceId'))->delete();

        Toast::info(__('Info source was removed'));
    }
}
