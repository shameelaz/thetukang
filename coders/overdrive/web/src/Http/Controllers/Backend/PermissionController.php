<?php

namespace Overdrive\Web\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use Overdrive\Web\Model\Mpermission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = config('laravolt.epicentrum.models.permission')::all()->sortBy(function ($item) {
            return strtolower($item->name);
        });

        return view('web::backend.permission.index', compact('permission'));
    }

    public function edit($id)
    {   
        $permission = Mpermission::where('id','=',$id)->first();
        return view('web::backend.permission.edit', compact('permission'));
    }

    public function update(Request $request)
    {   

        $data = Mpermission::where('id','=',$request->id)->first();
      

        $permission = Mpermission::where('id','=',$request->id)->first();
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->update();





        //  $userid = auth()->user()->name;
        // $main_app = 'Permission';
        // $desc = 'Editing record id '.$request->id;

        //$this->auditTrail($userid,$main_app,$desc);

        $userid = auth()->user()->name;
        $fk_lkp_activities = '39';
        $activities = 'Edit  Permission';
        $new_value =$request->except(['_token','action']);


         // Event::dispatch(new AuditLog('',auth()->user()->id,$fk_lkp_activities,$activities,$old_value,json_encode($new_value),''));

         return redirect()->route('backend::permissions.index')->withSuccess(trans('web::user-management.permission-edit-message-update'));
      
    }

    public function delete($id)
    {
         $old_value='permission_id ='.$id;

        $permission = Mpermission::where('id','=',$id)->delete();


        //  $userid = auth()->user()->name;
        // $main_app = 'Permission';
        // $desc = 'Deleting record id '.$id;

       //$this->auditTrail($userid,$main_app,$desc);

        //$userid = auth()->user()->name;
        $fk_lkp_activities = '39';
        $activities = 'Delete  Permission';
        $new_value ='';
        
        //  Event::dispatch(new AuditLog('',auth()->user()->id,$fk_lkp_activities,$activities,$old_value,'',''));


        return redirect()->route('backend::permissions.index')->withSuccess(trans('web::user-management.permission-edit-message-delete'));
    }

    public function addpermission()
    {   
        return view('site::system.permission.add');
      
    }

    public function savepermission(Request $request)
    {   
        $permission = new Mpermission;
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->type = $request->type;
        $permission->save();

        // $userid = auth()->user()->name;
        // $main_app = 'Permission';
        // $desc = 'Adding new record';

       // $this->auditTrail($userid,$main_app,$desc);

        $userid = auth()->user()->name;
        $fk_lkp_activities = '38';
        $activities = 'Add  Permission';
        $new_value =$request->except(['_token','action']);


         // Event::dispatch(new AuditLog('',auth()->user()->id,$fk_lkp_activities,$activities,'',json_encode($new_value),''));


         // return redirect()->route('site::system.permission')->withSuccess('New Permission Created');
      
    }





    
}
