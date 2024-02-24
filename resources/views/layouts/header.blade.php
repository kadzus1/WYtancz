<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/css/images/icon.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('storage/css/main1.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

 
    

</head>
<body class="homepage is-preload">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 z-10 mt-8 text-center">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Tablica</a>
            @else
                <a href="{{ route('login') }}" class="flex items-center font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    <i class="fas fa-key fa-lg mr-2"></i> Logowanie
                </a>
    
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 flex items-center font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <i class="fas fa-user-plus fa-lg mr-2"></i> Rejestracja
                    </a>
                @endif
            @endauth
        </div>
    @endif
    
    

                        
                </div>
    <div id="page-wrapper">

        <!-- Header -->
        <section id="header">
            <div class="container">

                <!-- Logo -->
                <h1 id="logo" style="color: #7b0000;"><a href="{{ route('welcome') }}">WYtańcz</a></h1>
                <p>Portal dla miłośników tańca.</p>

                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li><a href="{{ route('creators') }}" class="icon solid fa-comment"><span>Twórcy</span></a> </li>
                        <li><a class="icon brands fa-blogger-b" href="{{ route('blog') }}"><span>Blog</span></a></li>
                        <li>
                            <a class="icon solid fa-trophy" href="{{ route('tournaments.tournament') }}">
                                <span>Turnieje</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="fas fa-shopping-cart"><span>Sklep z odzieżą</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </section>

    
@yield('content')



        <!-- Banner -->
        <section id="banner">
            <div class="container">
                <p><strong>Łączy nas taniec</strong></p>
            </div>
        </section>

        <!-- Main -->

        <!-- Footer -->
        <section id="footer">
            <div class="container">
                <header>
                    <h2>Pytanie lub komentarz? <strong>Jesteśmy w kontakcie:</strong></h2>
                </header>
                <div class="row">
                    <div class="col-6 col-12-medium">
                        <section>
                            <form method="post" action="#">
                                <div class="row gtr-50">
                                    <div class="col-6 col-12-small">
                                        <input name="name" placeholder="Imię" type="text" />
                                    </div>
                                    <div class="col-6 col-12-small">
                                        <input name="email" placeholder="Email" type="text" />
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" placeholder="Wiadomość"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <a href="#" class="form-button-submit button icon solid fa-envelope">Wyślij wiadomość</a>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                    <div class="col-6 col-12-medium">
                        <section>
                            <div class="row">
                                <div class="col-6 col-12-small">
                                    <ul class="icons">
                                        <li class="icon solid fa-home">
                                            1234 Będzińska<br />
                                            Sosnowiec, 41-205<br />
                                            Polska
                                        </li>
                                        <li class="icon solid fa-phone">
                                            (000) 000-0000
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 col-12-small">
                                    <ul class="icons">
                                        <li class="icon solid fa-envelope">
                                            <a href="#">biuro@admin.pl</a>
                                        </li>
                                        <li class="icon brands fa-instagram">
                                            <a href="#">instagram.com/untitled</a>
                                        </li>
                                        <li class="icon brands fa-facebook-f">
                                            <a href="#">facebook.com/untitled</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>

        

    </div>


</body>
</html>
