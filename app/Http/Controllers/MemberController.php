<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function showData(){
        return view('test');
    }

    public function display(Request $request){
        $data=[];
        $data['status']='NOK';
        $model= new Member();
        $parentData= Member::where('parent_id','0')->with('children')->get();
        if($request->ajax() && $request->input()){
                $input=$request->except('_token');
                $input['createdate'] =Carbon::now();
                 if(Member::insert($input)){
                     $data['status']='OK';
                }
                return json_encode($data);

        }
        return view('test',[
            'model'=>$model,
            'parentData'=>$parentData
        ]);
    }


}
