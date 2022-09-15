<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['blog'] = Blog::get();
        // $data['blogCategories'] = BlogCategory::withTrashed()->get();
        return view('admin.blog.listData', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['blogCategories'] = BlogCategory::get();
        return view('admin.blog.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'category_id'  => 'required',
            'title'  => 'required',
            'description'  => 'required',
            'description'  => 'required',
            'valid' => 'required',
        ]);

        if ($validator->passes()) {

            // $obj = new BlogCategory();
            // $obj->name = $request->name;
            // $obj->valid = $request->valid;
            // $obj->save();

            Blog::create([
                'category_id'     => $request->category_id,
                'title'     => $request->title,
                'sub_title'     => $request->sub_title,
                'description'     => $request->description,
                'thumbnail'     => $request->thumbnail,
                'valid'    => $request->valid,
            ]);
            Toastr::success('Blog Created successfully', 'Success');
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
        $data['blogCategories'] = BlogCategory::get();
        $data['blog'] = Blog::find($id);
        return view('admin.blog.update', $data);
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
       //dd($request->all());
       $validator = Validator::make($request->all(), [
        'category_id'  => 'required',
        'title'  => 'required',
        'description'  => 'required',
        'description'  => 'required',
        'valid' => 'required',
    ]);

    if ($validator->passes()) {

        Blog::find($id)->update([
            'category_id'     => $request->category_id,
            'title'     => $request->title,
            'sub_title'     => $request->sub_title,
            'description'     => $request->description,
            'thumbnail'     => $request->thumbnail,
            'valid'    => $request->valid,
        ]);
        Toastr::success('Blog Updated Successfully', 'Success');
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
        //
    }
}
