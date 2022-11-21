<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Carbon\Carbon;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $brands = Brand::latest()->get();

        return view('admin.brand.index', compact('brands'));
    }

    public function Store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name'
        ]);


        Brand::insert([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Brand added');
    }

    public function Edit($brand_id)
    {
        $brand = Brand::find($brand_id);

        return view('admin.brand.edit',compact('brand'));
    }

    public function UpdateBrand(Request $request){
        $brand_id = $request->id;

        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name'
        ]);

        Brand::find($brand_id)->update([
            'brand_name' => $request->brand_name,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('admin.brand')->with('Catupdated','Brand Updated');
    }

     //Delete category

     public function Delete($brand_id)
     {
         Brand::find($brand_id)->delete();

         return Redirect()->route('admin.brand')->with('delete','Brand Deleted');
     }

     //Update status

    public function Inactive($brand_id)
    {
        Brand::find($brand_id)->update([
            'status' => 0,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('Catupdated','Brand Inactive');
    }

    public function Active($brand_id)
    {
        Brand::find($brand_id)->update([
            'status' => 1,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('Catupdated','Brand Active');
    }
}
