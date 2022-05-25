<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    #TODO Сделать проверку на разрешение удаления если это тот пользователь
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $tasks = Task::orderBy('id')->paginate(3);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.create', compact('taskStatuses', 'users', 'labels'));
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
        //dd($request->all()); // Реализовать запись в таблицы users и label

        $task = new Task();

        $data = $this->validate($request, [
            'name' => 'required|string|unique:tasks',
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable' //Связано с сущностью пользователя. Тот на кого поставлена задача
        ]);

        $label = $request->input('labels')[0];

        $task->labels()->attach(['label_id' => $label, 'task_id' => 1]);

        //$task->labels->label_id = 1;
//            , ['name.unique' => __('validation.tasks.name')]);

        //$task->created_by_id = auth()->user()->id; //Создатель задачи
        $task->created_by_id = auth()->user()->__get('id');

        $task->fill($data);
        $task->save();

        flash('Задача успешно создана')->success();

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
        //dd($task->labels->name);

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
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();
        return view('tasks.edit', compact('task', 'taskStatuses', 'users', 'labels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $task = Task::findOrFail($id);

        $data = $this->validate($request, [
            'name' => 'required|string|unique:tasks,name,' . $task->id,
            'description' => 'nullable',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable' //Связано с сущностью пользователя. Тот на кого поставлена задача
        ]);

        //$task->created_by_id = auth()->user()->id; //Создатель задачи
        $task->created_by_id = auth()->user()->__get('id');

        $task->fill($data);
        $task->save();

        flash('Задача успешно изменена')->success();

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
        $task = Task::find($task->id);

        $task->delete();

        flash('Задача успешно удалена')->success();

        return redirect()->route('tasks.index');
    }
}
