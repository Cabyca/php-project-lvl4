<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\NoReturn;

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
        $taskStatus = new TaskStatus();

        $data = $this->validate($request, [
            'name' => 'required|string|unique:task_statuses'
        ]);

//        $data = $this->validate($request, [
//            'name' => 'required|string|unique:task_statuses'
//        ], ['name.unique' => __('validation.task_status.name')]);

        $taskStatus->fill($data);
        $taskStatus->save();

        flash('Статус успешно создан')->success();

        return redirect()->route('task_statuses.index');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param TaskStatus $taskStatus
//     * @return Response
//     */
//    public function show(TaskStatus $taskStatus)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TaskStatus $taskStatus
     * @return View
     */
    public function edit(TaskStatus $taskStatus): View
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
        $taskStatus = TaskStatus::findOrFail($id);

        $data = $this->validate($request, [
            'name' => 'required|string|unique:task_statuses'
        ]);

        $taskStatus->fill($data);
        $taskStatus->save();

        flash('Статус успешно изменен')->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TaskStatus $taskStatus
     * @return RedirectResponse
     */
    #[NoReturn] public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        $status = TaskStatus::find($taskStatus->id);

        $status->delete();

        flash('Статус успешно удален')->success();

        return redirect()->route('task_statuses.index');
    }
}
