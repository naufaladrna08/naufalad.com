@extends('components.layout')

@section('content')
<div id="admin-login-body" class="container d-flex align-items-center">
  <div class="w-25 mx-auto">
    <form class="form" method="POST" id="login-form">
      <h2 class="text-center my-4"><code> naufalad.com </code></h2>
      
      <p class="text-small text-center text-secondary">
        Login untuk nggak ngapa-ngapain.
      </p>

      <div class="form-group my-2">
        <label for="username" class="my-2"> Username </label>
        <input type="text" class="form-control" name="username" id="username">
      </div>
      <div class="form-group my-2">
        <label for="passowrd" class="my-2"> Password </label>
        <input type="password" class="form-control" name="password" id="password">
      </div>
      <div class="form-group mt-4">
        <h6 class="text-danger mb-4" id="error"></h6>
        <button class="btn btn-primary btn-block w-100" type="submit"> Login </button>
      </div>
    </form>

    <p class="text-small text-center text-secondary my-4">
      <br>
      &copy naufalad.com 2023
    </p>
  </div>
</div>
@endsection

@push('script')

<script>
  $(document).ready(() => {
    $('#login-form').on('submit', (e) => {
      e.preventDefault()

      $.ajax({
        url: "{{ route('admin.login') }}",
        method: "POST",
        dataType: "JSON",
        data: $('#login-form').serializeArray(),
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: () => {
          Swal.showLoading()
        },
        success: (resp) => {
          Swal.close()

          if (resp.code == 200) {
            window.location.href = "{{ url('/') }}/"
          } else {
            $('#error').html("Anda penyusup!")
          }
        }
      })
    })
  })
</script>
@endpush