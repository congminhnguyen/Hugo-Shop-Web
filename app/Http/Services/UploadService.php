<?php

namespace App\Http\Services;

use Exception;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();

                $pathFull = 'uploads/' . date("Y/m/d");

                $path = $request->file('file')->storeAs(
                    'public/' . $pathFull,
                    $name
                );
                return '/public/' . $pathFull . '/' . $name;
            } 
            catch (Exception $err) {
                return false;
            }
        }
    }
}
