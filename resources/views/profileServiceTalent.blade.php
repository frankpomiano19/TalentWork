@extends('layouts.app')


@section('contenido_js')
    
@endsection

@section('contenido_cSS')


        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }} ">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }} ">
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
@endsection


@section('content')
<head>
    


  </head>
  <body>
       
    {{-- <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo.png"></a></h1>
                    </div>
                </div>
                
            </div>
        </div>
    </div>  --}}
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Servicios</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
              
                @foreach($allServices as $service)
                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src="img/product-6.jpg" alt="">
                            </div>
                            <h2><a href="">{{ $service->IntermediateTal->ser_tal_name }}</a></h2>
                            <div class="product-carousel-price">
                                 <a href="{{ route('perfil',$service->use_id) }}">{{ $service->IntermediateUseTal->name }}</a> 
                            </div>  
                            <div class="product-carousel-price">
                                {{ $service->descripcion }}
                            </div>  
                            <div class="product-carousel-price">
                                <ins>${{ $service->precio }}</ins> 
                            </div>  
                            
                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                            </div>                       
                        </div>
                    </div>                
                @endforeach
                {{-- <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-1.jpg" alt="">
                        </div>
                        <h2><a href="">Limpieza del hogar</a></h2>
                        <div class="product-carousel-price">
                            <ins>$19.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-2.jpg" alt="">
                        </div>
                        <h2><a href="">Payaso de fiestas infantiles</a></h2>
                        <div class="product-carousel-price">
                            <ins>$39.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-3.jpg" alt="">
                        </div>
                        <h2><a href="">Gasfiteria a domicilio</a></h2>
                        <div class="product-carousel-price">
                            <ins>$70.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-4.jpg" alt="">
                        </div>
                        <h2><a href="">Electricista</a></h2>
                        <div class="product-carousel-price">
                            <ins>$15.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-5.jpg" alt="">
                        </div>
                        <h2><a href="">Jardinero</a></h2>
                        <div class="product-carousel-price">
                            <ins>$30.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Contratar</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-6.jpg" alt="">
                        </div>
                        <h2><a href="">Profesor particular</a></h2>
                        <div class="product-carousel-price">
                            <ins>$60.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-7.jpg" alt="">
                        </div>
                        <h2><a href="">Enfermera particular</a></h2>
                        <div class="product-carousel-price">
                            <ins>$35.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-8.jpg" alt="">
                        </div>
                        <h2><a href="">Niñera</a></h2>
                        <div class="product-carousel-price">
                            <ins>$30.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-9.jpg" alt="">
                        </div>
                        <h2><a href="">Entrenador de perros</a></h2>
                        <div class="product-carousel-price">
                            <ins>$80.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-10.jpg" alt="">
                        </div>
                        <h2><a href="">Buffet y katering</a></h2>
                        <div class="product-carousel-price">
                            <ins>$90.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/product-11.jpg" alt="">
                        </div>
                        <h2><a href="">Animadora de fiestas infantiles</a></h2>
                        <div class="product-carousel-price">
                            <ins>$50.00</ins> 
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Ver más</a>
                        </div>                       
                    </div>
                </div>
            </div> --}}
            
            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

   
    <!-- Latest jQuery form server -->
    {{-- <script src="https://code.jquery.com/jquery.min.js"></script> --}}
    
    <!-- Bootstrap JS form CDN -->
    {{-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
    
    <!-- jQuery sticky menu -->
    {{-- <script src="js/owl.carousel.min.js"></script> --}}
    {{-- <script src="js/jquery.sticky.js"></script> --}}
    
    <!-- jQuery easing -->
    {{-- <script src="js/jquery.easing.1.3.min.js"></script> --}}
    
    <!-- Main Script -->
    {{-- <script src="js/main.js"></script> --}}
  </body>
@endsection

@section('contenido_abajo_js')
<script>

</script>
    
@endsection