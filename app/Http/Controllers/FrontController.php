<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


use App\Text;
use Illuminate\Http\Request;

class FrontController extends Controller {

    /**
     *
     */
    public function index(){
        $message = session('message');
        $dirCour = 'media/img/top';
        if ($carousel = opendir($dirCour)) {
            $topPicQu = 0;
            while (false !== ($file = readdir($carousel))) {
                    if ($file === '.' or $file === '..') continue;
                    $topPicQu += 1;
            }
        }

        return view('index.front', compact('dirCour', 'topPicQu', 'message'));

    }
    public function stat($targetPage) {
        $content=Text::Page($targetPage)->firstOrFail();
        return view('template.general', compact('content'));
    }

    public function category($name){
        $content = Category::where('url', $name)->first();
        $products = $content->products()->get();
        $currency = session('currency');
        //$currency = 'BYR';
        return view('template.categoryDisplay', compact('content', 'products', 'currency'));
    }

    public function product($id)
    {
        $product = \App\Product::find($id);
        $pData = unserialize($product->data);
        $dimensions = \App\Classes\Helpers\Arrays::dimensionNames();
        //$currency = session('currency');
        $currency = 'RUB';
        return view('template.singleProduct', compact('product', 'pData', 'dimensions', 'currency'));
    }

}
