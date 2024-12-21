<?php

namespace App\Http\Controllers\API;

use App\Models\Dua;
use App\Models\DuaCategory;
use App\Traits\apiresponse;
use App\Models\DuaSubcategory;
use App\Http\Controllers\Controller;

class DuaController extends Controller
{
    use apiresponse;
    /**
     * Get All Dua Categories
     * @return \Illuminate\Http\Response
     */
    public function DuaCategories()
    {
        $duaCategories = DuaCategory::where('status', 'active')->latest()->get(['id', 'title']);
        return $this->success([
            'categories' => $duaCategories,
        ], "Dua Categories fetched successfully", 200);
    }

    /**
     * Get All Dua
     * @return \Illuminate\Http\Response
     */
    public function GetDua($cat_id)
    {
        $duaCategories = DuaCategory::where('id', $cat_id)->with('duas')->where('status', 'active')->first();
        return $this->success([
            'dua' => $duaCategories,
        ], "Dua fetched successfully", 200);
    }

    /**
     * Get Dua Details
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function DuaDetails($id)
    {
        $duaCategories = Dua::where('id', $id)->with('category')->where('status', 'active')->first();
        return $this->success([
            'dua' => $duaCategories,
        ], "Dua fetched successfully", 200);
    }

    /**
     * Get All Dua SubCategories
     * @return \Illuminate\Http\Response
     */
    public function DuaSubCategories($cat_id)
    {
        $duaSubCategories = DuaSubcategory::select('id', 'title')
            ->where('category_id', $cat_id)
            ->latest()
            ->get();

        if (!$duaSubCategories) {
            return $this->error("Subcategories not found", 404);
        }

        return $this->success([
            'subcategories' => $duaSubCategories,
        ], "Dua SubCategories fetched successfully", 200);
    }


    public function SubCatGetDua($subcat_id)
    {
        $duaSubCategory = DuaSubcategory::with(['duas' => function($query) {
                $query->where('status', 'active');
            }])
            ->where('id', $subcat_id)
            ->first();

        if (!$duaSubCategory) {
            return $this->error("Subcategory not found", 404);
        }

        return $this->success([
            'dua' => $duaSubCategory->duas,
        ], "Dua fetched successfully", 200);
    }

}
