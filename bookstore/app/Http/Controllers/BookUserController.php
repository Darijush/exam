<?php

namespace App\Http\Controllers;

use App\Models\BookUser;
use App\Http\Requests\StoreBookUserRequest;
use App\Http\Requests\UpdateBookUserRequest;

class BookUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function show(BookUser $bookUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function edit(BookUser $bookUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookUserRequest  $request
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookUserRequest $request, BookUser $bookUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookUser  $bookUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookUser $bookUser)
    {
        //
    }
}
