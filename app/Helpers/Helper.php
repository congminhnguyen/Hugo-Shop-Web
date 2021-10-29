<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper
{
    public static function category($categories, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($categories as $key => $category) {
            if ($category->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>'. $category->id .'</td>
                        <td>'. $char . $category->name .'</td>
                        <td>'. self::active($category->active) .'</td>
                        <td>'. $category->updated_at .'</td>
                        <td>
                            <a href="/admin/categories/edit/'. $category->id .'" class="btn btn-primary btn-sm">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow('. $category->id .', \'/admin/categories/destroy\')">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($categories[$key]);

                $html .= self::category($categories, $category->id, $char .'&emsp;|--');
            }
        }
        return $html;
    }

    public static function active($active = 0){
        return $active == 0 ? '<span class="btn btn-xs btn-danger">No</span>' : '<span class="btn btn-xs btn-success">Yes</span>';
    }

    public static function categories($categories, $parent_id = 0){
        $html = '';
        foreach($categories as $key => $category){
            if($category->parent_id == $parent_id){
                $html .= '
                    <li>
                        <a href="/category/' . $category->id . '-' . Str::slug($category->name, '-') . '.html">
                            ' . $category->name . '
                        </a> ';

                    unset($category[$key]);

                    if(self::isChild($categories, $category->id)){
                        $html .= '<ul class="sub-menu">'; 
                        $html .= self::categories($categories, $category->id);
                        $html .= '</ul>';
                    }

                    $html .= '</li>
                ';
            }
        }
        return $html;
    }

    public static function isChild($categories, $id){
        foreach($categories as $category){
            if($category->parent_id == $id){
                return true;
            }
        }

        return false;
    }
}
