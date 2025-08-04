<div class="counter-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="counter-title text-center">
                    <h2>Power, Performance, Promise — That’s the Munna & Brothers Commitment</h2>
                </div>
            </div>

            @foreach ($achievements as $achievement)
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="counter-wrapper mb-30">
                    <div class="counter-text text-center">
                        <h2><span class="counter">{{ $achievement->count_number }}</span>+</h2>
                        <span>{{ $achievement->title }}</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
