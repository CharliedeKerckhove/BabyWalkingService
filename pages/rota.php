<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            selectable: true,
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: 'ajax/loadEvents.php',
            dateClick: function(info) {
                alert('clicked ' + info.dateStr);
            },
            select: function(start, end) {
                $('#viewModal').modal('open');
            }
        });

        calendar.render();
      });

    </script>
<div id='calendar'></div>

<div id="viewModal" class="modal">
  <h2>Edit Event</h2>
  Child Name : <input value="Michael"/><br>
  Collection Address : <input value="Greek Palace, Eyston Drive, Weybridge, Surrey KT13 4AZ"/><br>
  Collection Time : <input value="21st Aug 2019 12:00"/><br>
  Service : <input value="Walking"/><br>
  Length of time : <input value="2"/><br>
  <a href="#" rel="modal:close">Close</a>
  <a href="#" rel="modal:close">Add</a>
</div>

