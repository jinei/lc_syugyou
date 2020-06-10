<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;

class TimelinesController extends Controller
{
    public function index() {
        $timelines = Timeline::all();
        return view('timelines.index')->with('timelines',$timelines);
    }
    
}
