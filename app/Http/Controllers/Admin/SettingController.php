<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = [];

        $data = Setting::get();

        foreach ($data as $setting) {
            $settings[$setting['name']] = $setting['content'];
        }

        return view('admin.settings.index', [
            'settings' => $settings,
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->only([
            'title', 'subtitle', 'email']
        );

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('settings')
                ->withErrors($validator);
        }
        foreach ($data as $item => $value) {
            Setting::where('name', $item)->update([
                'content' => $value,
            ]);
        }

        return redirect()->route('settings')->with('warning', 'Informações alteradas com sucesso!');
    }

    protected function validator($data)
    {
        return Validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['string', 'email'],
        ]);
    }
}
