<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            selectable: true,
            contentHeight: 400,
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: 'ajax/loadEvents.php',
            /* dateClick: function(info) {
                alert('clicked ' + info.dateStr);
            }, */
            select: function(start, end) {
                $('#insertEvent').modal('open');
                
               /*  if(editEvent) {
                    calendar.addEvent({
                        title: $row['Length'] . "Hr " . $row['ServiceName'],
                        start: date,
                        allDay: true
                    });
                } */
            }
        });

        calendar.render();
      });

    </script>
<div class="content">
    <div id='calendar'></div>

    <form method="POST" action="ajax/insertEvent.php" id="insertEvent" class="modal">
        <h2>Insert Event</h2>
        <br>
        <div class="eventCont">
            <label class="eventCont">Child Name : </label><input type="text" placeholder="Enter Child Name"/>
        </div>
        <div class="eventCont">    
            <label class="eventCont">Collection Address : </label><input type="text" placeholder="Enter Collection Address"/>
        </div>
        <div class="eventCont">    
            <label class="eventCont">Collection Date : </label><input type="date" placeholder="Select Date"/>
        </div>
        <div class="eventCont">    
            <label>Service : </label>
            <select>
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
        </div>
            <br>
        <div style="display: flex">
            <button class="altbtn"><a href="#" rel="modal:close">Close</a></button>
            <button type="submit" class="altbtn"><a href="#" rel="modal:close">Add</a></button>
        </div> 
    </form>

    <form method="POST" action="ajax/editEvent.php" id="viewModal" class="modal">
        <h2>Edit Event</h2>
        <br>
        <label class="eventCont">Child Name :</label> <input type="text" placeholder="Enter Child Name"/><br>
            <label class="eventCont">Collection Address :</label> <input type="text" placeholder="Enter Collection Address"/><br>
            <label class="eventCont">Collection Date :</label> <input type="date" placeholder="Select Date"/><br>
            <label class="eventCont">Service : </label>
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            <br>
        <div style="display: flex">
            <button class="altbtn"><a href="#" rel="modal:close">Close</a></button>
            <button type="submit" class="altbtn"><a href="#" rel="modal:close">Add</a></button>
        </div> 
    </form>
</div>
