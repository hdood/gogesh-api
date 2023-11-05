<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Enum\EnumGeneral;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Models\CommonQuestion;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::all();
        $common = CommonQuestion::all();
        $actived = $setting->where('key', 'actived')->first()->value ?? 0;
        $verification = $setting->where('key', 'verification')->first()->value ?? 0;
        $privacy_policy = Setting::where('key', EnumGeneral::PRIVACY_POLICY)->first();
        return view('settings.index', compact(
            'common',
            'setting',
            'actived',
            'verification',
            'privacy_policy'
        ));
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
        foreach ($request->except('_token') as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->delete();
                $settings = new Setting();
                $settings['key'] = $key;
                $settings['value'] = $value;
                $settings->save();
            } else {
                $settings = new Setting();
                $settings['key'] = $key;
                $settings['value'] = $value;
                $settings->save();
            }
        }
        return to_route('settings.index');
    }

    public function privacy_policy(Request $request)
    {
        $setting = Setting::where('key', EnumGeneral::PRIVACY_POLICY)->first();
        if ($setting) {
            $setting->delete();
            $settings = new Setting();
            $settings->key = EnumGeneral::PRIVACY_POLICY;
            $settings->value = $request->privacy_policy;
            $settings->value_ar = $request->privacy_policy_ar;
            $settings->save();
        } else {
            $settings = new Setting();
            $settings->key = EnumGeneral::PRIVACY_POLICY;
            $settings->value = $request->privacy_policy;
            $settings->value_ar = $request->privacy_policy_ar;
            $settings->save();
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
