@extends($plain ? "plain" : "layout")

@section('content')
<div class="container">
    <div class="page-header">
        <h1>About</h1>
    </div>
    <h4>What?</h4>
    <p>Trapped is is a (soundcloud) link aggregator for the <a target="_blank" href="http://reddit.com/r/trap">trap subreddit</a><br>The goal of trapped is simple. <span style="font-style: italic">To find more music.</span></p>

    <h4>Why?</h4>
    <p>
        We believe that we can provide the community with more than what we're providing right now on reddit.<br>
        Trapped was made because we want to:
    </p>
    <ul>
        <li>Make /r/trap better browsable, with a user-friendly UI.</li>
        <li>Have a community run radio that's available 24/7.</li>
        <li>Provide up-and-coming artists a platform to promote their music on.</li>
        <li>Make /r/trap easy to listen to with a player that allows you to easily shift trough the music on /r/trap.</li>
        <li>Reach out better to our community trough our blog.</li>
    </ul>

    <h4>Who's running it?</h4>
    <p>The site is ran by both the /r/trap moderators as the /r/trap community.</p>

    <h4>But I'm fine with what we have on reddit!</h4>
    <p>Think of trapped as an extension of /r/trap, not a competitor. Without /r/trap, there would be no trapped.</p>

    <h4>Why is only soundcloud content supported?</h4>
    <p>In the beta, we will only be supporting Soundcloud and our 24/7 radio stream, in the future we may integrate other services such as youtube.</p>

    <h4>Do you make any money with this site?</h4>
    <p>No. In fact, this is only costing us money.<br>TRAPPED is built entirely out of passion for reddit and trap.</p>
    <p>No ads will ever be shown on TRAPPED.</p>

    <h4>I found a bug!</h4>
    <p>Report them to our <a target="_blank" href="https://github.com/jariz/trapped/issues">bugtracker</a>.</p>

    <p class="text-muted pull-right" style="margin-top:20px;"><small>Built by: <a href="http://jari.io"><img style="margin-left:10px;" src="{{url('img/jari.png')}}"></a></small></p>
</div>
@stop