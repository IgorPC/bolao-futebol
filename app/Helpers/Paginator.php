<?php


namespace App\Helpers;

use Illuminate\Http\Request;

class Paginator
{
    public static function paginate($pagination, Request $request)
    {
        $pagination = $pagination['elements'];
        if($request->has('page')){
            $actual = $request->page;
        }else{
            $actual = 1;
        }
        $defaultUrl = explode('?', $pagination[0][1]);
        $pagination['current'] = (int)$actual;
        $pagination['url'] = $defaultUrl[0];
        return $pagination;
    }
}
