@extends('layouts.main')


@section('index')
<script>
  $(document).ready(function() {
      $('.post_create').on('click',function(){     
                $('.title_err').text('')
                $('.description_err').text('')
                var form = $('#postform').serialize()
                $.ajax({
                    type: 'POST',
                    url: "{{ route('posts.store') }}",
                    data: form,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            alert(data.success)
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
                function printErrorMsg(msg) {
                    $.each(msg, function(key, value) {
                        console.log(key);
                        $('.' + key + '_err').text(value);
                    });
                }
      });
  });
</script>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="postform">
          @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp" placeholder="Enter Title">
          </div>
          <div>
              <span class="text-danger error-text title_err"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea class="form-control" name="description" id="description"></textarea>
          </div>
          <div>
              <span class="text-danger error-text description_err"></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="post_create btn btn-primary" >Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection