<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\NewsDescription;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class AuthorizedController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() //Auth pro celý kontroler
    {
        $this->middleware('auth');
    }

    public function news()
    {
        $response = Http::acceptJson()->withToken('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')->get('https://api.github.com/repos/PetrHorak123/PilaSystem/commits');

        $result = [];

        foreach ($response->json() as $commit) {

            $itemToAdd = new CommitViewModel();
            
            $itemToAdd->date = date("d.m.y", strtotime($commit["commit"]["committer"]["date"]));
            $itemToAdd->message = $commit["commit"]["message"];
            $itemToAdd->url = $commit["html_url"];
            $itemToAdd->author = $commit["commit"]["author"]["name"];
            $itemToAdd->sha = $commit["sha"];
            $itemToAdd->desc = NewsDescription::where('sha', $commit["sha"])->firstOr(function () {
                $temp = new NewsDescription;
                $temp->description = "Zatím bez popisu";
                return $temp;
            })->description;

            array_push($result, $itemToAdd);
        }

        return view('pages.novinky')->with("commits", $result);
    }
    public function post_news_desc(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'sha' => 'required',
        ]);

        $newDesc = NewsDescription::where('sha', $request->sha)->firstOr(function () {
            return new NewsDescription; 
        });

        $newDesc->description = $request->description;
        $newDesc->sha = $request->sha;

        $newDesc->save();
        
        return back();
    }

    function get_categories()
    {
        $articles = Article::all();

        $categories = [];

        foreach ($articles as $value) {
            if (!in_array($value->category, $categories)) {
                array_push($categories, $value->category);
            }
        }

        return $categories;
    }

    function get_latest_news()
    {
        $response = Http::acceptJson()->withToken('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')->get('https://api.github.com/repos/PetrHorak123/PilaSystem/commits');

        $itemToAdd = new CommitViewModel();        
            
        $result = [];

        foreach (array_slice($response->json(), 0, 3) as $commit) {

            $itemToAdd = new CommitViewModel();
            
            $itemToAdd->date = date("d.m.y", strtotime($commit["commit"]["committer"]["date"]));
            $itemToAdd->message = $commit["commit"]["message"];
            $itemToAdd->url = $commit["html_url"];
            $itemToAdd->author = $commit["commit"]["author"]["name"];
            $itemToAdd->sha = $commit["sha"];
            $itemToAdd->desc = NewsDescription::where('sha', $commit["sha"])->firstOr(function () {
                $temp = new NewsDescription;
                $temp->description = "Zatím bez popisu";
                return $temp;
            })->description;

            array_push($result, $itemToAdd);
        }

        return $result;
    }

    public function docs()
    {
        return view('pages.docs')
            ->with('articles', Article::all())
            ->with('categories', $this->get_categories())
            ->with('novinky', $this->get_latest_news());
    }

    public function docs_cat($category)
    {
        $articles = Article::where('category', $category)->get();

        return view('pages.docs')
            ->with('articles', $articles)
            ->with('categories', $this->get_categories())
            ->with('novinky', $this->get_latest_news())
            ->with('cat_reset', true);
    }

    public function docs_search(Request $request)
    {

        $articles = Article::all();

        $result_articles = [];

        foreach ($articles as $value) {
            if (str_contains(strtolower($value->name), strtolower($request->term))) {
                array_unshift($result_articles, $value);
            }
            elseif (str_contains(strtolower($value->text), strtolower($request->term))) {
                array_push($result_articles, $value);
            }
        }

        return view('pages.docs')
            ->with('articles', $result_articles)
            ->with('categories', $this->get_categories())
            ->with('novinky', $this->get_latest_news())
            ->with('search_reset', $request->term);
    }

    public function newarticle()
    {
        if (Auth::user()->admin == true) {
            
            return view('pages.NewArticle');
        }
        else {
            return view('pages.home');
        }
    }
    
    public function post_newarticle(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'content' => 'required'
        ]);

        $newArticle = new Article;
        $newArticle->name = $request->name;
        $newArticle->category = $request->category;
        $newArticle->text = $request->content;
        $newArticle->user_id = Auth::user()->id;
        $newArticle->description = $request->popis;
        $newArticle->save();

        return redirect('docs');
    }

    public function article_detail($article)
    {
        $result = Article::find($article);

        return view('pages.Article')
            ->with('article', $result)
            ->with('comments', $result->comments );
    }

    public function post_comment(Request $request, $article)
    {
        $this->validate($request, [
            'comment' => 'required',
        ]);

        $newComment = new Comment;
        $newComment->text = $request->comment;
        $newComment->article_id = $article;
        $newComment->user_id = Auth::user()->id;
        $newComment->save();

        return redirect()->route('article_detail', ['article' => $article]);
    }

    public function editarticle($article)
    {
        $result = Article::find($article);

        return view('pages.EditArticle')->with('article', $result);
    }

    public function post_edited_article(Request $request, $article)
    {
        $result = Article::find($article);

        $result->name = $request->name;
        $result->category = $request->category;
        $result->text = $request->content;
        $result->user_id = Auth::user()->id;
        $result->description = $request->popis;
        $result->save();

        return redirect('docs');
    }

    public function deletearticle($article)
    {
        $obj = Article::find($article);

        foreach ($obj->comments as $key => $comment) {
            Comment::destroy($comment->id);
        }

        Article::destroy($article);

        return redirect('docs');
    }
}

class CommitViewModel
{
    public $date;
    public $message;
    public $url;
    public $author;
    public $sha;
    public $desc;
}
