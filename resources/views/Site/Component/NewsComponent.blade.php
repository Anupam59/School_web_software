
<section class="NewsPart">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <a href="{{ url('/news') }}">
                <h2>
                    @if(session()->get('locale') == 'en')
                        News
                    @else
                        নিউজ
                    @endif
                </h2>
            </a>
        </header>

        @if(!$News->isEmpty())
            <div class="row">
                @foreach($News as $key=>$NewsItem)
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ url('/news')."/".$NewsItem->news_id }}">
                            <div class="post-box">
                                <div class="post-img">
                                    <img src="{{asset($NewsItem->news_image)}}" class="img-fluid" alt="">
                                </div>
                                <span class="post-date">
                                    @if(session()->get('locale') == 'en')
                                        {{ date('d M Y', strtotime($NewsItem->created_date)) }}
                                    @else
                                        {{ bn_date(date('d M Y', strtotime($NewsItem->created_date))) }}
                                    @endif
                                </span>
                                <h3>
                                    @if(session()->get('locale') == 'en')
                                        {{ $NewsItem->news_en_title }}
                                    @else
                                        {{ $NewsItem->news_bn_title }}
                                    @endif
                                </h3>
                                <a href="{{ url('/news')."/".$NewsItem->news_id }}" class="eadmore stretched-link mt-auto"><span>{{ __('message.read_more') }}</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section><!-- End Recent Blog Posts Section -->


@section('NewsScript')
    <script>

    </script>
@endsection


