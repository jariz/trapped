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
    <p>No. In fact, this is only costing us money.<br>TRAPPED is built entirely out of passion for reddit and trap.</p><p>No ads will ever be shown on Trapped</p>
    <p>As some people have expressed the desire to donate in IRC and PM's we will make these options avaliable. Donations will help cover server costs, and upgrades to a more powerful server. Donation options will be removed once costs are covered, and any extra contributions will be returned. A breakdown of how contributions have been and will be used is also avaliable on request.<p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHRwYJKoZIhvcNAQcEoIIHODCCBzQCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYCX0jPwxwZKzx8YQRsaBfZ1np0eJzD/M0n0hVDK7A14ybRqEKSV29OAvhjuGyYEduHHbxUYabd+IcolHcGqZZXfay6Q0XKSxoTs4H7ybv/iP2H3zw3TeE8ta8vk9jypVsl5H3i29upnYzmeWxv95zSxCrzbIMrxCL6fQgyF/p73PzELMAkGBSsOAwIaBQAwgcQGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIioyf1lGt30eAgaBDVdqQozrU/8wlLL0vMjOCCakEt7gSoKnEpg7f2wfuJugkftg6rxo9yXy+JB7/a+jJM9+lTuj902RdBeCMDY+WvNgfoB0rqnuCvtiJy2HcI8dTgTT0rb8QHkYDwg+Pct23/jQEELYKxH8d1HegcLn+7jF1hzzASdYvp0J5Tk5qvehbuWSptTB8U6fiRi00oQptolQmRu7xsktXHF/bSlhgoIIDhzCCA4MwggLsoAMCAQICAQAwDQYJKoZIhvcNAQEFBQAwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMB4XDTA0MDIxMzEwMTMxNVoXDTM1MDIxMzEwMTMxNVowgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDBR07d/ETMS1ycjtkpkvjXZe9k+6CieLuLsPumsJ7QC1odNz3sJiCbs2wC0nLE0uLGaEtXynIgRqIddYCHx88pb5HTXv4SZeuv0Rqq4+axW9PLAAATU8w04qqjaSXgbGLP3NmohqM6bV9kZZwZLR/klDaQGo1u9uDb9lr4Yn+rBQIDAQABo4HuMIHrMB0GA1UdDgQWBBSWn3y7xm8XvVk/UtcKG+wQ1mSUazCBuwYDVR0jBIGzMIGwgBSWn3y7xm8XvVk/UtcKG+wQ1mSUa6GBlKSBkTCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb22CAQAwDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQUFAAOBgQCBXzpWmoBa5e9fo6ujionW1hUhPkOBakTr3YCDjbYfvJEiv/2P+IobhOGJr85+XHhN0v4gUkEDI8r2/rNk1m0GA8HKddvTjyGw/XqXa+LSTlDYkqI8OwR8GEYj4efEtcRpRYBxV8KxAW93YDWzFGvruKnnLbDAF6VR5w/cCMn5hzGCAZowggGWAgEBMIGUMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbQIBADAJBgUrDgMCGgUAoF0wGAYJKoZIhvcNAQkDMQsGCSqGSIb3DQEHATAcBgkqhkiG9w0BCQUxDxcNMTQwODA1MTUwODM3WjAjBgkqhkiG9w0BCQQxFgQUChAi0T9uzVwc09WtH7QWfANfgngwDQYJKoZIhvcNAQEBBQAEgYCV0XHsqnIaHzIM+xoDv+g12DkKjK+sgFTffkmOi2aPGkyHmYvIOumTAEN6FaYfO7YGzPOjeTxYRF4dyBrRtAqca+8u7dwyheixMDQZgOKmc1Rmv0UjH904OMxwWJ5lToyg2QxtHFdBSxgEtSx6pjYGPT889VNdlj+SPpZHnMUhzQ==-----END PKCS7-----
    ">
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form> <p>Our webhost also accepts Bitcoin, so we would gladly accept donations to <b>18EYTXrkZRKYPE3ictrHoVR1xDSd45Bm3T</b></p>
  



    <h4>I found a bug!</h4>
    <p>Report them to our <a target="_blank" href="https://github.com/jariz/trapped/issues">bugtracker</a>.</p>

    <p class="text-muted pull-right" style="margin-top:20px;"><small>Built by: <a href="http://jari.io"><img style="margin-left:10px;" src="{{url('img/jari.png')}}"></a></small></p>
</div>
@stop