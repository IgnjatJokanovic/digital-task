<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use Validator;
use JWTAuth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('user')->paginate(6);
        if (!$articles->isEmpty()) {
            return response()->json($articles, 200);
        } else {
            return response()->json(['messages' => ['There are no articles yet created']], 404);
        }
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'img' => 'required',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = array();
            foreach ($validator->errors()->all() as $error) {
                array_push($errors, $error);
            }
            return response()->json(["messages" => $errors], 422);
        } else {
            $user = JWTAuth::parseToken()->authenticate();
            $article = new Article();
            $img = request()->input('img');
            if ($img != '') {
                $file = base64_decode(substr($img, strpos($img, ",") + 1));
                $name = time() . ".png";
                \File::put(public_path() . "/img/$name", $file);
                $article->img = url('/img') . "/$name";
            }
            $article->title = request()->title;
            $article->body = request()->body;
            $article->user_id = $user->id;
            if ($article->save()) {
                return response()->json(["message" => "Created new article"], 201);
            }
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article->delete()) {
            return response()->json(['message' => 'Deleted article'], 200);
        }
    }

    public function edit($id)
    {
        $article = Article::find($id);
        if (!$article->isEmpty()) {
            return response()->json($article, 201);
        } else {
            return response()->json("Article not found", 404);
        }
    }

    public function update($id)
    {

        $validator = Validator::make(request()->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = array();
            foreach ($validator->errors()->all() as $error) {
                array_push($errors, $error);
            }
            return response()->json(["messages" => $errors], 422);
        } else {
            $article = Article::find($id);
            if ($article != null) {
                $article->title = request()->title;
                $article->body = request()->body;
                if (request()->has('img')) {
                    $img = request()->has('img');
                    $file = base64_decode(substr($img, strpos($img, ",") + 1));
                    $name = time() . ".png";
                    \File::put(public_path() . "/img/$name", $file);
                    $article->img = url('/img') . "/$name";
                }
                $article->update();
                return response()->json("Updated", 201);
            } else {
                return response()->json("Article not found", 404);
            }
        }
    }

    public function editorUpload()
    {
        $file = request()->file('upload');
        $name = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/img/blog', $name);
        $path = '/img/blog' . "/$name";
        $message = '';
        return response()->json(["uploaded" => 1, "fileName" => $name, "url" => $path]);
    }
}
