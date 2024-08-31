<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Models\Courses;
use App\Models\Members;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $members = Members::get();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Courses::all();
        return view('members.create', compact('courses'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        try {
            //insert to db
            $fragilityValues = [
                $request->fragility_father_job,
                $request->fragility_mother_job,
                $request->fragility_disability,
                $request->fragility_family_member,
                $request->fragility_family_worker,
                $request->fragility_military,
            ];

            $finalResult = array_sum($fragilityValues);

            // $dob = Carbon::parse($request->dob);
            // $dob_year = $dob->year;

            $requestData = $request->all();

            $requestData['final_result'] = $finalResult;
            // $requestData['dob'] = $dob_year;

            Members::create($requestData);

            return back()->with('success', 'تمت الإضافة بنجاح');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Members::find($id);
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $courses = Courses::all();
        $member = Members::find($id);
        // return $member;
        return view('members.edit', compact('member', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMemberRequest $request,  $id)
    {
        $fragilityValues = [
            $request->fragility_father_job,
            $request->fragility_mother_job,
            $request->fragility_disability,
            $request->fragility_family_member,
            $request->fragility_family_worker,
            $request->fragility_military,
        ];

        $finalResult = array_sum($fragilityValues);

        $member = Members::find($id);
        $member->fill($request->all());
        $member->final_result = $finalResult;
        $member->save();


        // $members = Members::get();
        // return view('members.index', compact('members'))->with('success', 'updated successfully');
        return back()->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Members $member)
    {
        $member->delete();
        return back();
        // $members = Members::get();
        // return view('members.index', compact('members'))->with('success', 'updated successfully');
    }
}
