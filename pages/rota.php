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
            $('#editEvent').modal('show');
        },
        select: function(start, end) {
            $('#insertEvent').modal('show');
        }
    });
    calendar.render();

    $('#insertBtn').on("click", function(e){
        e.preventDefault();
        var data = {
            serviceid: $('#service').val(),
            date: $('#collectionDate').val(),
            startTime: $('#startTime').val(),
            endTime: $('#endTime').val(),
            address: $('#collectionAddress').val(),
            postcode: $('#collectionPostcode').val(),
            child: '1'
        };
        $.ajax({
            url:'ajax/insertEvent.php',
            type:'POST',
            data: data,
        });
        calendar.refetchEvents();
        $('#insertEvent').modal('hide');
        
    });
});

    </script>
<div class="content">
    <div id='calendar'></div>
<!-- Insert Modal -->
    <div id="insertEvent" class="modal">
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
            <input id="collectionDate" name="date" type="date" placeholder="Select Date"/>
        </div>
        <div class="eventCont" style="justify-content:flex-end;">
            <div style="display:inline-flex;">    
                <label for="startTime" class="eventCont">From : </label>
                <input id="startTime" name="startTime" type="time" placeholder="Select Start Time" style="margin-left:5px;margin-right:10px;"/>
            </div>
            <div style="display:inline-flex;">
                <label for="endTime" class="eventCont">To : </label>
                <input id="endTime" name="endTime" type="time" placeholder="Select End Time" style="margin-left:5px;"/>
            </div>
        </div>
        <div class="eventCont">    
            <label>Service : </label>
            <select id="service">
            <?php
             $query = 'SELECT * FROM `service`';
             $service = $DBH->prepare($query);
             $service->execute();
             while($row = $service->fetch(PDO::FETCH_ASSOC)) { 
                echo "<option value='".$row["ServiceID"]."'> ".$row['ServiceName']."</option>";
            }
            ?>
            </select>
        </div>
            <br>
        <div style="display: flex">
            <button class="altbtn"><a href="#" rel="modal:close">Close</a></button>
            <button type="submit" class="altbtn" id="insertBtn">Add</button>
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
