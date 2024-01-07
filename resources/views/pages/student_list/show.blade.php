<x-layout>
    <div class="flex flex-row gap-10 h-screen">
        <div class="flex flex-col card w-fit h-1/2">

            <div class="h-28 w-28 rounded-full aspect-square bg-blue-950 overflow-clip self-center">
                @isset($student->profile_picture)
                    <img class="object-cover h-full" src="{{ asset('storage/' . $student->profile_picture) }}" alt="profile picture">
                @endisset
            </div>


            <div class="flex flex-col">
                <p class="font-medium text-black/50 text-sm">Full name</p>
                <p>{{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}</p>
            </div>

            <div class="flex flex-col">
                <p class="font-medium text-black/50 text-sm">Email</p>
                <p>{{ $student->email }}</p>
            </div>

            <hr>

            <div class="flex gap-10">
                <div class="flex flex-col">
                    <p class="font-medium text-black/50 text-sm">Year & Section</p>
                    <p>{{ $student->year . ' ' . $student->section }}</p>
                </div>

                <div class="flex flex-col">
                    <p class="font-medium text-black/50 text-sm">Group Code</p>
                    <p>{{ $student->group_code }}</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full h-full gap-10">
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
    var userId = {{ $student->id }};

    async function fetchData() {
        try {
            const response = await fetch(`/submissionChart/${userId}`);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const jsonData = await response.json(); // Assuming JSON response

            // Handle the fetched data here
            const mappedData = jsonData.data.map(item => ({
                dateOfsubmission: item.created_at,
            }))

            const submissionsByDay = mappedData.reduce((accumulator, mappedData) => {
                const date = new Date(mappedData.dateOfsubmission); // Convert string to Date object
                const formattedDate = new Date(date.getFullYear(), date.getMonth(), date
                    .getDate()); // Extract only date without time
                const dateString = formattedDate.toISOString().split('T')[0]; // Format date as 'YYYY-MM-DD'

                accumulator[dateString] = (accumulator[dateString] || 0) + 1;
                return accumulator;
            }, {});

            const averageSubmissionsPerDay = Object.values(submissionsByDay).reduce((sum, count) => sum + count,
                0) / Object.keys(submissionsByDay).length;

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
            const averageSubmissionsPerWeek = Object.values(submissionsByWeek).reduce((sum, count) => sum + count,
                0) / Object.keys(submissionsByWeek).length;

            // Group submissions by month
            const submissionsByMonth = Object.entries(submissionsByDay).reduce((accumulator, [date, count]) => {
                const submissionDate = new Date(date);
                const month = `${submissionDate.getFullYear()}-${submissionDate.getMonth() + 1}`;
                accumulator[month] = (accumulator[month] || 0) + count;
                return accumulator;
            }, {});
            // Calculate average submissions per month
            const averageSubmissionsPerMonth = Object.values(submissionsByMonth).reduce((sum, count) => sum + count,
                0) / Object.keys(submissionsByMonth).length;

            const submissionCount = {
                Day: averageSubmissionsPerDay,
                Week: averageSubmissionsPerWeek,
                Month: averageSubmissionsPerMonth
            };

            new Chart(
                document.getElementById('pie'), {
                    type: 'pie',
                    data: {
                        labels: ['Day', 'Week', 'Month'], // Labels for each period
                        datasets: [{
                            label: 'Average Submissions',
                            data: [submissionCount.Day, submissionCount.Week, submissionCount.Month],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)', // Color for Day
                                'rgba(54, 162, 235, 0.6)', // Color for Week
                                'rgba(255, 206, 86, 0.6)' // Color for Month
                            ],
                        }]
                    },
                }
            );
            new Chart(
                document.getElementById('bar'), {
                    type: 'bar',
                    data: {
                        labels: ['Day', 'Week', 'Month'], // Labels for each period
                        datasets: [{
                            label: 'Average Submissions',
                            data: submissionCount,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)', // Color for Day
                                'rgba(54, 162, 235, 0.6)', // Color for Week
                                'rgba(255, 206, 86, 0.6)' // Color for Month
                            ],
                        }]
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
@vite('resources/js/teacherGantt.js')
