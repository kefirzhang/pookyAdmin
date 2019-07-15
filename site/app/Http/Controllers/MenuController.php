<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function store()
    {
    }

    public function index()
    {
        return view('module.menu.index');
    }

    public function create()
    {
    }

    public function update()
    {
    }

    public function show()
    {
    }

    public function destroy()
    {
    }

    public function edit()
    {
    }
    /**
     *            POST      | menu                   | menu.store       | App\Http\Controllers\MenuController@store                              | web,auth     |
     * |        | GET|HEAD  | menu                   | menu.index       | App\Http\Controllers\MenuController@index                              | web,auth     |
     * |        | GET|HEAD  | menu/create            | menu.create      | App\Http\Controllers\MenuController@create                             | web,auth     |
     * |        | PUT|PATCH | menu/{menu}            | menu.update      | App\Http\Controllers\MenuController@update                             | web,auth     |
     * |        | GET|HEAD  | menu/{menu}            | menu.show        | App\Http\Controllers\MenuController@show                               | web,auth     |
     * |        | DELETE    | menu/{menu}            | menu.destroy     | App\Http\Controllers\MenuController@destroy                            | web,auth     |
     * |        | GET|HEAD  | menu/{menu}/edit       | menu.edit        | App\Http\Controllers\MenuController@edit                               | web,auth
     * }
     */

}
