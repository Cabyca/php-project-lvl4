<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $filter = $request->input('filter');

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('status_id'),
            ])
            ->paginate(15)->withPath("?" . $request->getQueryString());

        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::all();
        return view('tasks.index', compact('tasks', 'statuses', 'users', 'labels', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $task = new Task();
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.create', compact('statuses', 'users', 'labels', 'task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validate($request, [
            'name' => 'required|string|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
        ], ['name.unique' => __('validation.task.name.unique'),
            'name.required' => __('validation.task.name.required'),
            'status_id.required' => __('validation.task.status_id.required')]);

        $user = Auth::user();

        if (!isset($user)) {
            throw new Exception('User is not authenticated');
        }
        $task = $user->createdTasks()->make($data);
        $task->save();

        $labels = $request->input('labels');

        $labels = collect($labels)->filter(function ($label) {
            return $label !== null;
        });

        $task->labels()->attach($labels);

        flash(__('flash.task.store.success'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return Application|Factory|View
     */
    public function show(Task $task): Application|Factory|View
    {
        $user = Auth::user();

        if (!isset($user)) {
            abort(403, 'THIS ACTION IS UNAUTHORIZED.');
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return View
     */
    public function edit(Task $task): View
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $task = Task::findOrFail($id);

        $data = $this->validate($request, [
            'name' => 'required|string|unique:tasks,name,' . $task->id,
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
        ], ['name.unique' => __('validation.task.name.unique'),
            'name.required' => __('validation.task.name.required'),
            'status_id.required' => __('validation.task.status_id.required')]);

        $user = Auth::user();

        if (!isset($user)) {
            throw new Exception('User is not authenticated');
        }

        $task->fill($data);
        $task->save();

        $labels = $request->input('labels');

        $task->labels()->sync($labels);

        flash(__('flash.task.update.success'))->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->labels()->detach();

        $task->delete();

        flash(__('flash.task.destroy.success'))->success();

        return redirect()->route('tasks.index');
    }
}
