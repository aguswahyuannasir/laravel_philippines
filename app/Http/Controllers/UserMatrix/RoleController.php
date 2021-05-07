<?php

namespace App\Http\Controllers\UserMatrix;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;
use App\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index() {

        // 
        $objects = Role::all();
        return view('usrmatrix.role.index', compact('objects'));
    }

    public function create() {
        // 
        $permission = Permission::all();
        $listpermission = [];
        // foreach ($permission as $key => $value) {
        //     array_push($listpermission, (object)["IdPermission" => $value->IdPermission, "Label" => $value->Label, "Status" => false]);
        // }
        $listpermission = $permission->reduce(function ($permissionLookup, $permission) {
            $permissionLookup[$permission['IdPermission']] = (object)["Label" => $permission['Label'], "Status" => false];
            return $permissionLookup;
        }, []);
        // dd($listpermission);
        return view('usrmatrix.role.create', compact('listpermission'));
    }

    public function store(Request $request) {
        
        $input = $request->all();
        $rules = [
            'Nama' => 'required|unique:RfRole,Nama',
            'Label' => 'required|unique:RfRole,Label',
            'IdPermission' => 'required'
        ];
        $messages = [
            'Nama.required' => 'Silahkan isi Nama Role',
            'Label.required' => 'Silahkan isi Label Role',
            'IdPermission.required' => 'Silahkan pilih permission',
            'Nama.unique' => 'Nama Role sudah digunakan',
            'Label.unique' => 'Label Role sudah digunakan',
        ];
        Validator::make($input, $rules, $messages)->validate();

        if(!$request->input('FlgAktif')) $request['FlgAktif'] = false;
        DB::beginTransaction();
        try {
            $role = new Role;
            $role->Nama = $request->input('Nama');
            $role->Label = $request->input('Label');
            $role->FlgAktif = $request->input('FlgAktif');
            $role->TglRecord = date('Y-m-d H:i:s');
            $role->save();

            $latestrole = Role::max('IdRole');

            foreach ($request->IdPermission as $key => $value) {
                DB::table('RfRolePermission')->insert(
                    ['IdRole' => $latestrole, 'IdPermission' => $value]
                );
            }

            DB::commit();

            return redirect()->route('usrmatrix.role.index')->with('status', 'Role Berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withError($e->getMessage())->withInput();
        }

        return view('usrmatrix.role.create');
    }

    public function edit(Request $request, $id) {
        $editRole = Role::where("IdRole", "=", $id)->with('permissions')->get();
        $roles = $editRole[0];
        
        $editPermission = Permission::all();

        $permission = $editPermission->reduce(function ($editLookup, $edit) {
            $editLookup[$edit['IdPermission']] = (object)["Label" => $edit['Label'], "Status" => false];
            return $editLookup;
        }, []);

        $checkedpermission = $editRole[0]->permissions->reduce(function ($checkedLookup, $checked) {
            $checkedLookup[$checked['IdPermission']] = (object)["Label" => $checked['Label'], "Status" => true];
            return $checkedLookup;
        }, []);
        
        $listpermission = array_replace($permission, $checkedpermission);

        return view('usrmatrix.role.create', compact('roles', 'listpermission'));
    }

    public function update(Request $request, $id) {
        $role = Role::find($id);

        $input = $request->all();
        $rules = [
            'Nama' => 'required',
            'Label' => 'required',
            'IdPermission' => 'required'
        ];
        $messages = [
            'Nama.required' => 'Silahkan isi Nama Role',
            'Label.required' => 'Silahkan isi Label Role',
            'IdPermission.required' => 'Silahkan pilih permission',
            'Nama.unique' => 'Nama Role sudah digunakan',
            'Label.unique' => 'Label Role sudah digunakan',
        ];
        
        if($role->Nama != $request->input('Nama')) {
            $rules['Nama'] = 'required|unique:RfRole,Nama';
        }
        if($role->Label != $request->input('Label')) {
            $rules['Label'] = 'required|unique:RfRole,Label';
        }
        if(!$request->input('FlgAktif')) $request['FlgAktif'] = false;

        if(!$request['FlgAktif']){
            $usedOtherTran = User::where("IdRole", $id)->first();
            if($usedOtherTran != null)
                $rules['FlgAktif'] = 'required';
        }

        Validator::make($input, $rules, $messages)->validate();

        DB::beginTransaction();
        try {
            Role::where('IdRole', $id)->update(['Nama' => $request->input('Nama'), 'Label' => $request->input('Label'), 'FlgAktif' =>  $request->input('FlgAktif'), 'TglUpdate' => date('Y-m-d H:i:s')]);
            
            DB::table('RfRolePermission')->where('IdRole', '=', $id)->delete();

            foreach ($request->IdPermission as $key => $value) {
                DB::table('RfRolePermission')->insert(
                    ['IdRole' => $id, 'IdPermission' => $value]
                );
            }

            DB::commit();
            return redirect()->route('usrmatrix.role.index')->with('status', 'Role Berhasil diubah');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withError($e->getMessage())->withInput();
        }

        return view('usrmatrix.role.create');
    }

    public function destroy($id) {

        // 
        DB::beginTransaction();
        try {
            // Delete Role From RfRole
            Role::where("IdRole", "=", $id)->delete();

            // Delete Permission Relation
            DB::table('RfRolePermission')->where("IdRole", "=", $id)->delete();

            // Commit
            DB::commit();

            // Return view
            return redirect()->route('usrmatrix.role.index')->with('status', 'Role Berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withError($e->getMessage())->withInput();
        }
        return view('usrmatrix.role.index');
    }
}
