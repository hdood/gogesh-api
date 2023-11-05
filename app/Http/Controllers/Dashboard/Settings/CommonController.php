<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();

        return view('settings.index', compact('common'));
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
        CommonQuestion::truncate();
        foreach ($request->common as $key => $value) {
            $common = new CommonQuestion();
            $common->question_ar = $value['question_ar'];
            $common->question_en = $value['question_en'];
            $common->answer_ar = $value['answer_ar'];
            $common->answer_en = $value['answer_en'];
            $common->for = $value['for'];
            $common->save();
        }
        return to_route('settings.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
