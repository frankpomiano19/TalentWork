<div>

  {{-- {{ $vendedor = auth()->user()->name }} --}}

  <br><br>
  {{-- <input wire:model="vendedor" type="hidden" value={{ auth()->user()->id }}> --}}

  {{ $vendedor }}

  @foreach ($datos as $mensaje)
    <p>
      De:{{ $mensaje->IntermediateUser->name}}
    </p>
    <p>
      Mensaje: {{ $mensaje->mensaje }}
    </p>
    -----------------------------------------------
  @endforeach
</div>
