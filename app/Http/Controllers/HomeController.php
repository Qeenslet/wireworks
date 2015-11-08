<?php namespace App\Http\Controllers;

use App\Classes\Helpers\Arrays;
use App\Classes\Savers\productDeleter;
use App\Classes\Savers\productSaver;
use App\Classes\Savers\productUpdater;
use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $locs = [];
        foreach(\App\Location::week()->get() as $one)
        {
            $locs[] = \Scriptixru\SypexGeo\SypexGeoFacade::get($one->ip);
        }
        $locations = new \App\Classes\Mapper($locs);
        return view('home', compact('locations'));
	}

    public function newUser()
    {
        return view('auth.register');
    }

    public function newProduct()
    {
        $message = \Session::get('message');
        $cats = \App\Category::all();
        return view('admin.addProduct', compact('cats', 'message'));
    }

    public function postProduct(Requests\productAddRequest $request)
    {
        $data = $request->except('_token');
        $saver = new productSaver($data);
        $saver->save();
        if($saver->getStatus())
            $message = 'Работа успешно добавлена';
        else
            $message = $saver->getError();
        return back()->with('message', $message);
    }

    public function ajaxImage(Request $request)
    {
        $data = $request->all();
        $data['files']->move('media/uploads/temporary/', $data['files']->getClientOriginalName());
    }

    public function productList()
    {
        $message = \Session::get('message');
        $list = \App\Product::all();
        $dimensions = Arrays::dimensionNames();
        return view('admin.list', compact('list', 'dimensions', 'message'));
    }

    public function productEdit($id)
    {
        $product = \App\Product::find($id);
        $cats = \App\Category::all();
        if($product)
        {
            $pData = unserialize($product->data);
            return view('admin.edit', compact('product', 'pData', 'cats'));
        }
        else
            return redirect()->back();
    }

    public function postProductEdit(Requests\productAddRequest $request)
    {
        $data = $request->except('_token', 'pId');
        $pId = $request->input('pId');
        $saver = new productUpdater($pId, $data);
        $saver->save();
        if($saver->getStatus())
            $message = 'Работа успешно изменена';
        else
            $message = $saver->getError();
        return redirect(route('productList'))->with('message', $message);

    }

    public function deleteProduct(Request $request)
    {
        $id = $request->input('id');
        $deleter = new productDeleter($id);
        $deleter->delete();
        return redirect()->back();
    }

    public function catList()
    {
        $categories = \App\Category::all();
        return view('admin.catList', compact('categories'));
    }

    public function catEdit(Request $request)
    {
        $id = $request->input('id');
        if($id != 'new')
        {
            $category = \App\Category::find($id);
            return view('admin.catEdit', compact('category'));
        }
        else
        {
            return view('admin.catNew');
        }
    }

    public function catApplyChange(Requests\catUpdater $request)
    {
        $data = $request->except('_token');
        $target = \App\Category::find($data['id']);
        $target->name = $data['catName'];
        $target->url = $data['catUrl'];
        $target->save();
        return redirect()->back();
    }

    public function catNew(Requests\catUpdater $request)
    {
        $data = $request->except('_token');
        \App\Category::create($data);
        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->input('id');
        $deleter = new \App\Classes\Savers\categoryDeleter($id);
        $deleter->delete();
        return redirect()->back();
    }

}
