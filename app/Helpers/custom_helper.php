
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

if (! function_exists('statusToClass')) {
    function statusToClass(string $status): string
    {
        $map = [
            'Pending'           => 'status-pending',
            'Complete'          => 'status-complete',
            'Complete_no_points' => 'status-complete_no_points',
            'Cancel'            => 'status-cancel',
            'Postponed'         => 'status-postponed',
            'Failed / Unknown'  => 'status-failed',
        ];

        return $map[$status] ?? 'status-unknown';
    }
}
if(! function_exists('gdriveImage')){
    function gdriveImage(string $driveLink,int $width = 1024) : string {
        if(!str_contains($driveLink, 'drive.google.com')){
            return $driveLink;
        }
        $id = explode('/', $driveLink)[5];
        return "https://lh3.googleusercontent.com/d/$id=w$width";
    }
}
?>

