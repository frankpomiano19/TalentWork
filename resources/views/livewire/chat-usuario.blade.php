<div>
    <button class="open-button" onclick="openForm()">
        <font style="vertical-align: inherit;">Chat</font>
        </font>
    </button>
    <div class="chat-popup" id="myForm" style="display: block; width:30%; height:542px;">
        <div style="position: absolute;" class="alert alert-sucess collapse" role="alert" id="avisoSuccess">Enviado
        </div>
        <div action="" class="form-container">
            <div class="portlet portlet-default">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h4><i class="fa fa-circle text-green"></i>{{ $serviceProfile->IntermediateUseOcc->name }}</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="portlet-body" style="overflow-y: auto; width: auto; height: 300px;">
                        
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="media">
                                <div class="media-body">
                                    @foreach ($datos as $datom)
                                        @if($datom->envia == auth()->user()->id)
                                            <div style="border:1px solid black;" class="m-1 rounded bg-success">
                                                <p class="text-right mt-3 mr-1 font-weight-bold">{{ $datom->mensaje}}</p>
                                            </div>

                                        @else
                                            <div style="border:1px solid black;" class="m-1 rounded bg-warning">
                                                <p class="text-left mt-3 ml-1 font-weight-bold">{{ $serviceProfile->IntermediateUseOcc->name }}: {{ $datom->mensaje}}</p>
                                            </div>
                                            
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
               
            </div>
            
                <div class="form-group">              
                     <input class="form-control form-control-lg" wire:keydown.enter="enviarMensaje" type="text" placeholder="Escribir" wire:model="mensaje">
                </div>
 
 
            <button type="button" class="btn cancel" onclick="closeForm()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cerrar chat</font></font></button>
        </div>
    </div>
    
</div>


<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    // $( document ).ready(function() {
    //         window.livewire.on('mensajeEnviado', function () {
    //             console.log("llego");
    //             $("#avisoSuccess").fadeIn("slow");                
    //             setTimeout(function(){ $("#avisoSuccess").fadeOut("slow"); }, 3000);                                
    //         });
    //     });
</script>
