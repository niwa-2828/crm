<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\InertiaTest;

class InertiaController extends Controller
{
    public function index()
    {
        //resources\js\Pages\Inertia\index.vueへ
        return Inertia::render('Inertia/Index',[
         "blogs" => InertiaTest::all()   
        ]);
    }

    public function create()
    {
        //resources\js\Pages\Inertia\Create.vueへ
        return Inertia::render('Inertia/Create');
    }

    public function show($id)
    {
        return Inertia::render('Inertia/Show', [
            'id' => $id,
            'blog' => InertiaTest::findOrFail($id)
        ]);
    }
    public function delete($id)
    {
        $book=InertiaTest::findOrfail($id);
        $book->delete();
        
        return to_route('inertia.index')->with([
            "message"=>"削除しました"
        ]);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
     
        $inatia = new InertiaTest;
        $inatia->title = $request->title;
        $inatia->content = $request->content;
        $inatia->save();
        
        return to_route('inertia.index')->with([
            "message"=>"登録しました。"
        ]);
    }
}
