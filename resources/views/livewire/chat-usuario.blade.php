<div>
    <button class="open-button" onclick="openForm()">
        {{-- <font style="vertical-align: inherit;"> --}}
        <font style="vertical-align: inherit;">Chat</font>
        </font>
    </button>
    <div class="chat-popup" id="myForm" style="display: block; width:30%; height:700px;">
        <div style="position: absolute;" class="alert alert-sucess collapse" role="alert" id="avisoSuccess">Enviado
        </div>
        <div action="" class="form-container">
            <div class="portlet portlet-default">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h4><i class="fa fa-circle text-green"></i>{{ $serviceProfile->IntermediateUseOcc->name }}</h4>
                    </div>
                    <div class="portlet-widgets">
                        <span class="divider"></span>
                        <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                  
                <div class="portlet-body chat-widget" style="overflow-y: auto; width: auto; height: 300px;">
 
                    <hr>
                        
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="media">
                                <a class="pull-left" href="#">
                                <img class="media-object img-circle img-chat" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Jane Smith
                                    <span class="small pull-right">12:39 PM</span>
                                    </h4>
                                    <p>No not yet, the transaction hasn't cleared yet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <hr>
                    
                </div>     
               
            </div>
            
 
            <div class="portlet-footer">
                <div class="form-group">              
                     <input class="form-control form-control-lg"  type="text" placeholder="Escribir" wire:model="mensaje">
                </div>
                <div class="form-group">
                     <button type="submit" class="btn btn-default pull-right" wire:click='enviarMensaje'>Enviar</button>
                     <p>{{ $mensaje }}</p>
                     
                <div class="clearfix">
 
                </div>
                </div>
            </div>
 
 
            <button type="button" class="btn cancel" onclick="closeForm()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cerrar chat</font></font></button>
        </div>
    </div>
    
</div>


<script>

    console.log("hola");

    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

    $( document ).ready(function() {
            window.livewire.on('mensajeEnviado', function () {
                console.log("llego");
                $("#avisoSuccess").fadeIn("slow");                
                setTimeout(function(){ $("#avisoSuccess").fadeOut("slow"); }, 3000);                                
            });
        });
</script>
