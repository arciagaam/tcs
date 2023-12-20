<x-layout>
  <div class="flex flex-col mx-20 my-10 gap-5">
    <x-page-title>Gantt Chart Progress</x-page-title>

    <div class="flex flex-col w-full h-screen gap-10">
        <div id="gantt_here" class="flex w-full h-1/2"></div>

        <div class="flex flex-row items-center justify-center gap-20">
            <div class="w-1/4"><canvas id="pie"></canvas></div>
            <div class="w-1/2"><canvas id="bar"></canvas></div>
        </div>
    </div>
  </div>
</x-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  var userId = {{ auth()->user()->id }};
  
  async function fetchData() {
    try {
      const response = await fetch(`/submissionChart/${userId}`);
      
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      
      const jsonData = await response.json(); // Assuming JSON response
      
      // Handle the fetched data here
      console.log(jsonData);
      const mappedData = jsonData.data.map(item => ({
        fileName: item.file_name,
        dateOfsubmission: item.created_at
      }))
      console.log(mappedData);

      const submissionsByDay = mappedData.reduce((accumulator, mappedData) => {
      const date = new Date(mappedData.dateOfsubmission); // Convert string to Date object
      const formattedDate = new Date(date.getFullYear(), date.getMonth(), date.getDate()); // Extract only date without time
      const dateString = formattedDate.toISOString().split('T')[0]; // Format date as 'YYYY-MM-DD'
      
      accumulator[dateString] = (accumulator[dateString] || 0) + 1;
      return accumulator;
    }, {});

      const averageSubmissionsPerDay = Object.values(submissionsByDay).reduce((sum, count) => sum + count, 0) / Object.keys(submissionsByDay).length;

      function getWeekNumber(d) {
        d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
        d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));
        const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
        const weekNumber = Math.ceil(((d - yearStart) / 86400000 + 1) / 7);
        return weekNumber;
      }

      // Group submissions by week
      const submissionsByWeek = Object.entries(submissionsByDay).reduce((accumulator, [date, count]) => {
        const submissionDate = new Date(date);
        const week = `${submissionDate.getFullYear()}-${getWeekNumber(submissionDate)}`;
        accumulator[week] = (accumulator[week] || 0) + count;
        return accumulator;
      }, {});
      // Calculate average submissions per week
      const averageSubmissionsPerWeek = Object.values(submissionsByWeek).reduce((sum, count) => sum + count, 0) / Object.keys(submissionsByWeek).length;

      // Group submissions by month
      const submissionsByMonth = Object.entries(submissionsByDay).reduce((accumulator, [date, count]) => {
        const submissionDate = new Date(date);
        const month = `${submissionDate.getFullYear()}-${submissionDate.getMonth() + 1}`;
        accumulator[month] = (accumulator[month] || 0) + count;
        return accumulator;
      }, {});
      // Calculate average submissions per month
      const averageSubmissionsPerMonth = Object.values(submissionsByMonth).reduce((sum, count) => sum + count, 0) / Object.keys(submissionsByMonth).length;
      
      console.log(averageSubmissionsPerWeek);

      const submissionCount = {
        Day: averageSubmissionsPerDay,
        Week: averageSubmissionsPerWeek,
        Month: averageSubmissionsPerMonth
      };

      new Chart(
        document.getElementById('pie'),
        {
          type: 'pie',
          data: {
            labels: ['Day', 'Week', 'Month'], // Labels for each period
            datasets: [
              {
                label: 'Average Submissions',
                data: [submissionCount.Day, submissionCount.Week, submissionCount.Month],
                backgroundColor: [
                  'rgba(255, 99, 132, 0.6)', // Color for Day
                  'rgba(54, 162, 235, 0.6)', // Color for Week
                  'rgba(255, 206, 86, 0.6)' // Color for Month
                ],
              }
            ]
          },
        }
      );
      new Chart(
        document.getElementById('bar'),
        {
          type: 'bar',
          data: {
            labels: ['Day', 'Week', 'Month'], // Labels for each period
            datasets: [
              {
                label: 'Average Submissions',
                data: submissionCount,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.6)', // Color for Day
                  'rgba(54, 162, 235, 0.6)', // Color for Week
                  'rgba(255, 206, 86, 0.6)' // Color for Month
                ],
              }
            ]
          },
        }
      );
    } catch (error) {
      // Handle errors here
      console.error('There was a problem with the fetch operation:', error);
    }
  }

  // Invoke the fetchData function
  fetchData();
</script>
@vite('resources/js/gantt.js')