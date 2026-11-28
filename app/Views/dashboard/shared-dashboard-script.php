<?php

/**
 * @var array $Annual_Revenue
 * @var array $Annual_Pax
 * @var array $Annual_Booking
 * @var array $BookingCountByStatus
 * @var array $EmployeeBooking_Month
 * @var array $BookingCountByHeard
 */
?>
<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.5.1/dist/chart.umd.min.js
"></script>
<script>
    function getRandomRgbaColor(opacity = 0.5) {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);
        return `rgba(${r}, ${g}, ${b}, ${opacity})`;
    }
</script>
<script>
    let employeeBooking_month_data = <?= json_encode($EmployeeBooking_Month) ?>;

    const employeeBookingLabels = employeeBooking_month_data.map(item => item.agent_name);
    const employeeBookingColors = employeeBooking_month_data.map(item => getRandomRgbaColor());
    const employeeBookingData = employeeBooking_month_data.map(item => parseInt(item.total_bookings));
    const employeeBookedPaxData = employeeBooking_month_data.map(item => parseInt(item.total_pax));
    const employeeBookedRevenueGenerated = employeeBooking_month_data.map(item => parseInt(item.revenue_generated));


    var EmployeesBookingsCtx = document.getElementById("Employees-Bookings").getContext("2d");
    const EmployeesBookingsChart = new Chart(EmployeesBookingsCtx, {
        type: 'bar',
        data: {
            labels: employeeBookingLabels,
            datasets: [{
                    label: 'Total Bookings',
                    data: employeeBookingData,
                    backgroundColor: employeeBookingColors,
                    borderColor: employeeBookingColors,
                    borderWidth: 1,
                    yAxisID: 'y',
                }, {
                    label: 'Total Pax',
                    data: employeeBookedPaxData,
                    backgroundColor: employeeBookingColors,
                    borderColor: employeeBookingColors,
                    borderWidth: 1,
                    yAxisID: 'y',
                },
                {
                    label: 'Revenue Generated ₹',
                    data: employeeBookedRevenueGenerated,
                    backgroundColor: employeeBookingColors,
                    borderColor: employeeBookingColors,
                    borderWidth: 1,
                    yAxisID: 'y1',
                }
            ],

        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    position: 'left',
                    beginAtZero: true
                },
                y1: {
                    type: 'linear',
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false // Prevents grid lines from overlapping and cluttering the chart
                    }
                },
            }
        },
    });
    EmployeesBookingsChart.update();
</script>
<script>
    let month_revenue_data = <?= json_encode($Annual_Revenue) ?>;
    let month_pax_data = <?= json_encode($Annual_Pax) ?>;
    let month_booking_data = <?= json_encode($Annual_Booking) ?>;

    var AnnualDatactx = document.getElementById("annual-sales").getContext("2d");
    const AnnualDataChart = new Chart(AnnualDatactx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ],
            datasets: [{
                    label: 'Sales : ₹',
                    data: month_revenue_data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    cubicInterpolationMode: 'monotone',
                    type: 'line',
                    yAxisID: 'y',

                },
                {
                    label: 'Total Adults Sent : ',
                    data: month_pax_data,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    cubicInterpolationMode: 'monotone',
                    yAxisID: 'y1',

                },
                {
                    label: 'Total Complete Booking :',
                    data: month_booking_data,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 2,
                    cubicInterpolationMode: 'monotone',
                    yAxisID: 'y1',

                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true, // Enabled legend so users can distinguish the 3 datasets
                    position: 'top',
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    position: 'left',
                    beginAtZero: true
                },
                y1: {
                    type: 'linear',
                    position: 'right',
                    beginAtZero: true,
                    grid: {
                        drawOnChartArea: false // Prevents grid lines from overlapping and cluttering the chart
                    }
                },
            }
        }
    });
    AnnualDataChart.update();
</script>

<script>
    let BookingCountbyStatus = <?= json_encode($BookingCountByStatus) ?>;

    // Extract labels and numbers dynamically from your array
    const statusLabels = BookingCountbyStatus.map(item => item.status_name);
    const statusData = BookingCountbyStatus.map(item => parseInt(item.bookings_count));

    var AllStatusBookingctx = document.getElementById("booking-status").getContext("2d");
    const AllStatusBookingchart = new Chart(AllStatusBookingctx, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Bookings Count',
                data: statusData,
                backgroundColor: [
                    'rgba(85, 83, 84, 0.7)',
                    'rgba(49, 206, 1, 0.7)',
                    'rgba(27, 129, 197, 0.7)',
                    'rgba(185, 14, 14, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(10, 187, 211, 0.7)'
                ],
                borderColor: [
                    'rgba(85, 83, 84, 0.7)',
                    'rgba(49, 206, 1, 0.7)',
                    'rgba(27, 129, 197, 0.7)',
                    'rgba(185, 14, 14, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(10, 187, 211, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true, // Allows you to set custom height via CSS wrapper
            // OR if you want to keep the aspect ratio but make it wider/narrower:
            aspectRatio: 2, // Default is 1 (square). Higher numbers make it wider.
            plugins: {
                legend: {
                    position: 'none',
                },
                title: {
                    display: false,
                    text: 'Bookings By Status'
                }
            }
        },
    });
</script>
<script>
    let BookingCountByHeard = <?= json_encode($BookingCountByHeard) ?>;

    // Extract labels and numbers dynamically from your array
    const heardstatusLabels = BookingCountByHeard.map(item => item.heard);
    const heardstatusData = BookingCountByHeard.map(item => parseInt(item.count));

    var heardstatusctx = document.getElementById("heard-status").getContext("2d");
    const heardchart = new Chart(heardstatusctx, {
        type: 'bar',
        data: {
            labels: heardstatusLabels,
            datasets: [{

                data: heardstatusData,
                backgroundColor: [
                    'rgba(85, 83, 84, 0.3)',
                    'rgba(193, 53, 132,0.3)',
                    'rgba(185, 14, 14, 0.3)',
                    'rgba(27, 129, 197, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(10, 187, 211, 0.3)'
                ],
                borderColor: [
                    'rgba(85, 83, 84, 0.7)',
                    'rgba(193, 53, 132,0.7)',
                    'rgba(185, 14, 14, 0.7)',
                    'rgba(27, 129, 197, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(10, 187, 211, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            maintainAspectRatio: false,
            elements: {
                bar: {
                    borderWidth: 2,
                }
            },
            plugins: {
                legend: {
                    display: false // hides all dataset labels
                }
            }
        },
    });
</script>