@extends('components.layout')

@section('content')
  <div class="container mb-4" id="wrap-all">
    <div class="row">
      <div class="col-md-6">
        <h5> Create an Article </h5>
        <p class="lead"> You can create article with markdown or HTML script. </p>

        <form method="POST" id="article-form">
          <div class="form-group mb-2">
            <button id="preview" class="btn btn-primary btn-sm"> Preview </button>
            <button id="change-style" class="btn btn-primary btn-sm" to="html"> Edit as HTML </button>
            <button id="save-draft" class="btn btn-secondary btn-sm"> Save as Draft </button>
            <button id="upload-image" class="btn btn-primary btn-sm"> Upload Image </button>

            <input type="file" name="image" id="image" style="width: 0; height: 0; overflow: hidden;">
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
        let html = converter.makeHtml('#' + $('#atitle').val() + '\n' + src)

        $('#preview-window').html(html.replace('<p>', '<p class="lead">'))
      })

      $('#change-style').on('click', () => {
        const converter = new showdown.Converter()
        const data = $('#acontent').val()
        const type = $('#change-style').attr('to')
        let changed = ''

        if (type == 'html') {
          changed = converter.makeHtml(data)
          $('#change-style').attr('to', 'md')
          $('#change-style').html('Edit as Markdown')
        } else {
          changed = converter.makeMarkdown(data)
          $('#change-style').attr('to', 'html')
          $('#change-style').html('Edit as HTML')
        }

        $('#acontent').val(changed)
      })

      $('#save-draft').on('click', () => {
        const converter = new showdown.Converter()
        let data = converter.makeHtml($('#acontent').val())

        if ($('#acontent').val().length < 2 || $('#atitle').val().length < 2) {
          Swal.fire({
            icon: 'error',
            title: 'Oops',
            text: 'Please provide title and content',
          })

          return false
        }

        $.ajax({
          url: "{{ url('/apost') }}",
          method: "POST",
          dataType: "JSON",
          data: {
            type: "DRAFT",
            data: {
              title: $('#atitle').val(),
              content: data.replace('<p>', '<p class="lead">'),
            }
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: () => {
            Swal.showLoading()
            $('#save-draft').html("Loading...")
          },
          success: (resp) => {
            Swal.close();

            if (resp.code == 200) {
              $('#save-draft').html("Save as Draft")
            }
          }
        })
      })

      $('#post').on('click', () => {
        const converter = new showdown.Converter()
        let data = converter.makeHtml($('#acontent').val())

        if ($('#acontent').val().length < 2 || $('#atitle').val().length < 2) {
          Swal.fire({
            icon: 'error',
            title: 'Oops',
            text: 'Please provide title and content',
          })

          return false
        }

        $.ajax({
          url: "{{ url('/apost') }}",
          method: "POST",
          dataType: "JSON",
          data: {
            type: "FINAL",
            data: {
              title: $('#atitle').val(),
              content: data.replace('<p>', '<p class="lead">')
            }
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: () => {
            Swal.showLoading()
            $('#save-draft').html("Loading...")
          },
          success: (resp) => {
            Swal.close();

            if (resp.code == 200) {
              Swal.fire({
                title: 'Cool',
                text: 'Data berhasil disimpan',
              }).then((result) => {
                document.location.href = "{{ url('/blog') }}"
              })
            }
          }
        })
      })

      $('#upload-image').on('click', (e) => {
        $('#image').trigger('click')
      })

      $('#image').on('change', () => {
        let form = $('#image').prop('files')[0]
        let formData = new FormData()
        formData.append('file', form)

        $("input[type='file']").attr('disabled', true)
        $("#upload-image").attr('disabled', true)

        $.ajax({
          url: "{{ url('/upld_image') }}",
          data: formData,
          type: 'POST',
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function() {
            Swal.showLoading()
          },
          success: function(resp) {
            Swal.close()

            const data = '![New Image]('+ resp +')'

            $('#acontent').val($('#acontent').val() + data)
            
            $("#upload-image").attr('disabled', false)
            $("input[type='file']").attr('disabled', false)
          }
        });
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