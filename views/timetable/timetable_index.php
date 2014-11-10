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
                right: 'basicDay,basicWeek,month'
            },
            defaultDate: moment().format(),
            defaultView: 'basicWeek',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?=$timetable ?>,
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
        max-width: 900px;
        margin: 0 auto;
    }

    #calendar .fc-title a{
        color: white;
    }

    #calendar div.fc-content{
        text-align: center;
    }
</style>
<div id='calendar'></div>

<?php
    var_dump($lectures)
?>

<?foreach( $lectures as $lecture ):?>

    <h1><?=$lectures['subject_id']?></h1>

<?endforeach?>