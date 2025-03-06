<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use App\Models\AttorneysModel;
use App\Models\CmsGroupPermissionModel;
use App\Models\MainCategoryModel;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use APp\Models\AdminModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UsersRolesController extends Controller
{
  
    public function Users(){
        $Users=AdminModel::orderBy("id","desc")->get();
        if($Users){
            return view("admin_panel.softwareusers.index",compact('Users'));
        }
    }
    public function createUser(){
        $permissions = PermissionGroup::with('cmsPermissionGroups')->orderBy('id','asc')->get();
        $attoerneys=AttorneysModel::where('status','yes')->orderBy('id','asc')->get();
        $mainCategory=MainCategoryModel::where('status','yes')->orderBy('id','asc')->get();
        return view("admin_panel.softwareusers.create",compact('permissions','attoerneys','mainCategory'));
    }

  public function createUserStore(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:admins,email',
        'contact_no' => 'nullable|string|max:12',
        'user_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        'ip_address' => 'required|ip',
        'password' => [
            'required',
            'string',
            'min:8',
        ],
        'role' => 'required|string', 
        'permissions' => 'required|array',
        'status' => 'required',
        'permissions.*' => 'exists:cms_group_permissions,id',
    ]);

    // Create the user
    $user = new AdminModel();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->contact_no = $request->input('contact_no');
    $user->status = $request->input('status');
    $user->user_id = Auth::user()->id;
    
    if ($request->hasFile('user_image')) {
        $file = $request->file('user_image');
        $path = 'uploads/admins_images/';
        $fileName = compressImageToSize($file, $path, 250);
        $user['user_image'] = $fileName;
    }

    $user->ip_address = $request->input('ip_address');
    $user->password = Hash::make($request->input('password'));
    
    // Optional: If you want to store plain_password (unhashed), don't hash it
    $user->plain_password = $request->input('password'); // Storing raw password (not hashed)

    // Save the user
    if ($user->save()) {
        // Insert permissions manually using a foreach loop
        if ($request->has('permissions')) {
            foreach ($request->input('permissions') as $permissionId) {
                DB::table('user_permissions')->insert([
                    'user_id' => $user->id,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'User Created Successfully.');
    } else {
        return redirect()->back()->with('error', 'User Creation Failed.');
    }
}

        // start function for the edit roles and permission
    public function editUser($id){
        $user=AdminModel::with(['permissions.cmsPermissionGroup'])->where('id',$id)->first();
      
        $permissions = PermissionGroup::with('cmsPermissionGroups')->orderBy('id','asc')->get();
        $attoerneys=AttorneysModel::where('status',operator: 'yes')->orderBy('id','asc')->get();
        $mainCategory=MainCategoryModel::where('status','yes')->orderBy('id','asc')->get();
        return view("admin_panel.softwareusers.edit_permissions",compact('permissions','attoerneys','mainCategory','user'));

    }
    public function updateUserPermission($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_no' => 'nullable|string|max:12',
            'user_image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'ip_address' => 'required|ip',
            'password' => [
                'required',
                'string',
                'min:8',
            ],
            'role' => 'required|string', 
            'permissions' => 'required|array',
            'status' => 'required',
            'permissions.*' => 'exists:cms_group_permissions,id',
        ]);
    
        $user = AdminModel::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->status = $request->input('status');
        $user->user_id = Auth::user()->id;
    
        // Handle user image
        if ($request->hasFile('user_image')) {
            // Check if user image exists
            if ($user->user_image) {
                $existingImagePath = 'storage/uploads/admins_images/' . $user->user_image;
                if (file_exists(public_path($existingImagePath))) {
                    unlink(public_path($existingImagePath));
                }
            }
            $file = $request->file('user_image');
            $path = 'uploads/admins_images/';
            $fileName = compressImageToSize($file, $path, 250);
            $user->user_image = $fileName;
        }
    
        $user->ip_address = $request->input('ip_address');
        $user->password = Hash::make($request->input('password'));
        $user->plain_password = $request->input('password');
    
        if ($user->update()) {
            // Remove old permissions
            $user->permissions()->delete();
    
            // Add new permissions
            foreach ($request->input('permissions') as $permissionId) {
                $user->permissions()->create([
                    'permission_id' => $permissionId,
                ]);
            }
    
            return redirect()->back()->with('success', 'User Updated Successfully.');
        } else {
            return redirect()->back()->with('error', 'User Update Failed.');
        }
    }
    
    
}
