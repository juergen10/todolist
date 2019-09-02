@extends('layouts.app')
@section('title', 'Home')
@section('content')
<style media="screen">
.material-icons.md-12 {
  font-size: 12px;
}
</style>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Task Card</div>
        <div class="card-body">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        <div class="row">
          <div class="input-group mb-3 col-md-5">
            <input type="text" class="form-control" id="card-name" placeholder="Card Name">
            <div class="input-group-append">
              <button class="btn btn-primary" id="add" type="button">Add</button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="card-reload" id="card-reload">
            <div class="card-deck" id="card-deck">
              @foreach($data as $cardTask)
              <div class="col-md-6 my-2">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-9 item{{$cardTask->id}}">
                        <p class="h5">{{$cardTask->title}}</p>
                      </div>
                      <div class="col-md-3">
                        <div class="row">
                          <button title="edit" type="button" id="edit-card" class="edit-card btn btn-outline-dark btn-sm"
                          data-id="{{$cardTask->id}}" data-name="{{$cardTask->title}}">
                          <i class="material-icons md-12">edit</i>
                        </button>
                        <button title="delete" type="button" id="delete-card" class="delete-card btn btn-outline-danger btn-sm"
                        data-id="{{$cardTask->id}}" data-name="{{$cardTask->title}}">
                        <i class="material-icons md-12">delete_sweep</i>
                        </button>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="input-group">
                      <input type="text" class="form-control" id="task-name" placeholder="Task Name">
                      <div class="input-group-append">
                        <button class="btn btn-primary" id="add-task" data-id="{{$cardTask->id}}" type="button" title="Add Task"><i class="material-icons">add</i></button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
              @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Id Card:</label>
            <input type="text" readonly class="form-control" id="id-card">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Card Name:</label>
            <input type="text" class="form-control" id="namecard">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="save-card">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('jquery')
  <script type="text/javascript">
  $( document ).ready(function() {
    $("#add").click(function(){
      $.ajax({
        type: "POST",
        url: "{{ route("add") }}",
        data: {
          _token: "{{ csrf_token() }}",
          name : $("#card-name").val()
        },
        success: function(data) {
          alert(data);
          $("#card-name").val('');
          location.reload();
        }
      });
    });

    $("#add-task").click(function(){
      $.ajax({
        type: "POST",
        url: "{{ route("addtask") }}",
        data: {
          _token: "{{ csrf_token() }}",
          name : $("#task-name").val(),
          id_card : $(this).data('id')
        },
        success: function(data) {
          alert(data);
          $("#task-name").val('');
          // location.reload();
        }
      });
    });

    $(".edit-card").click(function(){
      $("#id-card").val($(this).data("id"));
      $("#namecard").val($(this).data("name"));
      $('#exampleModal').modal('show');
    });

    $(".delete-card").click(function(e) {
      var text = $(this).data("name");
      var id = $(this).data("id");
      e.preventDefault();
      $.confirmModal('Are you sure to delete <b>'+ text +'</b> card?',{
        messageHeader: "Confirmation Card Delete"
      }, function(el) {
        console.log("Ok was clicked!")
        $.ajax({
          type: "POST",
          url: "{{route("deletecard")}}",
          data:{
            _token : "{{ csrf_token()}}",
            id : id,
          },
          success: function(data) {
            $("#namecard").val('');
              location.reload();
          }
        });
      });
    })

    $("#save-card").click(function(){
      $.ajax({
        type: "POST",
        url: "{{route("editcard")}}",
        data:{
          _token : "{{ csrf_token()}}",
          id : $("#id-card").val(),
          name : $("#namecard").val()
        },
        success: function(data) {
          $('#exampleModal').modal('hide');
          $("#namecard").val('');
            location.reload();
        }
      });
    });
  });
  </script>
  <script src="{{asset('assets/js/jquery.confirmModal.min.js')}}" charset="utf-8"></script>
@endsection
