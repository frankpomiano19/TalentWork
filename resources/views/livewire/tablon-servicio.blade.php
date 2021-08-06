<div class="row my-2" style="margin:0px;display: flex;
align-items: center;
justify-content: center;">
    <div class="col-4" style="margin:0px;">
        <h5 style="margin-bottom: 0px;">Servicios registrados:</h5>
    </div>

    <div class="col-4" style="margin:0px;">
        Talento: <select>
            @foreach ($talentos as $talento)
                <option>
                    {{ $talento->ser_tal_name }} 
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-4" style="margin:0px;">
        Ocupación: <select>
            @foreach ($ocupaciones as $ocupacion)
                <option>
                    {{ $ocupacion->ser_occ_name }} 
                </option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-12">
    {{ $nombre }}
        @foreach ($servicios as $servicio)
            <div class="col-6">
                <p>Servicio: {{ $servicio->servicio }}</p>
                <p>Servicio: {{ $servicio->descripcion }}</p>
                <p>Servicio: {{ $servicio->tipo }}</p>
                <p>Servicio: {{ $servicio->precio }}</p>
            </div>
        @endforeach        
    </div>
</div>
