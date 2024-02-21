<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  </head>
    <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-3">
        <a href="{{route('logbook.create')}}" class="btn btn-primary">test</a>
        <div id='calendar'></div>
      </div>
    </div>
  </div>

  <div id="modal-action" class="modal" tabindex="-1">
    
  </div>

    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js'></script>
    <script>

      const modal = $('#modal-action')

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          themeSystem: 'bootstrap5',
          events: `{{ route('logbook.list') }}`,

          // function to render create form logbook
          dateClick: function(info) {
            $.ajax({
              url : `{{ route('logbook.create') }}`,
              data : {
                date: info.dateStr,
              },
              success: function(res){
                modal.html(res).modal('show')

                $('#form-action').on('submit', function (e) {
                  e.preventDefault()

                  const form = this
                  const formData = new FormData(form)

                  $.ajax({
                    url : form.action,
                    method : form.method,
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(res){
                      modal.modal('hide')
                      calendar.refetchEvents()
                    }
                  })
                })
              }
            })
          },
        });
        calendar.render();
      });

    </script>

</body>
</html>