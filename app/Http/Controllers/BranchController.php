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



  /**
   * List branches in the system
   */
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



  /**
   * Show a form for adding a new branch
   */
  public function show_add()
  {
    return view('branch.add');
  }



  /**
   * Add a new branch to the system
   */
  public function store(Request $request)
  {
    Branch::create($request->all());
    session()->flash('message', ["Branch Added succefully", "info"]);
    return redirect()->refresh();
  }



  public function show_edit(Request $request)
  {
    $branch = Branch::find($request->id);
    if ($branch === null) {
      session()->flash('message', ["Sorry, branch not found", "error"]);
      return redirect()->back();
    }
    return view('branch.edit', ['branch' => $branch]);
  }



  public function update(Request $request)
  {
    $input = $request->all();

    $branch = Branch::find($request->id);
    $branch->fill($input);
    $branch->save();
    session()->flash('message', ["Branch updated succefully", "error"]);
    return redirect()->back();
  }
}
