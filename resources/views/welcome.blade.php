<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rudy Inc. | @yield('title')</title>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .carousel-inner,.carousel-item, .d-block{
            height: 500px;
        }
    </style>


</head>
<body>
    @include('nav.nav') {{-- navigation --}}
    

    <div class="container mt-5 p-2">

            <div class="header p-3">
                <div class="header row justify-content-center" style="height:500px;">
                    <div class="sidenav col-md-4 d-flex justify-content-between flex-column">
                        <div class="p2 text-center">
                            <img class="w-100 h-80" src="/storage/home_images/LOGO.png" alt="Logo">
    
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate autem cumque vitae, delectus qui excepturi neque unde nisi! Tempore placeat consequuntur obcaecati quisquam ad fuga numquam, ipsa minima necessitatibus facere!</p>
                        </div>
                        <div class="mb p-2">
                            <a href="{{url('/login')}}" class="btn btn-primary btn-lg btn-block">Get Started!</a>
                        </div>
                    </div>{{-- end of sidenav --}}
                    
                    <div class="main col-md-8"> {{-- start main --}}
                    
                        <div class="card"> {{-- start card --}}
                        
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img class="d-block w-100 mh-50" src="{{asset('/storage/home_images/home_image1.jpg')}}" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100 mh-50" src="{{asset('/storage/home_images/home_image2.jpg')}}" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100 mh-50" src="{{asset('/storage/home_images/home_image3.jpg')}}" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>{{-- end of carousel --}}                    
                        </div>{{-- end of card --}}
                    </div> {{-- end of main --}}
                
                </div>{{-- end of row1 --}}
            </div> {{-- end of header --}}
            

        <div class="features-section row">
            <div class="feature-title">
                <h1 class="text-center">Features</h1>
            </div>{{-- end of feature-title --}}
            
            <div class="feature-item">
                <div class="item">
                    <img class="w-50 h-80" src="/storage/home_images/Repair.png" alt="Repair">
                    <h2>Repair</h2>
                    <div class="feature-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut a recusandae consequuntur.</div>
                </div>
                <div class="item">
                    <img class="w-50 h-80" src="/storage/home_images/Make.png" alt="Make">
                    <h2>Repair</h2>
                    <div class="feature-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut a recusandae consequuntur.</div>
                </div>
                <div class="item">
                    <img class="w-50 h-80" src="/storage/home_images/Sell.png" alt="Sell">
                    <h2>Repair</h2>
                    <div class="feature-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut a recusandae consequuntur.</div>
                </div>
            </div>
        </div> {{-- end of feature-item --}}
        
        <footer class="row">
            <div>
                <p>Copyrights</p>
            </div>
        </footer>
    </div> {{-- end of container --}}
    
    </body>
</html>
