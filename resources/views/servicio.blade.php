@extends('layouts.app')


@section('contenido_js')
    
@endsection

@section('contenido_cSS')

@endsection


@section('content')
   

    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                <div class="col-md-6">
                    {{-- <h1 class="display-5 fw-bolder">{{ $serviceProfile->IntermediateUseTal->name }}&nbsp;{{ $serviceProfile->IntermediateUseTal->lastname }}</h1> --}}
                    <h1 class="display-5 fw-bolder">Electricista</h1>
                    <div class="fs-5 mb-5">
                        <span>$40.00</span>
                    </div>
                    <!-- Review usuarios-->
                    <div class="d-flex small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Contratar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

@endsection

@section('contenido_abajo_js')
<script>
</script>
    
@endsection