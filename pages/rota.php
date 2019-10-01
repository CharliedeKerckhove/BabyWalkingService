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
            var id = eventObj.id;

            $.ajax({
            url:'ajax/editEvent.php',
            type:'POST',
            data: {BookingID: id},
            success:function(data){
                var data = JSON.parse(data);
                $('#editEvent #service').val(data.ServiceName),
                $('#editEvent #collectionDate').val(data.BookingDate),
                $('#editEvent #startTime').val(data.StartTime),
                $('#editEvent #endTime').val(data.EndTime),
                $('#editEvent #collectionAddress').val(data.CollectionAddress),
                $('#editEvent #collectionPostcode').val(data.CollectionPostcode),
                $('#editEvent #childName').val(data.FirstName),
                $('#editEvent #carerPhone').val(data.PhoneNumber)
       
                $('#editEvent').modal('open');
            }
        });
            
        },
        select: function(start, end) {
            $('#insertEvent').modal('open');
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
            FirstName: $('#childName').val(),
            PhoneNumber: $('#carerPhone').val()
        };
        $.ajax({
            url:'ajax/insertEvent.php',
            type:'POST',
            data: data,
            success:function(){
                calendar.refetchEvents();
                $.modal.close();
            }
        });
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
            <input id="childName" name="childName" type="text" placeholder="Enter Child Name"/>
        </div>
        <div class="eventCont">
            <label for="carerPhone" class="eventCont">Carer Phone Number: </label>
            <input id="carerPhone" name="carerPhone" type="tel" placeholder="Enter Carer Phone Number"/>
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
            <select id="service" class="serviceInput">
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
    </div>
<!-- Edit Modal -->
    <div id="editEvent" class="modal">
        <h2>Edit Event</h2>
        <br>
        <div class="eventCont">
            <label for="childName" class="eventCont">Child Name : </label>
            <input id="childName" name="childName" type="text" placeholder="Enter Child Name"/>
        </div>
        <div class="eventCont">
            <label for="carerPhone" class="eventCont">Carer Phone Number: </label>
            <input id="carerPhone" name="carerPhone" type="tel" placeholder="Enter Carer Phone Number"/>
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
            <select id="service" class="serviceInput">
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
            <button class="altbtn" id="deleteBtn">Delete</button>
            <button type="submit" class="altbtn" id="updateBtn">Update</button>
        </div> 
    </div>
</div>
