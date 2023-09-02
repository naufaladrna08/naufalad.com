@extends('components.layout')

@section('content')
  <div class="container" id="wrap-all">
    @section('title', 'Naufal Adriansyah - Blogs')
    @section('description', '')
    @section('keywords', '')
    
    <div class="row">
      <div class="col-md-2 d-none d-sm-block">
      </div>
      <div class="col-md-8">
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1"> <i class="fas fa-search"> </i> </span>
          <input type="text" class="form-control" placeholder="Search article, press enter to search" aria-label="search" id="search-query">
        </div>

      @if ($isLoggedIn == true)
        <div class="buttons my-4">
          <a href="{{ url('post') }}" class="btn btn-primary btn-sm"> Create an Article </a>
          <a href="{{ url('drafts') }}" class="btn btn-secondary btn-sm"> Drafts </a>
        </div>
      @endif

      {{-- Content here --}}
      <div class="content-loader card" style="height: 256px;" aria-hidden="true">
        <div class="card-body">
          <h5 class="card-title placeholder-glow">
            <span class="placeholder col-6"></span>
          </h5>
          <p class="card-text placeholder-glow">
            <span class="placeholder col-7"></span>
            <span class="placeholder col-4"></span>
            <span class="placeholder col-4"></span>
          </p>
          <a class="btn btn-primary disabled placeholder col-6" aria-disabled="true"></a>
        </div>
      </div>

      <div id="list-content" class="mb-4 pb-4">

      </div>
    </div>

    @push('script')
    <script type="text/javascript">
      $(document).ready(() => {
        $('.content-loader').hide()
        getContents(1)
      })

      const getContents = (pageNumber, _url = null) => {
        const contentDiv = $('#list-content')

        $.ajax({
          url: (_url == null && pageNumber != null) ? '/api/get-contents?page=' + pageNumber : _url,
          method: 'GET',
          beforeSend: () => {
            $('.content-loader').show()
            contentDiv.html('')
          },
          success: (response) => {
            $('.content-loader').hide()

            const data = response.data
            let innerHTMLContent = ''

            data.forEach((each) => {
              innerHTMLContent += each
            })

            innerHTMLContent += `
            <div class="mx-auto">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
            `

            /* Create a pagination */
            response.links.forEach((each, i) => {
              if (i == 0) {
                innerHTMLContent += `
                  <li class="page-item" `+ ((response.prev_page_url != null) ? `onclick="getContents(null, '`+ response.prev_page_url +`')"` : '') +`> 
                    <a class="page-link" href="javascript:void(0);"> 
                      Previous 
                    </a>
                  </li>
                `
              } else if (i == response.links.length - 1) {
                innerHTMLContent += `
                  <li class="page-item" `+ ((response.next_page_url != null) ? `onclick="getContents(`+ response.last_page +`)"` : '') +`> 
                    <a class="page-link" href="javascript:void(0);"> 
                      Previous 
                    </a>
                  </li>
                `
              } else {
                innerHTMLContent += `<li class="page-item" onclick='getContents(`+ i +`)'><a class="page-link" href="javascript:void(0);"> `+ i +` </a></li>`
              }
            })

            innerHTMLContent += `
                </ul>
              </nav>
            </div>
            `

            contentDiv.html(innerHTMLContent)
          }
        })
      }

      $('#search-query').on('keypress', (event) => {
        const value = $('#search-query').val()
        const contentDiv = $('#list-content')

        if (event.keyCode == 13) {
          $.ajax({
            url: '/api/get-contents?search=' + value,
            method: 'GET',
            beforeSend: () => {
              $('.content-loader').show()
              contentDiv.html('')
            },
            success: (response) => {
              $('.content-loader').hide()

              const data = response.data
              let innerHTMLContent = ''

              data.forEach((each) => {
                innerHTMLContent += each
              })

              innerHTMLContent += `
              <div class="mx-auto">
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center">
              `

              /* Create a pagination */
              response.links.forEach((each, i) => {
                if (i == 0) {
                  innerHTMLContent += `<li class="page-item" onclick="getContents(null, '`+ response.prev_page_url +`')"> <a class="page-link" href="javascript:void(0);"> Previous </a></li>`
                } else if (i == response.links.length - 1) {
                  innerHTMLContent += `<li class="page-item" onclick="getContents(null, '`+ response.next_page_url +`')"> <a class="page-link" href="javascript:void(0);"> Next </a></li>`
                } else {
                  innerHTMLContent += `<li class="page-item" onclick='getContents(`+ i +`)'><a class="page-link" href="javascript:void(0);"> `+ i +` </a></li>`
                }
              })

              innerHTMLContent += `
                  </ul>
                </nav>
              </div>
              `

              contentDiv.html(innerHTMLContent)
            }
          })
        }
      })
    </script>
    @endpush
  </div>
@endsection