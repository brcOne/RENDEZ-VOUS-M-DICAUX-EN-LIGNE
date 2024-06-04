<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" /> --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Sedan+SC&display=swap');
    
    </style>
    <title>@yield('title', 'My App')</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body class="flex h-screen bg-bodyColor">

    @if (!in_array(Route::currentRouteName(), ['doctorLoginView', 'doctorSignupView']))
        @include('layouts.doctor-sideBar')
    @endif

    <main class="flex-1 p-5 bg-bodyColor font-Rubik ">

        @yield('main')

    </main>


    <script>
         document.addEventListener('DOMContentLoaded', function () {
        var closeButton = document.querySelector('.close-toast');
        var toastSuccess = document.getElementById('toast-success');

        closeButton.addEventListener('click', function () {
            toastSuccess.style.display = 'none';
        });
    });


        const getChartOptions = (maleCount, femaleCount) => {
            return {
                series: [maleCount, femaleCount],
                colors: ["#04A6C2", "#F765A3"],
                chart: {
                    height: 278,
                    width: "100%",
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: ["Male", "Female"],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + "%"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + "%"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                fetch('/api/gender-counts')
                    .then(response => response.json())
                    .then(data => {
                        const maleCount = data.male;
                        const femaleCount = data.female;

                        const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions(
                            maleCount, femaleCount));
                        chart.render();
                    })
                    .catch(error => console.error('Error fetching gender counts:', error));
            }
        });


        
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

</body>



</html>
