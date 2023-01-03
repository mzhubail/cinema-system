<?php

namespace App\Http\Controllers;

use App\Http\Requests\HallRequest;
use Illuminate\Http\Request;
use App\Models\{Branch, Hall};
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class HallController extends Controller
{
  /**
   * Show a form for adding a new hall
   */
  public function show_add()
  {
    return view(
      'hall.add',
      [
        'branches' => Branch::get(),
      ]
    );
  }



  /**
   * Store a new hall
   */
  public function store(Request $request)
  {
    $request->validate([
      'letter' => 'required|alpha|size:1',
      'branch' => 'required|exists:branches,id',
    ]);

    try {
      $letter = Str::upper($request->letter);
      $branch = Branch::find($request->branch);
      if ($branch === null) {
        die("branch not found");
      }
      $hall = new Hall(['letter' => $letter]);
      $branch->halls()->save($hall);

      session()->flash('message', "Hall Added succefully");
      return back();
    } catch (QueryException $e) {
      throw $e->errorInfo[1] == 1062
        ? ValidationException::withMessages(['Hall letter is already taken'])
        : $e;
    }
  }



  /**
   * Show a page for listing halls information depending on selected branch
   */
  public function browse(Request $request)
  {
    return view(
      'hall.browse',
      [
        'branches' => Branch::get(),
        'branch_id' => $request->bid,
      ]
    );
  }



  /**
   * Serve the halls information for the given branch
   */
  public function serve_halls(Request $request)
  {
    if (!$request->has('bid'))
      die();
    $branch = Branch::find($request->bid);
    if ($branch === null)
      die();
    $halls_info = $branch->halls()->get(['letter', 'id']);
    return response()->json($halls_info);
  }



  public function show_edit(Request $request)
  {
    $hall = Hall::find($request->id);
    if ($hall === null) {
      session()->flash('message', ["Sorry, hall not found", "error"]);
      return back();
    }
    return view('hall.edit', ['hall' => $hall]);
  }



  public function update(Request $request)
  {
    $request->validate([
      'hall' => 'required|exists:halls,id',
      'letter' => 'required|alpha|size:1',
    ]);

    try {
      $hall = Hall::find($request->id);
      $hall->letter = Str::upper($request->letter);
      $hall->save();
      session()->flash('message', "Hall updated succefully");
      return back();
    } catch (QueryException $e) {
      throw $e->errorInfo[1] == 1062
        ? ValidationException::withMessages(['Hall letter is already taken'])
        : $e;
    }
  }
}
