<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view('section.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        // $inputs = $request->all();
        // $exists = Section::where('name',$request->name,)->exists();
        // if($exists){
        //    session()->flash('Error', 'section register before');
        //    return redirect('dashboard/section');

        // }

        $request->validate([
            'name'  => 'required|unique:sections|max:255',
            'description'  => 'required',
        ]);

            Section::create([
                'name'        => $request->name,
                'description' => $request->description,
                'created_by'  => Auth::user()->name
            ]);
        
          return redirect('dashboard/section');

        }
        

  
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)

    {
        $request->validate([
            'name'        =>['required','max:255','min:3',"unique:sections,name,$section->id"],
            'description' =>'required'
        ]);
        $section->update([
            'name'        => $request->name,
            'description' => $request->description,
            'created_by'  => Auth::user()->name
        ]);
        
        return redirect('dashboard/section');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect('dashboard/section');

    }

  
}
