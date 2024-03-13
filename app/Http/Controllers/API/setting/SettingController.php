<?php

namespace App\Http\Controllers\API\setting;

use App\Http\Controllers\Controller;
use App\Http\Trait\AttachFilesTrait;
use App\Models\Setting;
use http\Env\Response;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use AttachFilesTrait;
    public function index(){
        $collection = Setting::all();
        $setting= $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });
        return response()->json(['settings'=> $setting],200);
    }

    public function update(Request $request){
//        dd($request);

        try{
            $info = $request->except('_token', '_method', 'logo');
            foreach ($info as $key=> $value){
                $collection= Setting::where('key', $key)->update(['value' => $value]);

            }

//            $key = array_keys($info);
//            $value = array_values($info);
//            for($i =0; $i<count($info);$i++){
//                Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
//            }
          $s=Setting::where('key','logo')->first();
            if($request->hasFile('logo')) {
                $logo_name = $request->file('logo')->getClientOriginalName();
                $collection= Setting::where('key', 'logo')->update(['value' => $logo_name]);
                $this->deleteFile('attachments/logo'.$s['logo'],'attachment');
                $this->uploadFile($request['logo'],'attachments/logo','attachment');
            }
            return response()->json(['settings'=> 'setting updated successfully'],200);
        }
        catch (\Exception $e){

            return response()->json(['error' => $e->getMessage()]);
        }

    }
}
