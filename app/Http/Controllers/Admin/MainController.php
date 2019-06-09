<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:edit-posts');
        $this->middleware('can:add-posts');
    }

    public function index()
    {
        return view('admin.main');
    }
}
