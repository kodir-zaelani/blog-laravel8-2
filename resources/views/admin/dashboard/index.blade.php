@extends('admin.templates.default')
@section('title', 'Dashboard') 
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('title')</h1>
            </div>
            <div class="col-sm-6 ">
                <ol class="breadcrumb float-sm-right">
                </ol>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      {{-- <h3>{{ count($posts) }}</h3> --}}
      
                      <p>Post Update</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-bag"></i>
                    </div>
                    {{-- <a href="{{ route('admin.posts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      {{-- <h3>{{ count($pages) }}</h3> --}}
      
                      <p>Pages</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                    {{-- <a href="{{ route('admin.pages.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      {{-- <h3>{{ count($users) }}</h3> --}}
      
                      <p>User Registrations</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    {{-- <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>65</h3>
      
                      <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
              <!-- Main row -->
              <div class="row">
                <div class="col-md-3">
                  <div class="mb-3 sticky-top">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">Draggable Events</h4>
                      </div>
                      <div class="card-body">
                        <!-- the events -->
                        <div id="external-events">
                          <div class="external-event bg-success">Lunch</div>
                          <div class="external-event bg-warning">Go home</div>
                          <div class="external-event bg-info">Do homework</div>
                          <div class="external-event bg-primary">Work on UI design</div>
                          <div class="external-event bg-danger">Sleep tight</div>
                          <div class="checkbox">
                            <label for="drop-remove">
                              <input type="checkbox" id="drop-remove">
                              remove after drop
                            </label>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Create Event</h3>
                      </div>
                      <div class="card-body">
                        <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                          <!--<button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>-->
                          <ul class="fc-color-picker" id="color-chooser">
                            <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                            <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                          </ul>
                        </div>
                        <!-- /btn-group -->
                        <div class="input-group">
                          <input id="new-event" type="text" class="form-control" placeholder="Event Title">
      
                          <div class="input-group-append">
                            <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                          </div>
                          <!-- /btn-group -->
                        </div>
                        <!-- /input-group -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card card-primary">
                    <div class="p-0 card-body">
                      <!-- THE CALENDAR -->
                      <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
          </section>
    </div>
</section> 

@endsection

@push('styles')
    <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ url('') }}/assets/admin/plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/admin/plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/admin/plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/admin/plugins/fullcalendar-bootstrap/main.min.css">
@endpush

@push('scripts')
    <!-- fullCalendar 2.2.5 -->
    <!-- jQuery UI -->
<script src="{{ url('') }}/assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{ url('') }}/assets/admin/dist/js/demo.js"></script>
<script src="{{ url('') }}/assets/admin/plugins/moment/moment.min.js"></script>
<script src="{{ url('') }}/assets/admin/plugins/fullcalendar/main.min.js"></script>
<script src="{{ url('') }}/assets/admin/plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="{{ url('') }}/assets/admin/plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="{{ url('') }}/assets/admin/plugins/fullcalendar-interaction/main.min.js"></script>
<script src="{{ url('') }}/assets/admin/plugins/fullcalendar-bootstrap/main.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        console.log(eventEl);
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      'themeSystem': 'bootstrap',
      //Random default events
      events    : [
        {
          title          : 'All Day Event',
          start          : new Date(y, m, 1),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954', //red
          allDay         : true
        },
        {
          title          : 'Long Event',
          start          : new Date(y, m, d - 5),
          end            : new Date(y, m, d - 2),
          backgroundColor: '#f39c12', //yellow
          borderColor    : '#f39c12' //yellow
        },
        {
          title          : 'Meeting',
          start          : new Date(y, m, d, 10, 30),
          allDay         : false,
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7' //Blue
        },
        {
          title          : 'Lunch',
          start          : new Date(y, m, d, 12, 0),
          end            : new Date(y, m, d, 14, 0),
          allDay         : false,
          backgroundColor: '#00c0ef', //Info (aqua)
          borderColor    : '#00c0ef' //Info (aqua)
        },
        {
          title          : 'Birthday Party',
          start          : new Date(y, m, d + 1, 19, 0),
          end            : new Date(y, m, d + 1, 22, 30),
          allDay         : false,
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a' //Success (green)
        },
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }    
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      ini_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
@endpush