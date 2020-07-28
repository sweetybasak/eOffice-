<?php $this->load->view('trainings/trainings_header'); ?>
<link rel='stylesheet' href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.css' />

<script src='https://fullcalendar.io/js/fullcalendar-3.3.1/lib/moment.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.3.1/lib/jquery.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.3.1/lib/jquery-ui.min.js'></script>
<script src='https://fullcalendar.io/js/fullcalendar-3.3.1/fullcalendar.min.js'></script>


<script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left:'prev,next,today',
                center:'title',
                right:'month,agendaWeek,agendaDay',
                allDay:true
            },
            eventSources: [
               {
                   events: function(start, end, timezone, callback) {
                       $.ajax({
                           url: '<?php echo base_url(); ?>calendar/get_events',
                           dataType: 'json',
                           data: {
                               start: start.unix(),
                               end: end.unix(),
                               allDay: true
                           },
                           success: function(msg) {
                               var events = msg.events;
                               callback(events);
                           }
                       });
                   }
               },
                    ]
        });
    });
</script>


<body>
    <br><br>

    <main id="main">
        <section id="contact">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="offset-sm-2 col-sm-8">
                            <div class="card text-blank border-1">
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <h5><i class="fa fa-calendar"></i>Training Calendar</h5>
                                    </div>
                                    <div class="card-text">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                       
                         </div>
                    </div>
            </div>
        </section>
    </main>
</body>
  
