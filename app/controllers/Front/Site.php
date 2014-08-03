<?php

namespace Front;
use Admin\Exclusives;
use Model\Blog;
use Model\Exclusive;
use Model\Thread, View;
class Site extends \Base {

    public function home() {
        $subreddit = "trap";
        Thread::download($subreddit, Thread::HOT);
        $builder = Thread::where("subreddit", "=", $subreddit)
            ->orderBy('votes', 'desc')
            ->where("type", "=", Thread::HOT)
            ->where("embed_thumbnail", "NOT LIKE", "%fb_placeholder.png%")
            ->where("embed_thumbnail", "!=", "");
        $all_threads = $builder->get(array("id","url"));
        $threads = $builder->paginate(12);;
        return View::make("home")
            ->with("title", "Home")
            ->with("threads", $threads)
            ->with("all_threads", $all_threads);
    }

    public function hot($subreddit="trap") {
        Thread::download($subreddit, Thread::HOT);
        $threads = Thread::where("subreddit", "=", $subreddit)->where("type", "=", Thread::HOT);
        return View::make("hot")
            ->with("title", "Hot")
            ->with("threads", $threads->paginate(15))
            ->with("all_threads", $threads->get(array("id", "url")))
            ->with("subreddit", $subreddit)
            ->with("headline", "Hot")
            ->with("description", "See what trapaholics are listening to right now");
    }

    public function top($subreddit="trap") {
        Thread::download($subreddit, Thread::TOP);
        $threads = Thread::where("subreddit", "=", $subreddit)->where("type", "=", Thread::TOP);
        return View::make("hot")
            ->with("title", "Top")
            ->with("threads", $threads->paginate(15))
            ->with("all_threads", $threads->get(array("id", "url")))
            ->with("subreddit", $subreddit)
            ->with("headline", "Top")
            ->with("description", "100% hood certified material");

    }

    public function about() {
        return View::make("about")
            ->with("title", "About");
    }

    public function blog() {
        return View::make("blog")
            ->with("title", "Blog")
            ->with("posts", Blog::paginate(5));
    }

    public function exclusives() {;
        return View::make("exclusives")
            ->with("exclusives", Exclusive::paginate(15))
            ->with("all_exclusives", Exclusive::all(["id", "link"]))
            ->with("title", "Exclusives");
    }

    public function exclusive($slug) {
        $exclusive = Exclusive::whereSlug($slug)->firstOrFail();
        return View::make("exclusive")
            ->with("exclusive", $exclusive)
            ->with("all_exclusives", Exclusive::all(["id", "link"]))
            ->with("title", $exclusive->title);
    }

    public function radio() {
        $radio = new \Trapped\Radio();
        return View::make("radio")
            ->with("radio", $radio)
            ->with("title", "Radio");
    }

    public function radioApi() {
        return (new \Trapped\Radio())->api();
    }
}