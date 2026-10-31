<div id="error-log" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Error Log</div>
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
            $request = service('request');
            $date    = $request->getGet('date') ?? date('Y-m-d');

            if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                $date = date('Y-m-d');
            }

            $logFileName = WRITEPATH . 'logs/log-' . $date . '.log';
            $lines = is_file($logFileName) ? (file($logFileName, FILE_IGNORE_NEW_LINES) ?: []) : [];

            // Hide DEBUG, keep the last 500 lines
            $lines = array_filter($lines, static fn($l) => ! str_starts_with($l, 'DEBUG -'));
            $lines = array_slice($lines, -500);

            $classes = [
                'CRITICAL'  => 'log-critical',
                'EMERGENCY' => 'log-critical',
                'ALERT'     => 'log-critical',
                'ERROR'     => 'log-error',
                'WARNING'   => 'log-warning',
            ];

            $html = '';
            foreach ($lines as $line) {
                $class = '';
                foreach ($classes as $level => $css) {
                    if (str_starts_with($line, $level . ' -')) {
                        $class = $css;
                        break;
                    }
                }
                $html .= '<span class="log-line ' . $class . '">' . esc($line) . "</span>\n";
            }
            ?>

            <style>
                .log-viewer {
                    /* background: #1e1e1e;
                    color: #d4d4d4; */
                    padding: 12px;
                    overflow: auto;
                    max-height: 70vh;
                    font-size: 13px;
                }

                .log-line {
                    display: inline;
                    white-space: pre-wrap;
                    padding: 1px 6px;
                }

                .log-warning {
                    color: #856404;
                    background: #fff3cd;
                }

                .log-error {
                    color: #842029;
                    background: #f8d7da;
                }

                .log-critical {
                    color: #fff;
                    background: #dc3545;
                    font-weight: bold;
                }
            </style>

            <pre class="log-viewer">
                <?= $html !== '' ? $html : esc('No log entries found for date: ' . $date) ?>
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