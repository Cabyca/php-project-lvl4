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
        //get_class_methods($request); все методы данного класса https://www.youtube.com/watch?v=_d0h8QG2vTM

        $filter = $request->input('filter');

        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('status_id'),
            ])
            ->paginate(15)->withPath("?" . $request->getQueryString());
            //сохраняем данные при пагинации

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
        //dd($request->all()); // Реализовать запись в таблицы users и label

        $data = $this->validate($request, [
            'name' => 'required|string|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable' //Связано с сущностью пользователя. Тот на кого поставлена задача
        ]);

        //$task->created_by_id = auth()->user()->__get('id'); //Создатель задачи
        //'user_id' => Auth::id()

        $user = Auth::user();

        if (!isset($user)) {
            throw new Exception('User is not authenticated');
        }
        $task = $user->createdTasks()->make($data);
        $task->save();

        $labels = $request->input('labels');

        $task->labels()->attach($labels);

        //$task->labels->label_id = 1;
//            , ['name.unique' => __('validation.tasks.name')]);

        flash(__('flash.task.store.success'))->success();

        return redirect()->route('tasks.index');
        //return to_route('home');
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
            abort('403', 'THIS ACTION IS UNAUTHORIZED.');
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
        ]);

        $user = Auth::user();

        if (!isset($user)) {
            throw new Exception('User is not authenticated');
        }
        $task = $user->createdTasks()->make($data);
        $task->save();
        //$task->update();

        $labels = $request->input('labels');

        $task->labels()->sync($labels);

        flash(__('flash.task.update.success'))->success();

        return redirect()->route('tasks.index');
    }

    #TODO Сделать проверку на разрешение удаления если это тот пользователь
    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task = Task::find($task->id);

        $task->labels()->detach();

        $task->delete();

        flash(__('flash.task.destroy.success'))->success();

        return redirect()->route('tasks.index');
    }
}
