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
                    {{-- <p>Encargado: {{ $dato->IntermediateUseTal->name}}</p> --}}
                    <img style="height:200px; width:200px;" src="{{ $dato->imagen}}">
                    <p>Descripcion: {{ $dato->descripcion}}</p>
                    <p>Precio: {{ $dato->precio}}</p>
                    <div>
                        <button class="btn btn-success m-2" href="{{ route('showProfileServiceTalent',$dato->id) }}">Ir a servicio</button>
                    </div>
                @elseif($ocupacion)
                    <img style="height:200px; width:200px;" src="{{ $dato->imagen}}">
                    <p>Descripcion: {{ $dato->descripcion}}</p>
                    <p>Precio: {{ $dato->precio}}</p>
                    <div>
                        <button class="btn btn-success m-2" href="{{ route('showProfileServiceOccupation',$dato->id) }}">Ir a servicio</button>
                    </div>
                @endif

            @endforeach
        @else
        {{-- <img class="img-fluid my-3 animate__animated  animate__flash" src="{{ asset('img/undraw_Taken_re_yn20.svg') }}" style="width: 30%; heigth: 30%;" alt="insertar SVG con la etiqueta image"> --}}
        @endif
    </div>
</div>