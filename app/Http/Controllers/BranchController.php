<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Validation\Rule;

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
    $request->validate([
      'name' => 'required|unique:branches|min:3|max:31',
      'address' => 'required|min:5|max:63',
    ]);
    Branch::create([
      'name' => $request->name,
      'addr' => $request->address
    ]);
    session()->flash('message', "Branch Added succefully");
    return back();
  }



  public function show_edit(Request $request)
  {
    $branch = Branch::find($request->id);
    if ($branch === null) {
      session()->flash('message', ["Sorry, branch not found", "error"]);
      return back();
    }
    return view('branch.edit', ['branch' => $branch]);
  }



  public function update(Request $request)
  {
    $request->validate([
      'branch' => 'required|exists:branches,id',
    ]);
    $branch = Branch::find($request->branch);

    $request->validate([
      'name' => [
        'required', 'min:3', 'max:31',
        Rule::unique('branches', 'name')->ignore($branch->id)
      ],
      'address' => 'required|min:5|max:63',
    ]);

    $branch->fill([
      'name' => $request->name,
      'addr' => $request->address
    ]);
    $branch->save();
    session()->flash('message', "Branch updated succefully");
    return back();
  }
}
