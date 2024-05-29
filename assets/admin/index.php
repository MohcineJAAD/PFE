<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/framework.css">
    <link rel="stylesheet" href="../css/dashbord.css">
    <link rel="stylesheet" href="../css/normalize.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
    <title>Dashboard</title>
</head>

<body>
    <div class="page d-flex">
        <?php require 'sidebar.php';?>
        <div class="content w-full">
            <?php require 'header.php';?>
            <h1 class="p-relative">Dashboard</h1>
            <div class="wrapper d-grid gap-20">
                <div class="cards rad-10 txt-c-mobile block-mobile">
                    <div class="card-content">
                        <h3>Etudient</h3>
                        <p class="value">700</p>
                        <i class="fa-solid fa-user-graduate" style="color: #0075ff;"></i>
                    </div>
                </div>
                <div class="cards rad-10 txt-c-mobile block-mobile">
                    <div class="card-content">
                        <h3>Professeur</h3>
                        <p class="value">80</p>
                        <i class="fa-solid fa-chalkboard-user" style="color: #0075ff;"></i>
                    </div>
                </div>
                <div class="cards rad-10 txt-c-mobile block-mobile">
                    <div class="card-content">
                        <h3>Ressources</h3>
                        <p class="value">284</p>
                        <i class="fa-solid fa-book-open-reader" style="color: #0075ff;"></i>
                    </div>
                </div>
                <div class="cards rad-10 txt-c-mobile block-mobile">
                    <div class="card-content">
                        <h3>Etudient Active</h3>
                        <p class="value">300/600</p>
                        <i class="fa-solid fa-user-check" style="color: #0075ff;"></i>
                    </div>
                </div>
            </div>

            <div class="statistique p-20 bg-fff rad-10 m-20">
                <p>Répartition des étudiants par sexe</p>
                <div class="graphBox">
                    <canvas id="chart"></canvas>
                </div>
            </div>
            <div class="statistique p-20 bg-fff rad-10 m-20">
                <p>Répartition des professeur par sexe</p>
                <div class="graphBox">
                    <canvas id="chart1"></canvas>
                </div>
            </div>
            <div class="statistique p-20 bg-fff rad-10 m-20">
                <p>Répartition des Ressources par type</p>
                <div class="graphBox">
                    <canvas id="chart2"></canvas>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const avatar = document.getElementById("avatar");
            const dropMenu = document.getElementById("dropMenu");

            avatar.addEventListener("click", function(event) {
                event.stopPropagation();
                dropMenu.classList.toggle("drop-menu-Active");
            });

            document.addEventListener("click", function(event) {
                if (!dropMenu.contains(event.target) && !avatar.contains(event.target))
                    dropMenu.classList.remove("drop-menu-Active");
            });
        });
    </script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['PME', 'DSI'],
                datasets: [{
                        label: 'Mâles',
                        data: [150, 180],
                        backgroundColor: '#0075ff',
                        borderColor: '#0056b3',
                        borderWidth: 1
                    },
                    {
                        label: 'Femelles',
                        data: [200, 220],
                        backgroundColor: '#ff0075',
                        borderColor: '#b30056',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        barPercentage: 0.9,
                        categoryPercentage: 0.5
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 50
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' Etudient';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        const ctx1 = document.getElementById('chart1').getContext('2d');
        const chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['PME', 'DSI'],
                datasets: [{
                        label: 'Mâles',
                        data: [150, 180],
                        backgroundColor: '#0075ff',
                        borderColor: '#0056b3',
                        borderWidth: 1
                    },
                    {
                        label: 'Femelles',
                        data: [200, 220],
                        backgroundColor: '#ff0075',
                        borderColor: '#b30056',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        barPercentage: 0.9,
                        categoryPercentage: 0.5
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 50
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' Professeur';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('chart2').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['TD', 'DS', 'National', 'Cour', 'Passage'],
                    datasets: [{
                        label: ['Resource'],
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            '#0075ff'
                        ],
                        borderColor: [
                            '#0075ff'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: true
                            },
                            barPercentage: 0.9,
                            categoryPercentage: 0.5
                        },
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>

</body>

</html>