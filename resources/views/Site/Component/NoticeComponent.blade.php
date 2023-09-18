<section class="NoticePart">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <a href="{{ url('/notice') }}">
                <h2>
                    @if(session()->get('locale') == 'en')
                        Notice
                    @else
                        নোটিশ
                    @endif
                </h2>
            </a>
        </header>

        @if(!$Notice->isEmpty())
            <div class="row">
                @foreach($Notice as $key=>$NoticeItem)
                    <div class="col-md-6 mb-3" data-aos="zoom-out" data-aos-delay="200">
                        <a href="{{ url('/notice')."/".$NoticeItem->notice_id }}">
                            <div class="feature-box">
                                <div class="CheckText">
                                    <i class="bi bi-check"></i>
                                    <h3>
                                        @if(session()->get('locale') == 'en')
                                            {{ $NoticeItem->notice_en_title }}
                                        @else
                                            {{ $NoticeItem->notice_bn_title }}
                                        @endif
                                    </h3>
                                </div>
                                @if($NoticeItem->notice_file)
                                    <div class="checkDown">
                                        <span><i class="bi bi-download"></i></span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section><!-- End Features Section -->



@section('NoticeScript')

@endsection


