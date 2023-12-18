<x-layout>
    <x-page-title>Gantt Chart Progress</x-page-title>

    <div class="w-full h-96">
        <div id="gantt_here" class="flex w-full h-full"></div>

        <div class="flex flex-row">
            <div class="w-full"><canvas id="pie"></canvas></div>
            <div class="w-full"><canvas id="bar"></canvas></div>
        </div>
    </div>
    
</x-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
(async function() {
  const data = [
    { year: 2010, count: 10 },
    { year: 2011, count: 20 },
    { year: 2012, count: 15 },
    { year: 2013, count: 25 },
    { year: 2014, count: 22 },
    { year: 2015, count: 30 },
    { year: 2016, count: 28 },
  ];

  new Chart(
    document.getElementById('pie'),
    {
      type: 'pie',
      data: {
        labels: data.map(row => row.year),
        datasets: [
          {
            label: 'Acquisitions by year',
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
  new Chart(
    document.getElementById('bar'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.year),
        datasets: [
          {
            label: 'Acquisitions by year',
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
})();
</script>
<script>
    let userId = {{ auth()->user()->id }};
</script>
@vite('resources/js/gantt.js')