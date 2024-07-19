@extends('template.appadmin')

@section('title', 'Logbook')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="row">
        <div class="col-12 mt-3">
            <div id='calendar'></div>
        </div>
    </div>

    <div id="modal-action" class="modal" tabindex="-1"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js'></script>

    <script>
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    themeSystem: 'bootstrap5',
                    events: `{{ route('logbook.list') }}`,
                    dateClick: function(info) {
                        const today = new Date();
                        const clickedDate = new Date(info.dateStr);

                        if (moment(clickedDate).isSame(today, 'day')) {
                            $.ajax({
                                url: `{{ route('logbook.check') }}`, // URL untuk mengecek logbook
                                data: {
                                    date: info.dateStr,
                                },
                                success: function(response) {
                                    if (response.exists) {
                                        alert('Logbook sudah ada untuk tanggal ini.');
                                    } else {
                                        $.ajax({
                                            url: `{{ route('logbook.create') }}`,
                                            data: {
                                                date: info.dateStr,
                                            },
                                            success: function(res) {
                                                $('#modal-action').html(res)
                                                    .modal('show');

                                                $('#form-action').on('submit',
                                                    function(e) {
                                                        e.preventDefault();
                                                        const form = this;
                                                        console.log(form
                                                            .action);
                                                        const formData =
                                                            new FormData(
                                                                form);

                                                        $.ajax({
                                                            url: form
                                                                .action,
                                                            method: form
                                                                .method,
                                                            data: formData,
                                                            processData: false,
                                                            contentType: false,
                                                            success: function(
                                                                res
                                                                ) {
                                                                console
                                                                    .log(
                                                                        "Form submitted successfully"
                                                                        );
                                                                $('#modal-action')
                                                                    .modal(
                                                                        'hide'
                                                                        );
                                                                calendar
                                                                    .refetchEvents();
                                                            },
                                                            error: function(
                                                                err
                                                                ) {
                                                                console
                                                                    .log(
                                                                        "Form submit error:",
                                                                        err
                                                                        );
                                                            }
                                                        });
                                                    });
                                            },
                                            error: function(err) {
                                                console.log("AJAX error:", err);
                                            }
                                        });
                                    }
                                },
                                error: function(err) {
                                    console.log("AJAX error:", err);
                                }
                            });
                        }
                    },
                });
                calendar.render();
            }
        });
    </script>


@endsection
