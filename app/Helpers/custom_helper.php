
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
?>
