<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Branch, Hall};
use Illuminate\Support\Str;

class HallController extends Controller
{
  public function show_add()
  {
    return view(
      'hall.add',
      [
        'branches' => Branch::get(),
      ]
    );
  }

  public function store(Request $request)
  {
    $letter = Str::upper($request->letter);
    $branch = Branch::find($request->branch_id);
    if ($branch === null) {
      die("branch not found");
    }
    $hall = new Hall(['letter' => $letter]);
    // dd($branch->halls());
    $branch->halls()->save($hall);

    session()->flash('message', ["Hall Added succefully", "info"]);
    return redirect()->back();
  }

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

  public function show_halls(Request $request)
  {
    if (!$request->has('bid'))
      die();
    $branch = Branch::find($request->bid);
    if ($branch === null)
      die();
    $halls_info = $branch->halls()->get(['letter', 'id']);
    return response()->json($halls_info);
  }
}
