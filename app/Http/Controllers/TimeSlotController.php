<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Movie, Branch, TimeSlot, Hall};
use Date;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class TimeSlotController extends Controller
{
  // TODO: make proper use of `has_conflict`
  public static function has_conflict(Hall $hall, DateTimeImmutable $start_time, $duration)
  {
    // Hall::where('
    // dd($hall, $date);
    // $day = $date->setTime(0, 0);
    // $next_day = $day
    //   ->add(DateInterval::createFromDateString("1 day"));
    // dd(
    //   $date->format(DateTime::RFC2822),
    //   $next_day->format(DateTime::RFC2822),
    // );

    $endTime = $start_time
      ->add(new DateInterval("PT{$duration}M"));
    // dd(
    //   $start_time->format(DateTime::RFC2822),
    //   $endTime->format(DateTime::RFC2822),
    // );

    // $query = $hall->timeSlots()
    //   ->where('time', '>=', $date)
    //   ->where('time', '<=', $next_day);
    // $query = TimeSlot::where("hall_id", "=", $hall->id)
    //   ->where('time', '>=', $date)
    //   ->where('time', '<=', $next_day);
    $query = $hall->time_slots()
      ->join('movies', 'movies.id', '=', 'time_slots.movie_id')
      // ->addSelect([
      //   'duration' => Movie::select('duration')
      //     ->whereColumn('movie_id', 'movies.id')
      //     ->take(1)
      // ])
      // ->whereBetween('time', [$day, $next_day]);
      ->whereDay('start_time', $start_time)
      ->whereDate('created_at', '2016-12-31')
      ->where('start_time', '<', $endTime)
      ->where(
        DB::raw('ADDTIME(start_time, SEC_TO_TIME(duration * 60))'),
        '>',
        $start_time
      )
      ->select([
        '*',
        // DB::raw('start_time + SEC_TO_TIME(duration * 60) as endTime'),
        DB::raw('ADDTIME(start_time, SEC_TO_TIME(duration * 60)) as endTime'),
      ])
      // ->withCasts(['endTime' => 'DateTime' ])
    ;
    $query->dd();
    // $query->dd();
    // dd(
    //   $query,
    //   $query->toSql(),
    //   $query->get()->map(function ($item) {
    //     return $item->attributesToArray();
    //   }),
    //   $duration,
    //   $start_time,
    //   $endTime,
    // );
    dd($query->count() !== 0);
  }

  public function show_add()
  {
    // dd(TimeSlot::factory()
    //     ->count(10)->make());
    return view(
      'time_slot.add',
      [
        'movies' => Movie::get(),
        'branches' => Branch::get(),
      ]
    );
  }

  public function store(Request $request)
  {
    $datetime = $request->date . " " . $request->time;
    // dd(
    //   $request->all(),
    //   $request->hid,
    //   Hall::find($request->hid)
    // );

    // self::has_conflict(
    //   Hall::find($request->hid),
    //   new DateTimeImmutable($datetime),
    //   Movie::find($request->mid)->duration,
    // );

    $time_slot = new TimeSlot();
    $time_slot->start_time = new DateTimeImmutable($request->date . " " . $request->time);
    $time_slot->movie_id = $request->mid;      // TODO: do not assign movie_id directly
    $hall = Hall::find($request->hid);
    $hall->time_slots()->save($time_slot);
    session()->flash('message', ["Time slot added succefully", "info"]);
    return redirect()->refresh();
  }

  public function browse()
  {
    return view(
      'time_slot.browse',
      [
        'movies' => Movie::get(),
      ]
    );
  }

  public function show_time_slots(Request $request)
  {
    if (!$request->has('mid'))
      die();
    // $time_slots = TimeSlot::find($request->mid);
    // if ($time_slots === null)
    //   die();
    // TODO: update queries to use cast, and format date in view
    $query = DB::table('time_slots')
      ->join('halls', 'halls.id', '=', 'time_slots.hall_id')
      ->join('branches', 'branches.id', '=', 'halls.branch_id')
      ->select([
        "halls.letter   as hall_letter",
        "branches.name  as branch_name",
        "time_slots.id  as id",
        // "time           as datetime",
        DB::raw('DATE_FORMAT(`start_time`, "%d-%m-%Y")  as date'),
        DB::raw('DATE_FORMAT(`start_time`, "%H:%i")     as time'),
      ])
      ->where("time_slots.movie_id", "=", $request->mid);
    // dd($query, $query->toSql(), $query->get());

    // return response()->json($halls_info);
    return response()->json(
      $query->get()
    );
  }
}
