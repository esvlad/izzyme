<?php

namespace App\Http\Controllers\Admin;

use App\Point;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.points.index', [
          'points' => Point::paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.points.create', [
          'companyes' => Company::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $this->validate($request, [
          'address' => 'required|string|max:255',
          'address_comment' => 'nullable|string',
          'time_work' => 'required|string|max:100',
          'phone' => 'required|string|max:50',
          'email' => 'nullable|string|email|max:30',
          'geo' => 'max:255',
      ]);

      $points_id = Point::staticSave([
        'address' => $request['address'],
        'address_comment' => $request['address_comment'],
        'time_work' => $request['time_work'],
        'phone' => $request['phone'],
        'email' => $request['email'],
        'geo' => $request['geo'],
        'created_at' => date('Y-m-d H:i:s'),
        'status' => $request['status'],
      ]);

      Point::company_point_save($points_id, $request['company_id']);

      return redirect()->route('admin.points.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
      return view('admin.points.edit', [
        'point' => $point,
        'companyes' => Company::all(),
        'point_company_id' => $point->companyId($point->id)
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
      $validator = $this->validate($request, [
          'address' => 'required|string|max:255',
          'address_comment' => 'nullable|string',
          'time_work' => 'required|string|max:100',
          'phone' => 'required|string|max:50',
          'email' => 'nullable|string|email|max:30',
          'geo' => 'max:255',
      ]);

      $point->address = $request['address'];
      $point->address_comment = $request['address_comment'];
      $point->time_work = $request['time_work'];
      $point->phone = $request['phone'];
      $point->email = $request['email'];
      $point->geo = $request['geo'];
      $point->status = $request['status'];
      $point->save();

      Point::company_point_update($point->id, $request['company_id']);

      return redirect()->route('admin.points.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
      Point::company_point_delete($point->id);
      $point->delete();

      return redirect()->route('admin.points.index');
    }
}
