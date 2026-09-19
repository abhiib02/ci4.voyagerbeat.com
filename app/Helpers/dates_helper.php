<?php
if (! function_exists('isCurrentDateNearRange')) {
    function isCurrentDateNearRange(string $dateRangeStr, $thresholdDays = 3)
    {
        // Matches both "DD/MM/YYYY - DD/MM/YYYY" and "DD/MM/YYYY - DD/MM/YYYY|0"
        $pattern = '#^([0-9]+(/[0-9]+)+)\s-\s([0-9]+(/[0-9]+)+)(\|[0-9]+)?$#i';

        if (preg_match($pattern, trim($dateRangeStr))) {
            // Strip any suffix like '|0' before splitting
            $cleanRange = explode('|', $dateRangeStr)[0];
            $startDateStr = explode(' - ', $cleanRange)[0];

            // Normalize both dates to midnight (00:00:00) for clean day calculations
            $startDate = DateTime::createFromFormat('d/m/Y', trim($startDateStr))->setTime(0, 0, 0);
            $currentDate = (new DateTime())->setTime(0, 0, 0);

            // Difference: $currentDate compared to $startDate
            $diff = $currentDate->diff($startDate);

            // %r outputs '-' if $startDate is in the past, otherwise empty string
            return $diff->format('%r%a');
        } else {
            return 'Not In Correct Format';
        }
    }
}
