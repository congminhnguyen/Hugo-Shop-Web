<?php

namespace App\Helpers;

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
                        <td>'. $category->active .'</td>
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
}
