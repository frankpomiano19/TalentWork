<div>
    <div style="text-align: center">

        
        @if($talento)
            <h3>Talentos</h3>
        @elseif($ocupacion)
            <h3>Ocupaciones</h3>
        @else
            <h3>Talento u ocupacinoes</h3>
        @endif

        <div class="" id="" wire:model="precioMin" wire:click="">
            <input type="radio" id="cbox2" name="precio" value="10"> <label for="cbox2">Hasta 10</label>
            <input type="radio" id="cbox2" name="precio" value="100"> <label for="cbox2">Hasta 100</label>
            <input type="radio" id="cbox2" name="precio" value="1000"> <label for="cbox2">Hasta 1000</label>
        </div>

        <div class="" id="" wire:model="calificacion" wire:click="">
            <input type="radio" id="cbox2" name="calificacion" value="asc"> <label for="cbox2">Mayor calificacion</label>
            <input type="radio" id="cbox2" name="calificacion" value="desc"> <label for="cbox2">Menor calificacion</label>
        </div>



        
        <p>Ocupacion</p>
        <div class="" id="" wire:model="ocupacion" wire:click="ocupacionM">
            <select style="" class="desplegable">
                <option value="1" style="">Gasfitero de madrigueras</option>
                <option value="2" style="">Reparador de computadoras</option>
                <option value="3" style="">Diseñador grafico</option>
                <option value="4" style="">Estampador de polos</option>
                <option value="5" style="">Confeccionador de ropa</option>
            </select>
        </div>
        <p>talento</p>
        <div class="" id="" wire:model="talento" wire:click="talentoM">
            <select style="" class="desplegable">
                <option value="1" style="">Abridor de cajas</option>
                <option value="2" style="">Narrador de audiolibros</option>
                <option value="3" style="">Contador de chistes</option>
                <option value="4" style="">Probador de ropa</option>
                <option value="5" style="">Creador de videos rapidos</option>
            </select>
        </div>

        @if($datos)
            @foreach($datos as $dato)
                @if($talento)
                    <p>Encargado: {{ $dato->IntermediateUseTal->name}}</p>
                @elseif($ocupacion)
                    <p>Encargado: {{ $dato->IntermediateUseOcc->name}}</p>
                @else
                    <p>Encargado: </p>
                @endif
                <p>Descripcion: {{ $dato->descripcion}}</p>
                <p>Precio: {{ $dato->precio}}</p>
                <img style="height:200px; width:200px;" src="{{ $dato->imagen}}">
            @endforeach
        @endif
    </div>
</div>