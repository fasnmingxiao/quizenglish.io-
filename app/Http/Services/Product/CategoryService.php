<?php

namespace App\Http\Services\Product;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryService
{
    protected $categoryRepository;
    function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    function createTopic($request)
    {
        try {
            $this->categoryRepository->create(
                [
                    'name' => $request->get('name'),
                ]
            );
            Session::flash('success', 'Add topic success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    function checkUnique($name)
    {
        return $this->categoryRepository->checkUnique($name);
    }
    function showDetail($id)
    {
        return $this->categoryRepository->showDetail($id);
    }
    function getTopic()
    {
        return $this->categoryRepository->getTopic();
    }
    function search($key)
    {
        return $this->categoryRepository->search($key);
    }
    function searchAll($key)
    {
        return $this->categoryRepository->searchAll($key);
    }
    function searchDefault()
    {
        return $this->categoryRepository->searchDefault();
    }
    function getAll()
    {
        return $this->categoryRepository->getAll();
    }
    function searchTopic($key)
    {
        return $this->categoryRepository->searchTopic($key);
    }
    function getChildrenTopic($id)
    {
        return $this->categoryRepository->getChildrenTopic($id);
    }
    function storeCategory($request, $img)
    {
        try {
            $this->categoryRepository->create([
                'name' => $request->get('categoryName'),
                'parent_id' => $request->get('topic'),
                'description' => $request->get('description'),
                'thumb' => $img
            ]);
            Session::flash('success', 'Add category success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return $error;
        }
    }
    function update($request)
    {
        try {
            $this->categoryRepository->update([
                'name' => $request->get('nameTopic'),
            ], $request->get('idTopic'));
            Session::flash('success', 'Edit topic success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    function delete($id)
    {
        try {
            $this->categoryRepository->delete($id);
            Session::flash('success', 'Delete category success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
    function deleteTopic($id)
    {
        try {
            return $this->categoryRepository->deleteTopic($id);
        } catch (\Exception $error) {
            return false;
        }
    }
    function deleteAjax($id)
    {
        try {
            return $this->categoryRepository->delete($id);
        } catch (\Exception $error) {
            return false;
        }
    }
    function get($id)
    {
        try {
            return  $this->categoryRepository->get($id);
        } catch (\Exception $error) {
            return false;
        }
    }
    function getAjax($id)
    {
        try {
            return  $this->categoryRepository->get($id);
        } catch (\Exception $error) {
            return false;
        }
    }
    function updateCat($request, $img)
    {
        try {
            $this->categoryRepository->update([
                'name' => $request->get('newNameCategory'),
                'parent_id' => $request->get('topic') ?? 0,
                'thumb' => $img ?? '',
                'description' => $request->get('newDesCategory') ?? '',
            ], $request->get('idcat'));
            Session::flash('success', 'Update success!');
        } catch (\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }
    }
}
