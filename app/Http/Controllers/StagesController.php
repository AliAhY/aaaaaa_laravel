<?php

namespace App\Http\Controllers;

use App\Models\Stages;
use Illuminate\Http\Request;

class StagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stages::all();
        return view('stages.index', compact('stages'));
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
        $request->validate([
            'phaseName' => 'required|string|max:255',
            'phaseDesc' => 'required|string|max:255',
        ]);

        try {
            // معالجة البيانات (مثال: حفظها في قاعدة البيانات)  
            $phase = new Stages();
            $phase->phaseName = $request->phaseName;
            $phase->descriptaion = $request->phaseDesc;
            $phase->save();

            // العودة إلى النافذة الخاصة بك مع بيانات النجاح  
            return response()->json([
                'success' => 'المرحلة تمت إضافتها بنجاح!',
                'stage' => [
                    'id' => $phase->id,
                    'phaseName' => $phase->phaseName,
                    'descriptaion' => $phase->descriptaion,
                ]
            ]);
        } catch (\Exception $e) {
            // في حالة حدوث خطأ، ارجع برسالة خطأ  
            return response()->json(['error' => 'حدث خطأ أثناء إضافة المرحلة: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Stages $stages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stages $stages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stages $stages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stages $stages)
    {
        //
    }
}
