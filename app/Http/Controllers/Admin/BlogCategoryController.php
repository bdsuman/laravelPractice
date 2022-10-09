<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['blogCategories'] = BlogCategory::get();
        // $data['blogCategories'] = BlogCategory::withTrashed()->get();
        return view('admin.blogCategory.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'valid' => 'required',
        ]);

        if ($validator->passes()) {

            // $obj = new BlogCategory();
            // $obj->name = $request->name;
            // $obj->valid = $request->valid;
            // $obj->save();

            BlogCategory::create([
                'name'     => $request->name,
                'valid'    => $request->valid,
            ]);
           // Toastr::success('Category created successfully', 'Success');
            Alert::success('Success Title', 'Success Message');
        } else {
            $errMsgs = $validator->messages();
            foreach ($errMsgs->all() as $msg) {
                Toastr::error($msg, 'Required');
            }
        }

        return redirect()->back();
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
        $data['blogCategoryInfo'] = BlogCategory::find($id);
        return view('admin.blogCategory.update', $data);
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
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'valid' => 'required',
        ]);

        if ($validator->passes()) {
            BlogCategory::find($id)->update([
                'name'     => $request->name,
                'valid'    => $request->valid,
            ]);
            Toastr::success('Category Updated successfully', 'Success');
        } else {
            $errMsgs = $validator->messages();
            foreach ($errMsgs->all() as $msg) {
                Toastr::error($msg, 'Required');
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlogCategory::find($id)->delete();
        //Toastr::success('Category Deleted successfully', 'Success');
        //return redirect()->back();
    }
}
