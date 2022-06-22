<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return bool
     */
    public function index(): bool
    {
        Mail::to('alex@google.com')->send(new OrderShipped('123'));
        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return bool
     */
    public function create(): bool
    {
        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return bool
     */
    public function store(Request $request): bool
    {
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return bool
     */
    public function show(int $id): bool
    {
        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return bool
     */
    public function edit(int $id): bool
    {
        return true;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return bool
     */
    public function update(Request $request, int $id): bool
    {
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return true;
    }
}
