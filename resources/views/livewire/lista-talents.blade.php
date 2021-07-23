<div class="container">
    <div class="row">
      <div class="col-6 overflow-scroll" style="height: 100%;"><br>
        @foreach ($datos as $mensaje)
  
          <div class="row" style="">
              <div class="col-6 text-truncate pt-1">
                <b>{{ $mensaje->IntermediateUser->name}}:</b> {{ $mensaje->mensaje }}
                {{-- {{ $mensaje->IntermediateUser->id}} --}}
              </div>
              <div class="col-6">
                <button class="btn btn-success btn-sm btn-block" wire:click="responderM({{ $mensaje->IntermediateUser->id}}, {{ $mensaje->id_servicio }})">Ver menjes</button>
              </div>
            {{-- </div> --}}
          </div><hr>
        @endforeach
      </div>
      <div class="col-6 px-4 media-body"><br>
          <h3>
            Mensajes:
            {{-- Responder a {{ $para }} --}}
            @if($mensajes)
              @foreach ($mensajes as $hist)
                @if($hist->envia == auth()->user()->id)
                  <div style="border:1px solid black;background-color:#36D1DC;" class="m-1 rounded">
                    <p class="text-right mt-3 mr-1" style="font-size: 1rem;">{{ $hist->mensaje}}</p>
                  </div>
                @else
                  <div style="border:1px solid black; word-wrap: break-word; background-color:#F3F9A7;" class="m-1 rounded">
                    <p class="text-left mt-4 ml-1" style="font-size: 1rem;"><b>{{ $rCliente->IntermediateUser->name }}</b>: {{ $hist->mensaje}}</p>
                  </div>
                @endif
              @endforeach
              @if($habilitarInput)
                <input class="form-control form-control-lg m-1 inputChat" wire:keydown.enter="enviarRespuesta" type="text" placeholder="Escribir" wire:model="respuesta">
              @else
                <input class="form-control form-control-lg m-1 inputChat" wire:keydown.enter="enviarRespuesta" type="text" placeholder="Escribir"  disabled>
              @endif
            @else
              {{-- <h3>Selecciona a quién responder</h3> --}}
            @endif
          </h3>
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
        // alert(JSON.stringify(data));
        // console.log(data);
        Livewire.emit('llegadaMensaje');
        app.messages.push(JSON.stringify(data));
        // $this->emit('llegadaMensaje');
    });
</script>
