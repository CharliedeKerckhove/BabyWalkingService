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
        eventOverlap: false,
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
                $('#editEvent #bookingID').val(data.BookingID),
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

    /* Insert data */
    $('#insertBtn').on("click", function(e){
        e.preventDefault();
        var data = {
            serviceid: $('#insertEvent #service').val(),
            date: $('#insertEvent #collectionDate').val(),
            startTime: $('#insertEvent #startTime').val(),
            endTime: $('#insertEvent #endTime').val(),
            address: $('#insertEvent #collectionAddress').val(),
            postcode: $('#insertEvent #collectionPostcode').val(),
            FirstName: $('#insertEvent #childName').val(),
            PhoneNumber: $('#insertEvent #carerPhone').val()
        };
        var errors = 0;
        if(data.FirstName == "") {
            errors++;
        }
        if(data.date == "") {
            errors++;
        }
        if(data.startTime == "") {
            errors++;
        }
        if(data.endTime == "") {
            errors++;
        }
        if(data.address == "") {
            errors++;
        }
        if(data.postcode == "") {
            errors++;
        }
        if(data.PhoneNumber == "") {
            errors++;
        }
        if(data.serviceid == "") {
            errors++;
        }

        if(errors > 0) {
            $('#insertErrors').show();
            return;
        }

        $.ajax({
            url:'ajax/insertEvent.php',
            type:'POST',
            data: data,
            success:function(){
                calendar.refetchEvents();
                $('#insertErrors').hide();
                $.modal.close();
            }
        });
    });
    /* Update data */
    $('#updateBtn').on("click", function(e){
        e.preventDefault();
        var data = {
            bookingid: $('#editEvent #bookingID').val(),
            serviceid: $('#editEvent #service').val(),
            date: $('#editEvent #collectionDate').val(),
            startTime: $('#editEvent #startTime').val(),
            endTime: $('#editEvent #endTime').val(),
            address: $('#editEvent #collectionAddress').val(),
            postcode: $('#editEvent #collectionPostcode').val(),
            FirstName: $('#editEvent #childName').val(),
            PhoneNumber: $('#editEvent #carerPhone').val()
        };
        $.ajax({
            url:'ajax/updateEvent.php',
            type:'POST',
            data: data,
            success:function(){
                calendar.refetchEvents();
                $.modal.close();
            }
        });
    });
    /* Delete data */
    $('#deleteBtn').on("click", function(e){
        e.preventDefault();
        var data = {
            bookingid: $('#editEvent #bookingID').val()
        };
        $.ajax({
            url:'ajax/deleteEvent.php',
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
            <input id="collectionDate" class="datetimepicker bookingdtp" name="date" type="text" placeholder="Select Date" autocomplete="off"/>
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
        <h3 id="insertErrors" class="errormsg popupErrorTxt">Error: Please complete all fields</h3>
    </div>
<!-- Edit Modal -->
    <div id="editEvent" class="modal">
        <h2>Edit Event</h2>
        <br>
        <input id="bookingID"  type="hidden" name="bookingID" value=""/>
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
            <input id="collectionDate" class="datetimepicker bookingdtp" name="date" type="text" placeholder="Select Date" autocomplete="off"/>
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
        <h3 id="editErrors" class="errormsg popupErrorTxt">Error: Please complete all fields</h3>
    </div>
</div>
