@extends('layouts.app')
@section('title', 'Home')
@section('content')
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
                      <div class="card-deck">
                        @foreach($data as $cardTask)
                        <div class="col-md-6 my-2">
                          <div class="card">
                            <h5 class="card-header">{{$cardTask->title}}</h5>
                            <div class="card-body">
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
          alert("it works");
        }
      });
    })
  });
  </script>
@endsection
