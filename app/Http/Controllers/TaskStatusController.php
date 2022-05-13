<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $statuses = TaskStatus::all()->sort();

        return view('statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('statuses.create');
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
        $this->validate($request, [
            'name' => 'required|string|unique:task_statuses'
        ]);

        $newStatus = new TaskStatus();
        $newStatus->name =  $request->name;
        // При ошибках сохранения возникнет исключение
        $newStatus->save();

        flash('Статус успешно создан')->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param TaskStatus $taskStatus
     * @return Response
     */
    public function show(TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TaskStatus $taskStatus
     * @return Factory|View
     */
    public function edit(TaskStatus $taskStatus): View|Factory
    {
        return view('statuses.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $status = TaskStatus::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|unique:task_statuses'
        ]);

        $status->name = $request->name;
        $status->save();

        flash('Статус успешно изменен')->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    //public function destroy(TaskStatus $taskStatus): RedirectResponse
    public function destroy(int $id): RedirectResponse
    {
        $status = TaskStatus::find($id);

        if ($status) {
            $status->delete();
        }

        flash('Статус успешно удален')->success();

        return redirect()->route('task_statuses.index');
    }
}
