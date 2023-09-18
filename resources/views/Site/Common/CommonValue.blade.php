<input type="hidden" id="baseUrl" value="{{ url('/') }}">
<input type="hidden" id="locale" value="{{ session()->get('locale') }}">
<input type="hidden" id="langVar" value="{{ request()->query('lang') }}">
