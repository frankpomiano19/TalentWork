<div>
    <button class="open-button" onclick="openForm()" id="botonChat" style="display:block;">
        <font class="ventChat" style="vertical-align: inherit; font-size:1.2rem;">Mensajes privados</font>
        </font>
    </button>
    <div class="chat-popup" id="myForm" style="display: block; width:30%; height:450px;">
        <div action="" class="form-container">
            <div class="portlet portlet-default">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h4><i class="fa fa-circle text-green"></i>{{ $serviceProfile->IntermediateUseTal->name }}</h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" onclick="closeForm()" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                
                <div class="portlet-body" style="overflow-y: auto; width: auto; height: 300px; " id="cuadroChat">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="media">
                                <div class="media-body">
                                    @foreach ($datos as $datom)
                                        @if($datom->envia == auth()->user()->id)
                                            <div style="" class="rounded m-1">
                                                <h5 class="text-right"><b><small>{{ $datom->fecha }}</small> - {{ auth()->user()->name }}</b></h5>
                                                <p class="text-right" style="font-size:1.1rem;">{{ $datom->mensaje}}</p><hr>
                                            </div>
                                        @else
                                            <div class="container-fluid">
                                                <div style="" class="row">
                                                    <div class="col-12">
                                                        <p class="float-left my-auto align-middle" style="font-size:1.1rem;"><b>{{ $serviceProfile->IntermediateUseTal->name }}<small> - {{ $datom->fecha }}</small></b><br>{{ $datom->mensaje}}</p>
                                                    </div>
                                                </div>
                                            </div><hr>
                                            
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
               
            </div>
            
                <div class="form-group row justify-content-center" style="display: flex;
                align-items: center;">              
                    <div class="col-8 pr-1">
                        <input class="form-control form-control-lg inputChat my-1 pr-0" wire:keydown.enter="enviarMensaje" type="text" placeholder="Escribir mensaje..." wire:model="mensaje">
                    </div>
                    <div class="col-4 pl-0">
                        <button class="btn my-1 btn-block btn-success p-2" wire:click="enviarMensaje">Enviar</button>
                    </div>
                </div>
        </div>
    </div>
    
</div>

<script>
    
    Pusher.logToConsole = true;
    var pusher = new Pusher('0cceeee491b92f68de44', {
    cluster: 'mt1'
    });
    var channel = pusher.subscribe('chat-channel');    
    channel.bind('chat-event', function(data) {
        Livewire.emit('llegadaMensaje');
        app.messages.push(JSON.stringify(data));
        objDiv.scrollTop = objDiv.scrollHeight;
    });

    var objDiv = document.getElementById("cuadroChat");
    objDiv.scrollTop = objDiv.scrollHeight;

    $( document ).ready(function() {
            window.livewire.on('enviado', function () {
                var objDiv = document.getElementById("cuadroChat");
                objDiv.scrollTop = objDiv.scrollHeight;                              
            });
    });

    function openForm() {
        document.getElementById("myForm").style.display = "block";
        document.getElementById("botonChat").style.display = "none";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
        document.getElementById("botonChat").style.display = "block";
    }

</script>
