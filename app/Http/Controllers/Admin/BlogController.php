<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        //$data['blog'] = Blog::get();
        // $data['blog'] = DB::table('blogs AS b')
        //             ->select('bc.name','b.id','b.title','b.sub_title','b.description','b.thumbnail','b.valid')
        //             ->join('blog_categories AS bc', function ($join) {
        //                 $join->on('b.category_id', '=', 'bc.id');
        //             })->get();
        
        $data['blog'] = DB::table('blogs AS b')
            ->select('bc.name','b.id','b.title','b.sub_title','b.description','b.thumbnail','b.valid')
            ->join('blog_categories AS bc','b.category_id', '=', 'bc.id')
            ->get();
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
            'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',

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
                'thumbnail'   =>  Helpers::fileUploader($request->thumbnail, public_path('uploads/blogThumb')),
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
        //'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
    ]);

    if ($validator->passes()) {
        // dd($request->thumbnail);
        // return $request->thumbnail;
      //  return $request->file('thumbnail')->getSize();
        if(!empty($request->thumbnail)){
            //return 'Image Uploded';
            $thumbnail = Helpers::fileUploader($request->thumbnail, public_path('uploads/blogThumb'));
        }else{
           // return 'Image Not Uploded';
            $thumbnail = $request->oldthumbnail;
        }

       //return $thumbnail;

        Blog::find($id)->update([
            'category_id'     => $request->category_id,
            'title'     => $request->title,
            'sub_title'     => $request->sub_title,
            'description'     => $request->description,
            'thumbnail'     => $thumbnail,
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
        Blog::find($id)->delete();
        Toastr::success('Category Deleted successfully', 'Success');
        return redirect()->back();
    }
    
}
