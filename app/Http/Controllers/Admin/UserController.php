<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('admin.user.listData', $data);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->passes()) {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ]);
            Toastr::success('User created successfully', 'Success');
        } else {
            $errMsgs = $validator->messages();
            foreach ($errMsgs->all() as $msg) {
                Toastr::error($msg, 'Required');
            }
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $data['userInfo'] = User::find($id);
        return view('admin.user.update', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->passes()) {
            User::find($id)->update([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ]);
            Toastr::success('User Updated successfully', 'Success');
        } else {
            $errMsgs = $validator->messages();
            foreach ($errMsgs->all() as $msg) {
                Toastr::error($msg, 'Required');
            }
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        Toastr::success('User Deleted successfully', 'Success');
        return redirect()->back();
    }

}
