<div>
    <div>
        <form wire:submit.prevent="submit">
            <input type="hidden" wire:model="de" value={{ $serviceProfile->IntermediateUseOcc->name }}>
            <p>Para: {{ $serviceProfile->IntermediateUseOcc->name }}</p>
            <p>De: {{ auth()->user()->name }}</p>
            <input class="form-control form-control-lg" type="text" placeholder="Escribir" wire:model="mensajeChat">
            <button type="submit">Enviar</button>
        </form></div>
        <p>mensajes</p>
    <div class="caja-chat" style="height:200px; width:400px; overflow-y: scroll; border: 1px solid black; padding:20px;">
        @foreach ($historial as $historia)
            <p>{{ $historia->mensaje }}</p>
        @endforeach
    </div>

</div>


<button class="open-button" onclick="openForm()">
    <font style="vertical-align: inherit;">
       <font style="vertical-align: inherit;">Chat</font>
    </font>
 </button>
       
   <div class="chat-popup" id="myForm" style="display: none;">
    
       <form action="" class="form-container">

           <div class="portlet portlet-default">

               <div class="portlet-heading">

                   <div class="portlet-title">
                       <h4><i class="fa fa-circle text-green"></i> {{ $serviceProfile->IntermediateUseOcc->name }}</h4>
                       
                   </div>

                   <div class="portlet-widgets">
                       <span class="divider"></span>
                       <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                   </div>

                   <div class="clearfix"></div>
               </div>
               

                 
               <div class="portlet-body chat-widget" style="overflow-y: auto; width: auto; height: 300px;">

                   <div class="row">
                       <div class="col-lg-12">
                           <p class="text-center text-muted small"> </p>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-lg-12">
                           <div class="media">
                               <a class="pull-left" href="#">
                               <img class="media-object img-circle img-chat" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                               </a>
                               <div class="media-body">
                                   <h4 class="media-heading">Jane Smith
                                       <span class="small pull-right">12:23 PM</span>
                                   </h4>
                                   <p>Hi, I wanted to make sure you got the latest product report. Did Roddy get it to you?</p>
                               </div>

                           </div>
                       </div>
                   </div>
           
                   <hr>
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="media">
                               <a class="pull-left" href="#">
                               <img class="media-object img-circle img-chat" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                               </a>
                               <div class="media-body">
                                   <h4 class="media-heading">John Smith
                                   <span class="small pull-right">12:28 PM</span>
                                   </h4>
                                   <p>Yeah I did. Everything looks good.</p>
                                   <p>Did you have an update on purchase order #302?</p>
                               </div>
                           </div>
                       </div>
                   </div>

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
                                   <p>No not yet, the transaction hasn't cleared yet. I will let you know as soon as everything goes through. Any idea where you want to get lunch today?</p>
                                   <p>{{ $mensajeChat }}</p>
                               </div>
                           </div>
                       </div>
                   </div>

                   <hr>
                   
               </div>     
              
           </div>
           

           <div class="portlet-footer">
               <div class="form-group">              
                    <input class="form-control form-control-lg" type="text" placeholder="Escribir">
               </div>
               <div class="form-group">
                    <button type="submit" class="btn btn-default pull-right">Enviar</button>
                    
               <div class="clearfix">

               </div>
               </div>
           </div>


           <button type="button" class="btn cancel" onclick="closeForm()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Cerrar chat</font></font></button>
       </form>
       
   </div>