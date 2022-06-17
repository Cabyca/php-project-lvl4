<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Nullable;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $labels = Label::all()->sort();

        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *  @return View
     */
    public function create(): View
    {
        $label = new Label();
        return view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $label = new Label();

        $data = $this->validate(
            $request,
            [
            'name' => 'required|string|unique:labels',
            'description' => 'nullable'
            ],
            ['name.unique' => __('validation.label.name')],
            ['name.required' => __('validation.label.name')]
        );

        $label->fill($data);
        $label->save();

        flash(__('flash.label.store.success'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Label $label
     * @return Response
     */
    public function show(Label $label): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Label $label
     * @return View
     */
    public function edit(Label $label): View
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $label = Label::findOrFail($id);

        $data = $this->validate(
            $request,
            [
            'name' => 'required|string|unique:labels,name,' . $label->id,
            'description' => 'nullable'
            ],
            ['name.unique' => __('validation.label.name')],
            ['name.required' => __('validation.label.name')]
        );

        $label->fill($data);
        $label->save();

        flash(__('flash.label.update.success'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Label $label
     * @return RedirectResponse
     */
    public function destroy(Label $label): RedirectResponse
    {
        if ($label->tasks()->exists()) {
            flash(__('flash.label.destroy.error'))->error();
            return back();
        }

        $label->delete();

        flash(__('flash.label.destroy.success'))->success();

        return redirect()->route('labels.index');
    }
}
