<template>
    <div>
      <h2>Vue Js Google line Charts Demo</h2>
      <canvas id="myChart"></canvas>
    </div>
  </template>

<script>
import Chart from 'chart.js/auto';
export default{
  name: "App",
    mounted() {
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'line',
        data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
    }
}

</script>
