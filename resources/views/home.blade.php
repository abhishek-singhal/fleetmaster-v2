<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FleetMaster Events</title>
    <link href="{{asset('evento/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('evento/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('evento/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('evento/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('evento/css/responsive.css')}}" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('evento/images/logo.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('evento/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('evento/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('evento/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('evento/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head>
<body>
    <header id="header" role="banner">
        <div class="main-nav">
            <div class="container">
                <div class="header-top">
                    <div class="pull-right social-icons">
                        <a href="https://www.twitch.tv/fleetmasterevents" target="_blank"><i class="fa fa-twitch"></i></a>
                        <a href="https://www.facebook.com/fleetmasterevents" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="http://steamcommunity.com/groups/Fleetmasterevents" target="_blank"><i class="fa fa-steam"></i></a>
                        <!-- <a href="#"><i class="fa fa-google-plus"></i></a> -->
                        <!-- <a href="https://www.youtube.com/channel/UCB4v41NcRe8mgV526froswA" target="_blank"><i class="fa fa-youtube"></i></a> -->
                    </div>
                </div>
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-brand">
                            <img class="img-responsive" src="{{asset('evento/images/logo.png')}}" alt="logo">
                        </span>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="scroll active"><a href="#home">Home</a></li>
                            <li class="scroll"><a href="#explore">Events</a></li>
                            <li class="scroll"><a href="#event">Team</a></li>
                            <!-- <li class="scroll"><a href="#sponsor">Gallery</a></li> -->
                            <li class="scroll"><a href="#about">About</a></li>
                            <li class="scroll"><a href="#contact">Contact</a></li>
                            <li><a class="no-scroll" href="/login">Staff Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="home">
        <div id="main-slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="{{asset('evento/images/slider/3.png')}}" alt="slider">

                </div>
                <div class="item">
                    <img class="img-responsive" src="{{asset('evento/images/slider/2.png')}}" alt="slider">
                </div>
                <div class="item">
                    <img class="img-responsive" src="{{asset('evento/images/slider/4.png')}}" alt="slider">
                </div>
            </div>
        </div>
    </section>

    <section id="explore">
        <div class="container">
            <div class="row">
                <div class="watch">
                    <img class="img-responsive" src="{{asset('evento/images/watch.png')}}" alt="image">
                </div>
                <div class="col-md-4 col-md-offset-2 col-sm-5">
                    <h2><a href="#" target="_blank" id="notnecessary">EVENT NAME</a></h2>
                </div>
                <div class="col-sm-7 col-md-6">
                    <ul id="countdown">
                        <li>
                            <span class="days time-font" id="dayss"></span>
                            <p>days </p>
                        </li>
                        <li>
                            <span class="hours time-font" id="hourss"></span>
                            <p class="">hours </p>
                        </li>
                        <li>
                            <span class="minutes time-font" id="minutess"></span>
                            <p class="">minutes</p>
                        </li>
                        <li>
                            <span class="seconds time-font" id="secondss"></span>
                            <p class="">seconds</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!--/#explore-->

    <script>
            var upgradeTime = 1000000; //remaining seconds
            var seconds = upgradeTime;
            function timer() {
              var days = Math.floor(seconds / 86400);
              var hoursLeft = Math.floor((seconds) - (days * 86400));
              var hours = Math.floor(hoursLeft / 3600);
              var minutesLeft = Math.floor((hoursLeft) - (hours * 3600));
              var minutes = Math.floor(minutesLeft / 60);
              var remainingSeconds = seconds % 60;
              if (remainingSeconds < 10) {
                remainingSeconds = "0" + remainingSeconds;
            }
            document.getElementById('dayss').innerHTML = +days;
            document.getElementById('hourss').innerHTML = +hours;
            document.getElementById('minutess').innerHTML = +minutes;
            document.getElementById('secondss').innerHTML = +remainingSeconds;
            if (seconds == 0) {
                clearInterval(countdownTimer);
                document.getElementById('notnecessary').innerHTML = "Event Started";
            } else {
                seconds--;
            }
        }
        var countdownTimer = setInterval('timer()', 1000);
    </script>

    <section id="event">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="event-carousel" class="carousel slide" data-interval="false">
                        <h2 class="heading">our team</h2>
                        <a class="even-control-left" href="#event-carousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                        <a class="even-control-right" href="#event-carousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
                        <div class="carousel-inner">
                            <div class="item active">
                                @php $count = 0;@endphp
                                @foreach($members as $member)
                                @if($count == 8)
                                @php $count=0;@endphp
                            </div>
                            <div class="item">
                                @endif
                                @php $count++;@endphp
                                <div class="col-md-3">
                                    <div class="single-event">
                                        <a href="https://steamcommunity.com/profiles/{{$member->steam_id}}" target="_blank">
                                            <img class="img-responsive" src="{{$member->avatar}}" alt="event-image">
                                        </a>
                                        <h4>
                                            <a href="https://truckersmp.com/user/{{$member->tmp_id}}" target="_blank"><font color="white">{{$member->tmp_name}}</font></a>
                                        </h4>
                                        <h5>
                                            {{$member->role}}
                                        </h5>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section id="about">
        <div class="guitar2">
            <img class="img-responsive" src="{{asset('evento/images/slider/1.png')}}" alt="about">
        </div>
        <div class="about-content">
            <h2>About us</h2>
            <p>
                Welcome to FleetMasterEvents.
            </p>
            <p>
                No - We are certainly not a VTC. FleetMasterEvents was inspired from two main things: nothing but passion and devotion to events and the love for the community.
            </p>
            <p>
                We specialise in creating high quality events - those which features weekly convoys dedicated solely for the community.
            </p>
            <!--<p>
                Unlike VTC's we dont expect deliveries to be made, paintjobs and tags to be worn 24/7, driver tracking or anything similair. As said before, we focus on bringing the TruckersMP community events which they will enjoy on Saturday nights.
            </p>-->
            <!-- <a href="#" class="btn btn-primary">View Date &amp; Place <i class="fa fa-angle-right"></i></a> -->
        </div>
    </section>

    <section id="contact">
        <div class="contact-section">
            <div class="ear-piece">
                <iframe src="https://discordapp.com/widget?id=280015767292870656&theme=dark" width="350" height="505" allowtransparency="true" frameborder="0">
                </iframe>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-4">
                        <div class="contact-text">
                            <h3>TeamSpeak 3</h3>
                            <address>
                                <a href="ts3server://elslogistics.gigats.pw">elslogistics.gigats.pw</a><br>
                            </address>
                        </div>
                        <div class="contact-address">
                            <h3>Contact</h3>
                            <address></address>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div id="contact-section">
                            <h3>Send a message</h3>
                            <div class="status alert alert-success" style="display: none"></div>
                            <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Email ID">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="4" placeholder="Enter your message"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="hit" value="Send" class="btn btn-primary pull-right">
                                </div>
                            </form>
                            <div id="result"></div>
                            <script type="text/javascript" src="{{asset('/evento/js/jquery.min.js')}}"></script>
                            
                            <script>
                                $("#main-contact-form").submit(function () {
                                    if ($("#name").val() == null || $("#name").val() == "" || $("#email").val() == null || $("#email").val() == "" || $("#message").val() == null || $("#message").val() == "") {
                                        $("#result").html("Fill the empty fields.");
                                    }else {
                                        var name = $("#name").val();
                                        var email = $("#email").val();
                                        var message = $("#message").val();
                                        var csrf = $("input[name='_token']").val();
                                        var dataString = "name=" + name + "&email=" + email + "&message=" + message+"&csrf="+csrf;
                                        $.ajax({
                                            url: "contact/create", data: dataString, success: function (data) {
                                                $("#result").html(data);
                                            }
                                        });
                                        $('#name, #email, #message').val('');
                                    }
                                    return false;
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div class="container">
            <div class="text-center">
                <p>&copy;2017 FleetMaster Events</p>
                <p> All Rights Reserved</p>
                <!-- <a href="#">Privacy</a> | <a href="#">Terms of Service</a> | <a href="#">Sitemap</a> | <a href="#">Changelog</a> -->
                Made by <a target = "_blank" href = "http://steamcommunity.com/id/orang-e">Orange</a>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="{{asset('evento/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('evento/js/smoothscroll.js')}}"></script>
    <script type="text/javascript" src="{{asset('evento/js/jquery.parallax.js')}}"'></script>
    <script type="text/javascript" src="{{asset('evento/js/coundown-timer.js')}}"></script>
    <script type="text/javascript" src="{{asset('evento/js/jquery.scrollTo.js')}}"></script>
    <script type="text/javascript" src="{{asset('evento/js/jquery.nav.js')}}"></script>
    <script type="text/javascript" src="{{asset('evento/js/main.js')}}"></script>

</body>
</html>