<?php
// app/Http/Controllers/TeamController.php
namespace App\Http\Controllers;
use App\Models\Team;
class TeamController extends Controller {
  public function index() {
    return response()->json([
      'client' => 'react',
      'message'=> 'Endpoint ini dikonsumsi front-end React',
      'teams'  => Team::all(),
    ]);
  }
}
