<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Project;
class Projects extends Controller
{
    function list(){
        return Project::all();
    }
}
