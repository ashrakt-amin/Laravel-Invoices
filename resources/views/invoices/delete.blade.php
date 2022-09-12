
<!-- delete Modal -->
<div class="modal fade" id="delete{{$invoice->id}}"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>

      <div class="modal-body">
       <form class="posts-form" action="{{route('invoices.destroy',$invoice->id)}}" method="post" >
       {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>are you sure</h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">delete</button>

                </div>
       </form>    
      </div>

      
    </div>
  </div>
</div>