
<section class="valuesPart">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <a href="{{ url('/event') }}">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Event
                    @else
                        ইভেন্ট
                    @endif
                </h2>
            </a>
        </header>

        @if(!$Event->isEmpty())
            <div class="row">
                @foreach($Event as $key=>$EventItem)
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ url('/event')."/".$EventItem->event_id }}">
                            <div class="box">
                                <img src="{{asset($EventItem->event_image)}}" class="img-fluid" alt="">
                                <span class="post-date">
                                    @if(session()->get('locale') == 'en')
                                        {{ date('d M Y', strtotime($EventItem->created_date)) }}
                                    @else
                                        {{ bn_date(date('d M Y', strtotime($EventItem->created_date))) }}
                                    @endif
                                </span>
                                <h3>
                                    @if(session()->get('locale') == 'en')
                                        {{ $EventItem->event_en_title }}
                                    @else
                                        {{ $EventItem->event_bn_title }}
                                    @endif
                                </h3>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>


@section('EventScript')
    <script>

    </script>
@endsection


