//TRAPPED PLAYER V1
var Player = {
    init:function() {
        $(".trapped-player-play").click(function(e) {
            e.preventDefault();
            Player.stream($(this).data("url"), $(this).data("id"));
        });
        if(!Player.initialized) {
            $(".player .next").click(function(e) {
                e.preventDefault();
                if($(this).hasClass("disable")) return;
                Player.next();
            })
            $(".player .prev").click(function(e) {
                e.preventDefault();
                if($(this).hasClass("disable")) return;
                Player.prev();
            })
            $(".player .pause").click(function(e) {
                e.preventDefault();
                if($(this).hasClass("disable")) return;
                Player.setPlaying(false);
            })
            $(".player .play").click(function(e) {
                e.preventDefault();
                if($(this).hasClass("disable")) return;
                Player.setPlaying(true);
            })
            SC.initialize({
                client_id: "23aca29c4185d222f2e536f440e96b91"
            });
            soundManager.setup({
                url: '/swf/',
                flashVersion: 9,
                preferFlash: true, // prefer 100% HTML5 mode, where both supported
                debugMode: true
            });
            setInterval(Player.refreshRadioInfo, 10000);

            Player.lock();
        }
        Player.navChange();
        Player.initialized = true;
    },
    initialized: false,
    navChange: function() {
        if(window.location.toString().substr(-9, 9) == "?autoplay" && Player.playlist.length > 0) {
            Player.startPlaylist();
        }
    },
    sounds: [],
    setCurrentTrack: function(track) {
        var player = $(".player");
        player.find(".title").find(".author").text(track.user.username);
        player.find(".title").find(".name").text(track.title);
        if(!track.artwork_url) player.find(".artwork").attr("src", track.user.avatar_url).show();
        else player.find(".artwork").attr("src", track.artwork_url).show();
        player.find(".listenon").attr("href", track.permalink_url).show();
    },
    canNavigate: function() {
        var player = $(".player");
        if(Player.radioPlaying) {
            player.find(".next").addClass("disable");
            player.find(".prev").addClass("disable");
            return;
        }
        if(typeof Player.playlist[Player.playlistId+1] == "undefined")
            player.find(".next").addClass("disable");
        else player.find(".next").removeClass("disable");

        if(typeof Player.playlist[Player.playlistId-1] == "undefined")
            player.find(".prev").addClass("disable");
        else player.find(".prev").removeClass("disable");
    },
    appendTitle: function(){
        if(Player.playing && document.title.substr(0,2) != "► ") document.title = "► "+document.title;
        else if(!Player.playing && document.title.substr(0,2) == "► ") document.title = document.title.substr(2, document.title.length);
    },
    playing: false,
    setPlaying: function(playing) {
        Player.playing = playing;
        Player.appendTitle();
        if(playing)
            $(".player .play").parent().addClass("active");
        else $(".player .play").parent().removeClass("active");

        if(!playing)
            $(".player .pause").parent().addClass("active");
        else $(".player .pause").parent().removeClass("active");

        if(Player.radioPlaying) {
            if(playing)
                $.each(Player.sounds, function(i, sound) {
                    if(typeof sound != "undefined") sound.play();
                });
            else {
                $.each(Player.sounds, function(i, sound) {
                    if(typeof sound != "undefined") sound.stop();
                });
            }
        } else {
            if(!playing)
                $.each(Player.sounds, function(i, sound) {
                    if(typeof sound != "undefined") sound.pause();
                });
            else
                $.each(Player.sounds, function(i, sound) {
                    if(typeof sound != "undefined") sound.play({
                        onfinish: Player.next,
                        onplay: function() {
                            if(this.readyState == 2) {
                                Player.playbackError();
                                return;
                            }
                            Player.unlock();
                            Player.canNavigate();
                        },
                        onload: function() {
                            if(this.readyState == 2) {
                                Player.playbackError();
                                return;
                            }
                        }
                    });
                });
        }
    },
    next: function() {
        Player._nextprev(true);
    },
    prev: function() {
        Player._nextprev(false);
    },
    _nextprev: function(forward) {
        var newid = Player.playlistId + (forward ? 1 : -1);
        if(Player.playlistId != null && typeof Player.playlist[newid] != "undefined") {
            Player.playlistId = newid;
            Player.stream(Player.playlist[Player.playlistId], Player.playlistId);
        }
    },
    lock: function() {
        $(".player .controls li a").addClass("disable");
    },
    unlock: function() {
        $(".player .controls li a").removeClass("disable");
    },
    playlistId: null,
    stream:function(url, id) {
        if(Player.loading) return;
        Player.playlistId = id;
        $(".player").addClass("visible");
        if(typeof $(".player .title").attr("data-original-title") != "undefined") $(".player .title").popover("destroy")

        $.each(Player.sounds, function(i, sound) {
            if(typeof sound != "undefined") sound.destruct();
            Player.sounds[i] = undefined;
        })
        Player.radioPlaying = false;
        Player.loading = true;
        Player.lock();
        try {
            SC.get("/resolve", { url: url }, function(track) {
                if(track.errors) {
                    Player.playbackError();
                    return;
                }

                Player.setCurrentTrack(track);
                SC.stream(track.stream_url, function(sound) {
                    Player.sounds.push(sound);
                    Player.setPlaying(true);
                    Player.loading = false;
                })
            })
        }
        catch(e) {
            Player.playbackError();
        }
    },

    playbackError: function() {
        //OH GOD ABORT ABORT
        Player.playing = false;
        Player.loading = false;
        Player.radioPlaying = false;

        //KILL IT, KILL IT ALL
        $.each(Player.sounds, function(i, sound) {
            if(typeof sound != "undefined") sound.destruct();
            Player.sounds[i] = undefined;
        });

        Player.lock();
        $('.player .title').popover({
            trigger: 'manual',
            title: "Playback error!",
            content: "Something went wrong, perhaps try again later.",
            placement: "top"
        }).popover("show");
    },

    startPlaylist: function() {
        if(Player.playlist.length > 0 && typeof Player.playlist[1] != "undefined") {
            Player.stream(Player.playlist[1], 1);
        } else throw "Attempted to start playlist, but none currently loaded."
    },
    setPlaylist: function(arr) {
        Player.playlist = arr;
    },
    playlist: [],

    loading:false,

    radioPlaying: false,
    streamRadio: function() {
        if(Player.loading) return;
        if(typeof $(".player .title").attr("data-original-title") != "undefined") $(".player .title").popover("destroy")
        $(".player").addClass("visible");
        //kill other streams if any
        $.each(Player.sounds, function(i, sound) {
            if(typeof sound != "undefined") sound.destruct();
            Player.sounds[i] = undefined;
        });

        Player.lock();
        Player.radioPlaying = true;
        Player.loading = true;
        Player.refreshRadioInfo();
        var player = $(".player");
        player.find(".title").find(".author").text("TRAPPED.IO RADIO");
        player.find(".title").find(".name").text("");
        player.find(".artwork").hide();
        player.find(".listenon").hide();
        var firstPlay = true;
        var sound = soundManager.createSound({
            id: "trappedRadio",
            url: 'http://radio.trapped.io:8000/TRAPPED',
            autoPlay: true,
            autoLoad: true,

            onload: function() {
                if(this.readyState == 2) {
                    Player.playbackError();
                    return;
                }
            },
            onplay: function() {
                if(!firstPlay) return;
                else firstPlay = false;
                if(this.readyState == 2) {
                    Player.playbackError();
                    return;
                }
                Player.loading = false;
                console.info("radio: we out there");
                Player.unlock();
                Player.setPlaying(true);
                Player.canNavigate();
            },
            ondataerror: function() {
                Player.playbackError();
            }
        });
        Player.sounds.push(sound);
    },
    refreshRadioInfo: function() {
        if(!Player.radioPlaying) return false;
        $.getJSON("/radio/api", function(radio) {
            var player = $(".player");
            player.find(".title").find(".author").text("TRAPPED.IO RADIO");
            player.find(".title").find(".name").html(radio.current_song);
            player.find(".artwork").hide();
            player.find(".listenon").hide();
        })
    }
};

$(document).ready(Player.init).bind("trapped:nav", Player.init);