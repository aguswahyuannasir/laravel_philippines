<?php

namespace App\Http\Controllers\UserMatrix;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $objects = User::where('FlgMitra', '=', 0)->get();
        return view('usrmatrix.user.index', compact('objects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role = Role::where('FlgAktif', '=', true)->get();
        $listrole = $role->reduce(function ($roleLookup, $role) {
            $roleLookup[$role['IdRole']] = $role['Label'];
            return $roleLookup;
        }, []);

        return view('usrmatrix.user.create', compact('listrole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(!$request->input('FlgAktif')) $request['FlgAktif'] = false;
        if(!$request->input('FlgLDAP')) $request['FlgLDAP'] = false;
        
        $input = $request->all();
        $rules = [];
        $messages = [
            'NmUser.required' => 'Silahkan isi nama',
            'UserLogin.required' => 'Silahkan isi user login',
            'IdRole.required' => 'Silahkan pilih role',
            'NmUser.unique' => 'Nama sudah digunakan',
            'UserLogin.unique' => 'User Login sudah digunakan',
            'Password.required' => 'Silahkan isi password',
        ];
        
        if($request->input('FlgLDAP') == true) {
            $rules = [
                'NmUser' => 'required|unique:RfUser,NmUser',
                'UserLogin' => 'required|unique:RfUser,UserLogin',
                'IdRole' => 'required'
            ];
        } else {
            $rules = [
                'NmUser' => 'required|unique:RfUser,NmUser',
                'UserLogin' => 'required|unique:RfUser,UserLogin',
                'Password' => 'required',
                'IdRole' => 'required'
            ];
        }
        Validator::make($input, $rules, $messages)->validate();


        DB::beginTransaction();
        try {
            DB::table('RfUser')->insert([
                'NmUser' => $request->input('NmUser'),
                'UserLogin' => $request->input('UserLogin'),
                'Password' => $request->input('Password') ? Hash::make($request->input('Password')) : null,
                'IdRole' => $request->input('IdRole'),
                'FlgAktif' => $request->input('FlgAktif'),
                'FlgLDAP' => $request->input('FlgLDAP'),
                'FlgMitra' => false,
                'TglRecord' => date('Y-m-d H:i:s'),
                'IdUserRecord' => auth()->user()->getAuthIdentifier()
            ]);

            DB::commit();
            return redirect()->route('usrmatrix.user.index')->with('status', 'User Berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withError($e->getMessage())->withInput();
        }

        return view('usrmatrix.user.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $role = Role::where('FlgAktif', '=', true)->get();
        $listrole = $role->reduce(function ($roleLookup, $role) {
            $roleLookup[$role['IdRole']] = $role['Label'];
            return $roleLookup;
        }, []);


        return view('usrmatrix.user.create', compact('user', 'listrole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        if(!$request->input('FlgAktif')) $request['FlgAktif'] = false;
        if(!$request->input('FlgLDAP')) $request['FlgLDAP'] = false;

        $input = $request->all();
        $rules = [];
        $messages = [
            'NmUser.required' => 'Silahkan isi nama',
            'UserLogin.required' => 'Silahkan isi user login',
            'IdRole.required' => 'Silahkan pilih role',
            'NmUser.unique' => 'Nama sudah digunakan',
            'UserLogin.unique' => 'User Login sudah digunakan',
        ];

        $data = [
            'NmUser' => $request->input('NmUser'),
            'UserLogin' => $request->input('UserLogin'),
            'IdRole' => $request->input('IdRole'),
            'FlgAktif' => $request->input('FlgAktif'),
            'FlgLDAP' => $request->input('FlgLDAP'),
            'FlgMitra' => false,
            'TglUpdate' => date('Y-m-d H:i:s'),
            'IdUserUpdate' => auth()->user()->getAuthIdentifier()
        ];

        if($request->input('FlgLDAP') == true) {
            $rules = [
                'NmUser' => 'required',
                'UserLogin' => 'required',
                'IdRole' => 'required'
            ];
            
            if($user->NmUser != $request->input('NmUser')) {
                $rules['NmUser'] = 'required|unique:RfUser,NmUser';
            }

            if($user->UserLogin != $request->input('UserLogin')) {
                $rules['UserLogin'] = 'required|unique:RfUser,UserLogin';
            }
        } else {
            $rules = [
                'NmUser' => 'required',
                'UserLogin' => 'required',
                'IdRole' => 'required'
            ];

            if($user->Password === null) {
                $rules['Password'] = 'required';
                $data['Password'] = Hash::make($request->input('Password'));
            } else {
                if($request->input('Password')) {
                    $data['Password'] = Hash::make($request->input('Password'));
                }
            }

            if($user->NmUser != $request->input('NmUser')) {
                $rules['NmUser'] = 'required|unique:RfUser,NmUser';
            } 
            if($user->UserLogin != $request->input('UserLogin')) {
                $rules['UserLogin'] = 'required|unique:RfUser,UserLogin';
            }
        }
        Validator::make($input, $rules, $messages)->validate();
        
        DB::beginTransaction();
        try {
            DB::table('RfUser')->where('IdUser', '=', $id)
                ->update($data);
            
            DB::commit();

            return redirect()->route('usrmatrix.user.index')->with('status', 'User Berhasil diubah');
        } catch (\Exception $e) {
             DB::rollback();

            return back()->withError($e->getMessage())->withInput();
        }

        return view('usrmatrix.user.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('RfUser')->where('IdUser', '=', $id)->delete();

        return redirect()->route('usrmatrix.user.index')->with('status', 'User Berhasil dihapus');
    }
}
