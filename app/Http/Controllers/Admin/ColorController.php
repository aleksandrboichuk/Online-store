<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ColorRequest;
use App\Models\Color;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ColorController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $this->canSee('content');

        return view('admin.additional-to-products.color.index', [
            'colors' => Color::query()->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $this->canCreate('content');

        return view('admin.additional-to-products.color.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ColorRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(ColorRequest $request): Redirector|RedirectResponse|Application
    {
        $this->canCreate('content');

        $request->setActiveField();

        Color::query()->create($request->all());

        return redirect('/admin/colors')->with(['success-message' => 'Колір успішно додано.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        $this->canEdit('content');

        $color = Color::query()->find($id);

        if(!$color){
            abort(404);
        }

        return view('admin.additional-to-products.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ColorRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(ColorRequest $request, int $id): Redirector|RedirectResponse|Application
    {
        $this->canEdit('content');

        $color = Color::query()->find($id);

        $request->setActiveField();

        $color->update($request->all());

        return redirect('admin/colors')->with(['success-message' => 'Колір успішно змінено.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(int $id): Redirector|RedirectResponse|Application
    {
        $this->canDelete('content');

        $color = Color::query()->find($id);

        if(!$color) {
            abort(404);
        }

        $color->delete();

        return redirect('admin/colors')->with(['success-message' => 'Колір успішно видалено.']);
    }
}
