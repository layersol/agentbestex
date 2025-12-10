@include('layouts.header')

@section('content')
<div style="text-align:center; padding:80px;">
    <h1 style="font-size:80px; font-weight:bold; color:#ff4d4d;">404</h1>
    <h3>Page Not Found</h3>
    <p>The page you are looking for does not exist.</p>

    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Home</a>
</div>
@endsection
@include('layouts.footer')
