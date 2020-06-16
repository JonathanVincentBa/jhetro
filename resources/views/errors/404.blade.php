@extends ('layouts.admin')
@section('contenido')
    <section class="moduler wrapper_404">
        <div class="error-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="wow fadeInUp animated cd-headline slide" data-wow-delay=".4s" >404</h1>
                            <h2 class="wow fadeInUp animated" data-wow-delay=".6s">Opps! Tienes algunos problemas</h2>
                            <p class="wow fadeInUp animated" data-wow-delay=".9s">La página que está buscando se movió, eliminó, renombró o quizás nunca existió.</p>
                            <a href="/admin" class="btn btn-info btn-rounded waves-effect waves-light m-b-40" data-wow-delay="1.1s">Ir a Inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <link rel="stylesheet" href="{{ asset('adminlte/css/style.css') }}">
    @endpush
@endsection