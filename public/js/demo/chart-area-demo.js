document.addEventListener("DOMContentLoaded", function() {
    const labels = JSON.parse(document.getElementById("labels").value);
    const data = JSON.parse(document.getElementById("data").value);

    const ctx = document.getElementById("myAreaChart").getContext('2d');
    const myAreaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: "Jumlah Kelahiran",
                data: data,
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) { return value + ' ekor'; }
                    }
                }
            },
            plugins: {
                legend: { display: true },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ": " + context.parsed.y + " ekor";
                        }
                    }
                }
            }
        }
    });
});
