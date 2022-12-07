<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\CategoryService;
use App\Http\Services\Upload\UploadService;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class TopicAdminController extends Controller
{
    protected $categoryService;
    protected $uploadService;
    function __construct(CategoryService $categoryService, UploadService $uploadService)
    {
        $this->categoryService = $categoryService;
        $this->uploadService = $uploadService;
    }
    function index()
    {
        return view('admin.topic', ['title' => 'Admin topic', 'listTopic' => $this->categoryService->getAll()]);
    }

    function index_db()
    {
        $data = $this->categoryService->getAll();
        return view('admin.topic_db', ['title' => 'Topic & Category', 'data' => $data, 'listTopic' => $this->categoryService->getAll(), 'active'=> 'topic']);
    }
    function add_topic()
    {

        return view('admin.add_topic_db', ['title' => 'Topic ']);
    }
    function add_category()
    {
        $data = $this->categoryService->getAll();
        return view('admin.add_category_db', ['title' => 'Category', 'data' => $data]);
    }
    function checkUnique($name)
    {
        $data = $this->categoryService->checkUnique($name);
        return response()->json($data);
    }
    function createCategory()
    {
        return view('admin.addCategory', ['title' => 'Add Category Quizz', 'listTopic' => $this->categoryService->getTopic()]);
    }
    function createTopic(Request $request)
    {
        $this->categoryService->createTopic($request);
        return redirect()->back();
    }
    function storeCategory(Request $request)
    {
        $request->validate([
            'categoryName' => 'unique:App\Models\catTopic,name',
            'topic' => 'required'
        ]);
        if ($request->hasFile('file')) {
            $img =  $this->uploadService->storeThumbCategory($request);
        } else {
            return redirect()->back()->with('error', 'loi');
        }
        $this->categoryService->storeCategory($request, $img);
        return redirect()->back();
    }
    function getChildrenTopic($id)
    {
        return response()->json($this->categoryService->getChildrenTopic($id));
    }
    function update(Request $request)
    {
        $this->categoryService->update($request);
        return redirect()->back();
    }
    function delete($id)
    {
        $this->categoryService->delete($id);
        return redirect()->back();
    }
    function ajaxDelete($id)
    {
        $item = $this->categoryService->deleteTopic($id);
        if ($item == 0) {
            return response()->json(['error' => false, 'msg' => 'Delete fail']);
        }
        return response()->json(['error' => true, 'msg' => 'Delete success ' . $item . 'record']);
    }
    function getAjax($id)
    {
        $item = $this->categoryService->getAjax($id);
        if (isset($item)) {
            return response()->json($item);
        }
        return false;
    }
    function UpdateCat(Request $request)
    {
        // $request->validate([
        //     'newNameCategory' => 'required|max:255',
        // ]);
        if ($request->hasFile('file')) {
            $img =  $this->uploadService->storeThumbCategory($request);
        } else {
            $img = $request->get('old_thumb');
        }
        $this->categoryService->updateCat($request, $img);
        return redirect()->back();
    }
}
