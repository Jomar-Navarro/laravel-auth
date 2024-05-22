<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Functions\Helper as Help;


class TechlogieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.Technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = Technology::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.technologies.index')->with('error', 'Technologie already exist');
        }else{
            $new = new Technology();
            $new->name = $request->name;
            $new->slug = Help::generateSlug($new->name, Technology::class);
            $new->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Technologie created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technologies)
    {
        $val_data = $request->validate([
            'name' => 'required|min:2|max:20'
        ],
        [
            'name.required' => 'You must insert the technologie',
            'name.min' => 'You must insert min: 2',
            'name.max' => 'You must insert max: 20',

        ]);


        $exist = Technology::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.technologies.index')->with('error', 'Technologie already exist');
        }else {

            $val_data['slug'] = Help::generateSlug($request->name, Technology::class);
            $technologies->update($val_data);

            return redirect()->route('admin.technologies.index')->with('success', 'Technologie updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technologies)
    {
        $technologies->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technologie deleted successfully');
    }
}
