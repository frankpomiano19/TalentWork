<div class="row">
    <div class="col-4">
        <div style="text-align: center">

            <br><h5>Precio S/</h5>
            <div class="" id="" wire:model="precioMin">
                <input type="radio" id="cbox2" name="precio" value="10"> <label for="cbox2">Hasta 10</label>
                <input type="radio" id="cbox2" name="precio" value="100"> <label for="cbox2">Hasta 100</label>
                <input type="radio" id="cbox2" name="precio" value="1000"> <label for="cbox2">Hasta 1000</label>
            </div>
            <h5>Ordenar por:</h5>
            <div class="" id="" wire:model="calificacion">
                <input type="radio" id="cbox2" name="calificacion" value="asc"> <label for="cbox2">Mayor calificacion</label>
                <input type="radio" id="cbox2" name="calificacion" value="desc"> <label for="cbox2">Menor calificacion</label>
            </div>
            <p>Ocupacion</p>
            <div class="" id="" wire:model="ocupacion" wire:click="ocupacionM">
                <select class="desplegable">
                    <option value="1" >Gasfitero de madrigueras</option>
                    <option value="2" >Reparador de computadoras</option>
                    <option value="3" >Diseñador grafico</option>
                    <option value="4" >Estampador de polos</option>
                    <option value="5" >Confeccionador de ropa</option>
                </select>
            </div>
            <p>talento</p>
            <div class="" id="" wire:model="talento" wire:click="talentoM">
                <select class="desplegable">
                    <option value="1" >Abridor de cajas</option>
                    <option value="2" >Narrador de audiolibros</option>
                    <option value="3" >Contador de chistes</option>
                    <option value="4" >Probador de ropa</option>
                    <option value="5" >Creador de videos rapidos</option>
                </select>
            </div>
    
            
        </div>
    </div>
    <div class="col-8 text-center mt-2">
        <br>
        @if($talento)
            <h3>Talentos</h3>
        @elseif($ocupacion)
            <h3>Ocupaciones</h3>
        @else
            <h3>Talento u ocupaciones</h3>
        @endif
        @if($datos->count())
            @foreach($datos as $dato)
                @if($talento)
                    <img alt="Imagen de servicio" style="height:200px; width:200px;" src="{{ $dato->imagen}}">
                    <p>Descripcion: {{ $dato->descripcion}}</p>
                    <p>Precio: {{ $dato->precio}}</p>
                    <div>
                        <a class="btn btn-success m-2" href="{{ route('showProfileServiceTalent',$dato->id) }}">Ir a servicio</a>
                    </div>
                @elseif($ocupacion)
                    <img alt="Imagen de servicio" style="height:200px; width:200px;" src="{{ $dato->imagen}}">
                    <p>Descripcion: {{ $dato->descripcion}}</p>
                    <p>Precio: {{ $dato->precio}}</p>
                    <div>
                        <a class="btn btn-success m-2" href="{{ route('showProfileServiceOccupation',$dato->id) }}">Ir a servicio</a>
                    </div>
                @endif

            @endforeach
        @else
        @endif
    </div>
</div>