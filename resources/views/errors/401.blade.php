@extends ('layouts.admin')
@section ('contenido')
    <section class="moduler wrapper_404">
        <div class="error-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="wow fadeInUp animated cd-headline slide" data-wow-delay=".4s" >401</h1>
                            <h2 class="wow fadeInUp animated" data-wow-delay=".6s">Opps! Se ha producido un error de permiso</h2>
                            <p class="wow fadeInUp animated" data-wow-delay=".9s">No tiene los permisos respectivos para ingresar a esta parte del sistema...</p>
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
