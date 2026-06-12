<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('id')->get()->groupBy('group');
        return view('admin.pengaturan', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::all();

        $rules = [];
        foreach ($settings as $setting) {
            $fieldRules = match ($setting->type) {
                'number', 'integer', 'float' => 'nullable|numeric',
                'email' => 'nullable|email',
                'file', 'image' => 'nullable|file|mimes:jpg,jpeg,png,ico,svg|max:2048',
                'boolean' => 'nullable|in:0,1,true,false',
                default => 'nullable|string|max:65535',
            };
            $rules['setting_' . $setting->id] = $fieldRules;
        }

        $data = $request->validate($rules);

        foreach ($settings as $setting) {
            $field = 'setting_' . $setting->id;

            if (in_array($setting->type, ['file', 'image'])) {
                if ($request->hasFile($field)) {
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    $path = $request->file($field)->store('settings', 'public');
                    $setting->update(['value' => $path]);
                }
            } else {
                if (!$request->exists($field)) {
                    continue;
                }
                $value = $data[$field] ?? '';
                if ($setting->type === 'boolean') {
                    $value = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
                }
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->route('admin.pengaturan')
            ->with('success', 'Pengaturan berhasil disimpan');
    }
}
