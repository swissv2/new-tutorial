@if(Session::has('message'))
   <div class="alert alert-success" style="width:100%; margin-top:10px;">{{ Session::get('message') }}
   		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
   </div>
@endif   