<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Parameter;

class ProjectController extends Controller {
  public function index() {
    $projects  = Project::get();
    $parameter = Parameter::where('code', 'project')->first();

    return view('guest.projects.index', [
      'projects' => $projects,
      'parameter' => $parameter
    ]);
  }

  public function visualstudents() {

  }

  public function jin() {

  }

  public function tridmeengine() {

  }

  public function inos() {
    
  }
}
