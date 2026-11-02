<div id="bookingsChangesLog" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Booking Changes Log</div>
        </div>
        <div class="d-flex">
            <form action="" id="bookinglogDate">
                <input type="date" class="form-control" name="date" onchange="this.form.submit()">
            </form>
            <!-- <button class="btn btn-success" type="submit" form="bookinglogDate">Show</button> -->
            <script>
                function submitForm() {

                }
            </script>
        </div>
    </div>
    <div class="card-body">
        <div class="">

            <?php
            // Get today's log file name or a specific log file
            $date = service('request')->getGet('date') ?? date('Y-m-d');
            // Only allow YYYY-MM-DD
            if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                $date = date('Y-m-d');
            }

            $logFileName = WRITEPATH . 'logs/bookingchanges/log-' . $date . '.log';

            if (is_file($logFileName)) {
                $logData = file_get_contents($logFileName);
            } else {
                $logData = 'No log file found for date: ' . $date;
            }
            ?>

            <pre>
                <?= esc($logData) ?>
                <div id="bottom"></div>
        </pre>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const bottomMarker = document.getElementById('bottom');

        // Instantly snaps to the bottom of the section
        bottomMarker.scrollIntoView({
            block: 'end',
            behavior: 'instant'
        });
    });
</script>