
<style>
    .countsPart{
        background-image: url({{asset('Site/assets/img/countbg.jpg')}});
    }
</style>

<section class="countsPart">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $SiteCommon->site_student }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>
                            @if(session()->get('locale') == 'en')
                                Student
                            @else
                                শিক্ষার্থী
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <i class="bi bi-person-hearts" style="color: #ee6c20;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $TotalTeacher }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>
                            @if(session()->get('locale') == 'en')
                                Teacher
                            @else
                                শিক্ষক
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <i class="bi bi-people-fill" style="color: #15be56;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $TotalMember }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>
                            @if(session()->get('locale') == 'en')
                                Member
                            @else
                                সদস্য
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-2">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #bb0852;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="{{ $TotalStaffs }}" data-purecounter-duration="1" class="purecounter"></span>
                        <p>
                            @if(session()->get('locale') == 'en')
                                Staffs
                            @else
                                স্টাফ
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
