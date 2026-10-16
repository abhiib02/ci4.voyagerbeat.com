<?php
if (! function_exists('getDateString')) {
    function getDateString(int $month, int $year): array
    {
        $year = (int) $year;
        $month = (int) $month;
        $startDate = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01 00:00:00";
        $endDate = date("Y-m-t 23:59:59", strtotime($startDate));
        $startEndArr = [$startDate, $endDate];
        return $startEndArr;
    }
}
if (! function_exists('getMonthName')) {
    function getMonthName($monthNumber): ?string
    {
        if (!is_numeric($monthNumber) || $monthNumber < 1 || $monthNumber > 12) {
            return null;
        }
        return DateTime::createFromFormat('!m', $monthNumber)->format('F');
    }
}
