<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
            selectable: true,
            height: 'parent',
            contentHeight: 'auto',
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: 'ajax/loadEvents.php',
            editable: true,
            eventClick: function(info) {
                var eventObj = info.event;
                $('#editEvent').modal('open');
            },
            select: function(start, end) {
                var modal = $('#insertEvent').modal('open');
                if(modal){
                    $.ajax({
                        url:'ajax/insertEvents.php',
                        type:'POST',
                        data:{
                            serviceid: serviceid,
                            start: startDate,
                            end: endDate,
                            address: address,
                            postcode: postcode,
                            child: childid
                        },
                        success:function(){
                            calendar.fullCalendar('refetchEvents');
                            alert('Added Successfully!');
                        }
                    });
                }
            }
        });

        calendar.render();
      });

    </script>
<div class="content">
    <div id='calendar'></div>
<!-- Insert Modal -->
    <form method="POST" action="ajax/insertEvent.php" id="insertEvent" class="modal">
        <h2>Insert Event</h2>
        <br>
        <div class="eventCont">
            <label for="childName" class="eventCont">Child Name : </label>
            <input id="childName" name="name" type="text" placeholder="Enter Child Name"/>
        </div>
        <div class="eventCont">    
            <label for="collectionAddress" class="eventCont">Collection Address : </label>
            <input id="collectionAddress" name="address" type="text" placeholder="Enter Collection Address"/>
        </div>
        <div class="eventCont">    
            <label for="collectionPostcode" class="eventCont">Collection Postcode : </label>
            <input id="collectionPostcode" name="postcode" type="text" placeholder="Enter Collection Postcode"/>
        </div>
        <div class="eventCont">    
            <label for="collectionDate" class="eventCont">Collection Date : </label>
            <input id="collectionDate" name="startDate" type="date" placeholder="Select Date"/>
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
<!-- Edit Modal -->
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
