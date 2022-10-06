<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller {
  public function index() {
    $projects = Project::get();
    
    return view('guest.projects.index', [
      'projects' => $projects
    ]);
  }
}
