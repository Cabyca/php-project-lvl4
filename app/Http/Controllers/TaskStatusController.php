<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
        $taskStatus = new TaskStatus();
        return view('statuses.create', compact('taskStatus'));
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
        ], ['name.unique' => __('validation.task_status.name'),
            'name.required' => __('validation.task_status.required')]);

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('flash.taskStatus.store.success'))->success();

        return redirect()->route('task_statuses.index');
    }
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
            'name' => 'required|string|unique:task_statuses,name,' . $taskStatus->id,
        ], ['name.unique' => __('validation.task_status.name'),
            'name.required' => __('validation.task_status.required')]);

        $taskStatus->fill($data);
        $taskStatus->save();

        flash(__('flash.taskStatus.update.success'))->success();

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TaskStatus $taskStatus
     * @return RedirectResponse
     */
    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('flash.taskStatus.destroy.error'))->error();
            return back();
        }

        $taskStatus->delete();

        flash(__('flash.taskStatus.destroy.success'))->success();

        return redirect()->route('task_statuses.index');
    }
}
