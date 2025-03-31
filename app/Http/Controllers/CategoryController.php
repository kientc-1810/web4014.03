<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // query builder
        // $query = DB::table('categories')->orderBy('id','desc');

        // if($request->has('search')){
        //     $query->where('name','like','%'.$request->search.'%');
        // }
        
        // $categories = $query -> paginate(5);
        // return view('categories.index',compact('categories'));

        // eloquent
        $query = Category::query();
        if($request->has('search')){
            $query->where('name','like','%'.$request->search.'%');
        }
        $categories = $query->orderBy('id','desc')->paginate(5);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // DB::table('categories')->insert([
        //    'name' => $request -> name,
        //    'status' => (bool) $request ->status,
        // ]);
        

        //eloquent
        Category::create($request->validated());
        return redirect()->route('categories.index')->with('success',"Thêm thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // querybuilder
        // // lấy được dữ liệu của để chỉnh sửa
        // $category = DB::table('categories')->where('id',$id)->first();
        // // đẩy dữ liệu chỉnh sửa lên form
        // return view('categories.edit',compact('category'));

        //eloquent
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // DB::table('categories')->where('id',$id)->update([
        //     'name' => $request -> name,
        //     'status' => (bool) $request ->status,
        // ]);

        //eloquent
        $category->update($request->validated());
        return redirect()->route('categories.index')->with('success',"Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // DB::table('categories')->where('id',$id)->delete();
        // return redirect()->route('categories.index')->with('success','Xóa thành công');

        //eloquent
        $category->delete();
        return redirect()->route('categories.index')->with('success',"Xóa thành công");
    }
}
