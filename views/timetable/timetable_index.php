<link href='assets/components/fullcalendar/2.1.1/fullcalendar.css' rel='stylesheet'/>
<link href='assets/components/fullcalendar/2.1.1/fullcalendar.print.css' rel='stylesheet' media='print'/>
<link href='assets/components/fullcalendar/2.1.1/timetable.css' rel='stylesheet'/>
<script src='assets/components/fullcalendar/2.1.1/lib/moment.min.js'></script>
<script src='assets/components/fullcalendar/2.1.1/lib/jquery.min.js'></script>
<script src='assets/components/fullcalendar/2.1.1/fullcalendar.js'></script>
<script src='assets/components/fullcalendar/2.1.1/lang/est.js'></script>
<script>

    $(document).ready(function () {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,agendaWeek,month'
            },
            defaultDate: moment().format(),
            defaultView: 'agendaWeek',
            editable: true,
            height: "auto",
            minTime: "08:00:00",
            maxTime: "22:00:00",
            weekends: false,
            allDaySlot: false,
            eventLimit: true, // allow "more" link when too many events
            events: <?=$schedule ?>,
            eventBackgroundColor:"#f8f8f8",
            eventBorderColor:"#e7e7e7",
            eventColor: "#333",
            eventRender: function (event, element) {
                element.find('.fc-title').html(event.title);

            }
        });
    });

</script>

<style>

    body {
        margin: 40px 10px;
        padding: 0;
        font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
        font-size: 14px;
    }

    #calendar {
        margin: 0 auto;
    }

    #calendar .fc-title a, .fc-time{
        color: #333;
    }

    #calendar div.fc-content{
    }

</style>
<div id='calendar'></div>