<div class="container">
  <div class="row">
    <div class="col-6 overflow-scroll" style="height: 100%;"><br>
      @foreach ($datos as $mensaje)

        <div class="row my-2" style="">
            <div class="col-6 text-truncate pt-1">
              <b>{{ $mensaje->IntermediateUser->name}}:</b> {{ $mensaje->mensaje }}
              {{-- {{ $mensaje->IntermediateUser->id}} --}}
            </div>
            <div class="col-6">
              <button class="btn btn-success btn-sm btn-block" wire:click="responderM({{ $mensaje->IntermediateUser->id}}, {{ $mensaje->id_servicio }})">Abrir chat</button>
            </div>
          {{-- </div> --}}
        </div>
      @endforeach
    </div>
    <div class="col-6 px-4"><br>
        <h3>
          Responder a {{ $para }}
          @if($mensajes)
            @foreach ($mensajes as $hist)
              @if($hist->envia == auth()->user()->id)
                <div style="border:1px solid black;" class="m-1 rounded bg-success">
                  <p class="text-right mt-3 mr-1" style="font-size: 1rem;">{{ $hist->mensaje}}</p>
                </div>
              @else
                <div style="border:1px solid black; word-wrap: break-word;" class="m-1 rounded bg-warning">
                  <p class="text-left mt-3 ml-1" style="font-size: 1rem;">Cliente: {{ $hist->mensaje}}</p>
                </div>
              @endif
            @endforeach
            {{-- {{ $mensajes }} --}}
            <input class="form-control form-control-lg" wire:keydown.enter="enviarRespuesta" type="text" placeholder="Escribir" wire:model="respuesta">
          @else
            <h3>Selecciona a quién responder</h3>
          @endif
        </h3>
        {{-- <input class="form-control form-control-lg" wire:keydown.enter="enviarRespuesta" type="text" placeholder="Escribir" wire:model="respuesta"> --}}
    </div>
  </div>
</div>
