@extends('components.layout')

@section('content')
  <div class="container mb-4" id="wrap-all">
    <div class="row">
      <div class="col-md-6">
        <h5> Create an Article </h5>
        <p class="lead"> You can create article with markdown script. </p>

        <form method="POST" id="article-form">
          <div class="form-group mb-2">
            <button id="preview" class="btn btn-primary btn-sm"> Preview </button>
            <button id="save-draft" class="btn btn-secondary btn-sm"> Save as Draft </button>
          </div>
          <div class="form-group mb-2">
            <label for="acontent"> Body: </label>
            <textarea name="acontent" id="acontent" cols="30" rows="15" class="form-control mt-2"></textarea>
          </div>
          <div class="form-group mb-2">
            <label for="title"> Title: </label>
            <input type="text" class="form-control mt-2" name="atitle" id="atitle">
          </div>
          <button id="post" class="btn btn-primary" style="float: right;"> Post </button>
        </form>
      </div>
      <div class="col-md-6" id="preview-window"></div>
    </div>
  </div>

  <style>

  </style>
@endsection

@push('script')
  <script>
    $(document).ready(() => {
      $('#article-form').on('submit', (e) => {
        e.preventDefault()
      })

      $('#preview').on('click', (e) => {
        const converter = new showdown.Converter()
        const src = $('#acontent').val()
        const html = converter.makeHtml(src)

        $('#preview-window').html(html)
      })

      var textareas = document.getElementsByTagName('textarea')
      var count = textareas.length
      for (var i = 0; i < count; i++) {
        textareas[i].onkeydown = function(e){
          if (e.keyCode == 9 || e.which == 9) {
            e.preventDefault();
            var s = this.selectionStart
            this.value = this.value.substring(0, this.selectionStart) + "\t" + this.value.substring(this.selectionEnd)
            this.selectionEnd = s + "\t".length
          }
        }
      }
    })
  </script>
@endpush