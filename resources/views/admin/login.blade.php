@extends('components.layout')

@section('content')
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <span class="navbar-brand mb-0 h1"> Naufal Adriansyah </span>
  </div>
</nav>

<div class="container my-4">
  <div class="row">
    <div class="col-md-8">
      <h1> Admin Login </h1>
      <p> Anda seharusnya tidak bisa masuk ke sini dikarenakan hanya admin yang boleh mengakses halaman ini. </p>
    </div>
    <div class="col-md-4">
      <form class="form" method="POST" id="login-form">
        <h5> Udah yu! Daripada ribut, mending masuk dulu. </h5>
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
    </div>
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