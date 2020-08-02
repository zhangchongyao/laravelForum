<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic, User $user)
    {
        //得去分类ID关联的话题，并按每20条分页
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->with('user', 'category')
            ->paginate(10);
        $active_users = $user->getActiveUsers();
        //传参变量话题和分类到模板中
        return view('topics.index', compact('topics', 'category', 'active_users'));
    }
}
