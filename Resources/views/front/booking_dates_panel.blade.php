<div class="section-booking-dates">
    <form method="post" enctype="multipart/form-data" id="form-availability" action="">
        <div class="form-body">
            <div class="form-row box-date box-date-calendar">
                <label class="form-label" for="datepicker-from">Check-in</label>

                <div class="input-container">
                    <input id="datepicker-from" type="text" class="datepicker-wrapper" placeholder="select date" readonly>
                </div>
            </div>

            <div class="form-row box-date box-date-calendar">
                <label class="form-label" for="datepicker-to">Check-out</label>

                <div class="input-container">
                    <input id="datepicker-to" type="text" class="datepicker-wrapper" placeholder="select date" readonly>
                </div>
            </div>

            <div class="form-row">
                <label class="form-label" for="guests">Guests</label>

                <div class="input-container">
                    <input id="guests" type="text" value="2 adults, 2 children" readonly>
                </div>
            </div>

            <div class="box-actions">
                <button type="submit" class="submit-button" value="">Book Now</button>
            </div>
        </div>
    </form>
</div>
