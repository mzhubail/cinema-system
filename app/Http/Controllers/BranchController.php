<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
  public static $header = [
    "id" => "ID",
    "name" => "Name",
    "addr" => "Address"
  ];

  public function browse()
  {
    // dd(Branch::get());
    $branches = Branch::get();

    if ($branches->isEmpty()) {
      // TODO: place error in a dedicated page
      session()->flash('message', ["Sorry, no branches where found", "error"]);
      return redirect('/');
    }

    return view(
      'branch.browse',
      [
        'branches' => $branches,
        'header' => self::$header,
      ]
    );
  }

  public function show_add()
  {
    return view('branch.add');
  }

  public function store(Request $request)
  {
    Branch::create($request->all());
    session()->flash('message', ["Branch Added succefully", "info"]);
    return redirect()->refresh();
  }
}
