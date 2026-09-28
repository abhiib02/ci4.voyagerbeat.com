
<?php
if (! function_exists('get_Month')) {

    function get_Month(int $number)
    {
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        if ($number != null && $number > 0) {
            return $months[$number - 1];
        }
    }
}

if (! function_exists('extract_month')) {
    function extract_month(string $string)
    {
        $month = substr($string, 3, 2);
        return (int)$month;
    }
}

if (! function_exists('convertDuration')) {
    function convertDuration(string $text)
    {
        // Normalize spaces
        $text = trim(preg_replace('/\s+/', ' ', $text));

        // Extract numbers using regex
        if (preg_match('/(\d+)\s*Night[s]?\s*\/\s*(\d+)\s*Day[s]?/i', $text, $matches)) {
            $nights = ltrim($matches[1], '0'); // remove leading zero
            $days   = ltrim($matches[2], '0'); // remove leading zero
            return $nights . "N/" . $days . "D";
        }

        return $text; // fallback if pattern doesn't match
    }
}
if (! function_exists('extract_both_months')) {
    function extract_both_months(string $string)
    {
        $month[0] = substr($string, 3, 2);
        $month[1] = substr($string, 16, 2);

        $strarr = explode("/", $string);
        $strarr[1] = get_Month((int)$month[0]);
        $strarr[3] = get_Month((int)$month[1]);
        $newString = implode("/", $strarr);

        return $newString;
    }
}

if (! function_exists('renderTravelers')) {
    function renderTravelers(string $data): string
    {
        // Accept a JSON string or an already-decoded array
        if (is_string($data)) {
            $data = json_decode($data, true) ?? [];
        }

        // Group: traveler_2_name => $travelers[2]['name']
        $travelers = [];
        foreach ($data as $key => $value) {
            if (preg_match('/^traveler_(\d+)_(.+)$/', $key, $m)) {
                $travelers[(int) $m[1]][$m[2]] = trim((string) $value);
            }
        }
        ksort($travelers);

        if (empty($travelers)) {
            return '<p class="text-muted">No traveler details found.</p>';
        }

        $html = '<div class="row">';

        foreach ($travelers as $number => $fields) {
            $html .= '<div class="col-md-4 mb-3">';
            $html .= '<div class="card">';
            $html .= '<div class="card-header fw-bold">Traveler ' . $number . '</div>';
            $html .= '<ul class="list-group list-group-flush">';

            foreach ($fields as $field => $value) {
                // "2|double sharing (...)" -> "double sharing (...)"
                if ($field === 'sharing' && str_contains($value, '|')) {
                    $value = explode('|', $value, 2)[1];
                }

                $label = ucfirst(str_replace('_', ' ', $field));

                $html .= '<li class="list-group-item d-flex justify-content-between">'
                    . '<span class="text-muted">' . esc($label) . '</span>'
                    . '<span>' . esc(ucfirst($value)) . '</span>'
                    . '</li>';
            }

            $html .= '</ul></div></div>';
        }

        return $html . '</div>';
    }
}
if (! function_exists('statusToClass')) {
    function statusToClass(string $status): string
    {
        $map = [
            'Pending'          => 'status-pending',
            'Complete'         => 'status-complete',
            'Cancel'           => 'status-cancel',
            'Failed / Unknown' => 'status-failed-unknown',
        ];

        return $map[$status] ?? 'status-unknown';
    }
}
?>
