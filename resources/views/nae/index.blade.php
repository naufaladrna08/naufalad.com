<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Naenah Agustin </title>
</head>
<body>
  <div id="app">
    <div id="content">

    </div>

    <button class="btn btn-primary" id="next">
      Lanjut
    </button>

    <button class="btn btn-primary" id="pause">
      ||
    </button>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    let id = 0
    let state = false
    const audio = new Audio('{{ asset('audios/cringe.mp3') }}')
    const messages = [
      'Hai...',
      '... tante XD',
      'Emm',
      'Aku punya lagu buat kamu',
      'Suara aku jelek...',
      'Tapi aku harap kamu suka',
      'Sejujurnya aku lebih berharap kuping kamu nggak terluka XD',
      'Oke silahkan',
      '...',
      '♫ Lagunya sudah mulai',
      'Kalau belum, coba matiin dan nyalain data terus refresh ',
      'Sambil dengerin, aku mau kamu baca ini',
      'Selamat Ulang Tahun',
      'Sudah 22 tahun hidup di dunia ini',
      'Cepat ya',
      'Aku aja nggak nyangka udah jadi om-om',
      'Sekarang teteh udh jadi tante-tante',
      'Bertambah umur == Berkurang umur',
      'Semakin banyak beban dan tanggungjawab',
      'Semoga teteh bisa menganggungnya dengan sabar',
      'Semoga teteh bisa menjadi wanita yang lebih hebat dari sekarang',
      'Semoga teteh bisa menjadi yang terbaik dari diri teteh sendiri',
      'Semoga teteh tetep sehat dan bahagia',
      'Aamiin',
      'Udh mungkin dari aku itu aja',
      'Maafkan kalau seadanya',
      'Sekali lagi, selamat ulang tahun',
      'Naenah Agustin'
    ]

    $(document).ready(() => {
      /* Initialize content */
      $('#pause').hide()
      $('#content').html(messages[id])
    })

    $('#next').on('click', (e) => {
      if (id < (messages.length - 1)) {
        id++
        $('#content').html(messages[id])
      } else {
        $('#content').html('Sudah habis')
        $('#next').html('Off')
        $('#next').attr('disabled', 'true')
      }

      if (id == 8) {
        $('#pause').show()
        audio.play()
      } 
    })

    $('#pause').on('click', () => {
      if (state) {
        audio.pause()
        $('#pause').html('▶')
        state = false
      } else {
        audio.play()
        $('#pause').html('||')
        state = true
      }
    })
  </script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

    * {
      padding: 0;
      margin: 0;
      font-family: 'Open Sans', sans-serif;
    }

    #app {
      width: 50%;
      margin: 4em auto;
      box-sizing: border-box;
    }

    #content {
      font-size: 42pt;
      font-weight: 800;
      color: #ffffff;
      margin-bottom: 2em;
    }

    @media only screen and (max-device-width: 480px) {
      /* styles for mobile browsers smaller than 480px; (iPhone) */
      #app {
        width: 90%;
        margin: 12em auto;
        box-sizing: border-box;
      }

      #content {
        font-size: 28pt;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 2em;
      }
    }


    body {
      height: 100vh;
      text-align: center;
      background: linear-gradient(#3498db, #2980b9);
    }

    .btn {
      font-size: 14pt;
      font-weight: bold;

      padding: 8px 10px;
      border: 0;
      border-radius: 6px;
    }

    .btn-primary {
      color: #fff;
      background-color: #1abc9c;
      transition: background-color .5s;
    }

    .btn-primary:hover {
      cursor: pointer;
      background-color: #16a085;
    }
  </style>
</body>
</html>