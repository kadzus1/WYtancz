@extends('layouts.header')

@section('content')
<section id="features">
    <div class="container">
        <header>
            <h2><strong style="color: #7b0000;">NOWOŚCI!</strong></h2>
        </header>
        <div class="row aln-center">
            <!-- Feature 1 -->
            <div class="col-4 col-6-medium col-12-small">
                <section>
                    <a href="#" class="image featured"><img src="{{ asset('assets/css/images/ballerina.jpg') }}" alt="" /></a>
                    <header>
                        <h3>Ciekawostki o balecie</h3>
                    </header>
                    <p>Interesujesz się baletem? Chcesz zacząć przygodę <br>z tym tańcem klasycznym? <strong><br>Poznaj kilka ciekawostek!</strong></p>
                </section>
            </div>
            <!-- Feature 2 -->
            <div class="col-4 col-6-medium col-12-small">
                <section>
                    <a href="#" class="image featured"><img src="{{ asset('assets/css/images/bidon.jpg') }}" alt="" /></a>
                    <header>
                        <h3>Nowe bidony już w sprzedaży!</h3>
                    </header>
                    <p>Ogromne niekapki, <strong>idealne na mocny trening!</strong> Sprawdź jak najszybciej!</p>
                </section>
            </div>
            <!-- Feature 3 -->
            <div class="col-4 col-6-medium col-12-small">
                <section>
                    <a href="#" class="image featured"><img src="{{ asset('assets/css/images/koncert.jpg') }}" alt="" /></a>
                    <header>
                        <h3>Koncert Noworoczny 2023</h3>
                    </header>
                    <p>Już za nami Koncert Noworoczny Zespołu - <strong>przeczytaj opis i zobacz zdjęcia!</strong></p>
                </section>
            </div>
        </div>
    </div>
</section>

@endsection
