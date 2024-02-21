<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <title>LogBook</title>
</head>
<body>
  
  <div class="container">
    <div class="row">
      <div class="col-12 mt-3">
        <h3 class="text-center py-4" id="tanggal"></h3>
        <a href="{{url('home')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a>
        <div id='calendar'></div>
      </div>
    </div>
  </div>

  <div id="modal-action" class="modal" tabindex="-1">
    
  </div>

    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js'></script>
    
    <!-- Script Date -->
    <script>
      function formatTanggal(tanggal, formatString) {
            var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            var hari = tanggal.getDate();
            var bulanIndex = tanggal.getMonth();
            var tahun = tanggal.getFullYear();

            return formatString.replace(/dd/g, hari)
                            .replace(/MMM/g, bulan[bulanIndex])
                            .replace(/yyyy/g, tahun);
          }

          function tampilkanTanggal() {
            var tanggal = new Date();
            var teksTanggal = formatTanggal(tanggal, "dd MMM yyyy");

            document.getElementById("tanggal").innerHTML = teksTanggal;
          }

          tampilkanTanggal();
    </script>

    {{-- script fullcalendar --}}
    <script>

      const modal = $('#modal-action')

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          themeSystem: 'bootstrap5',
          events: `{{ route('logbook.list') }}`,
          
          // function to handle click logbook create
          dateClick: function(info) {
            // Check if clicked date is today
            const today = new Date();
            const clickedDate = new Date(info.dateStr);

            // Use `isSameDay` for concise comparison
            if (moment(clickedDate).isSame(today, 'day')) {
              // Allow action if clicked date is today
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
            }
          },
        });
        calendar.render();
      });

    </script>

</body>
</html>