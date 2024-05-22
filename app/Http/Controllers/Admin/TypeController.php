<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper as Help;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Type::all();
        return view('admin.Types.index', compact('technologies'));
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
        $exist = Type::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.Types.index')->with('error', 'Technologie already exist');
        }else{
            $new = new Type();
            $new->name = $request->name;
            $new->slug = Help::generateSlug($new->name, Type::class);
            $new->save();

            return redirect()->route('admin.Types.index')->with('success', 'Technologie created successfully');
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
    public function update(Request $request, Type $technologies)
    {
        $val_data = $request->validate([
            'name' => 'required|min:2|max:20'
        ],
        [
            'name.required' => 'You must insert the technologie',
            'name.min' => 'You must insert min: 2',
            'name.max' => 'You must insert max: 20',

        ]);


        $exist = Type::where('name', $request->name)->first();
        if($exist){
            return redirect()->route('admin.Types.index')->with('error', 'Technologie already exist');
        }else {

            $val_data['slug'] = Help::generateSlug($request->name, Type::class);
            $technologies->update($val_data);

            return redirect()->route('admin.Types.index')->with('success', 'Technologie updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $technologies)
    {
        $technologies->delete();
        return redirect()->route('admin.Types.index')->with('success', 'Technologie deleted successfully');
    }
}
