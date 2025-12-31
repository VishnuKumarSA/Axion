<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\EnterpriseSetting;
use Illuminate\Http\Request;

class EnterpiseSettingController extends Controller
{
    public function createSettings(Request $request)
    {
        $request->validate([
            "enterprise_id" => 'required',
            "settings" => "required|array"
        ]);

        Enterprise::findOrFail($request->enterprise_id);

        $enterpriseSetting = EnterpriseSetting::create($request->only(
            'enterprise_id',
            'settings'
        ));

        return response()->json($enterpriseSetting, 200);
    }

    public function updateSetting(Request $request)
    {
        $request->validate([
            "enterprise_id" => 'required',
            "settings" => "required|array"
        ]);

        $setting = EnterpriseSetting::findOrFail($request->enterprise_id);

        $oldSettings = $setting->settings ?? [];

        $newSettings = array_replace_recursive(
            $oldSettings,
            $request->settings
        );
        $setting->update(['settings' => $newSettings]);

        return response()->json([
            'message' => 'Settings updated successfully',
            'settings' => $newSettings
        ], 200);
    }
}
