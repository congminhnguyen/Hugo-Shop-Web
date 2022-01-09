<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderService
{
    public function insert($request){
        try
        {
            // $request->except('_token');
            Slider::create($request->input());
            Session::flash('success', 'Successfully!');
        } 
        catch (Exception $err)
        {
            Session::flash('error', 'Failed!');
            Log::info($err->getMessage());

            return false;
        }
        return true;
    }

    public function get(){
        return Slider::orderByDesc('id')->paginate(15);
    }

    public function update($request, $slider)
    {
        try{
            $slider->fill($request->input());
            $slider->save();
            Session::flash('success', 'Updated Successfully');
        } catch (Exception $err){
            Session::flash('error', 'Update Fail');
            Log::info($err->getMessage());
            return false;
        }
        
        return true;
    }

    public function destroy($request){
        $slider = Slider::where('id', $request->input('id'))->first();
        if($slider)
        {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
    }

    public function show(){
        return Slider::where('active',1)->orderBy('sort_by')->get();
    }
}