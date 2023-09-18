
<style>
    .ImportantPart{
        background-image: url({{asset('Site/assets/img/countbg.jpg')}});
    }
</style>

<section class="ImportantPart">
    <div class="container" data-aos="fade-up">

        <header class="section-header">
            <h2 style="color: #ffffff">
                @if(session()->get('locale') == 'en')
                    Important Link
                @else
                    গুরুত্বপূর্ণ লিঙ্ক
                @endif
            </h2>
        </header>

        @if(!$Link->isEmpty())
            <div class="row ImLink">
                @foreach($Link as $key=>$LinkItem)
                    <div class="col-lg-3 col-md-4 col-12 mb-3" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ $LinkItem->link_url }}" target="_blank">
                            @if(session()->get('locale') == 'en')
                                {{ $LinkItem->link_en_title }}
                            @else
                                {{ $LinkItem->link_bn_title }}
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
