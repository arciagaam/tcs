import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
let events = [];

const BASE_PATH = document.querySelector('meta[name="BASE_PATH"]').content;
const calendarEl = document.querySelector('#calendarEl');

let calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
    },
    buttonText: {
        today: 'Today',
        month: 'Month',
        week: 'Week',
        list: 'List',
    },
    showNonCurrentDates: false,
    fixedWeekCount: false,

    //get events
    datesSet: event => {
        // As the calendar starts from prev month and end in next month I take the day between the range
        var midDate = new Date((event.start.getTime() + event.end.getTime()) / 2)
        var month = midDate.getMonth() + 1
        getMonthEvents(month, midDate.getFullYear())
    },

    //event click
    eventClick: function (info) {
        // const id = info.event.extendedProps.id
        // location.href = BASE_PATH + '/appointments/' + id
    },

});

calendar.render();

async function getMonthEvents(month, year) {
    events = [];
    const stringMonth = leadingZeroes(month)

    try{
        const fetchData = await fetch(BASE_PATH + `/appointments/get?month=${stringMonth}&year=${year}`,{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        })
        
        const data = await fetchData.json();

        data.map((appointment) => {
            events.push(
                { extendedProps: { id: appointment.id }, title: appointment.group_code, start: appointment.start_date, end: appointment.end_date }
            )
        })

        calendar.removeAllEvents();

        events.forEach(event => {
            calendar.addEvent(event)
        });

    } catch (error) {
        console.error(error);
    }

}

function leadingZeroes(numString) {
    if (isNaN(numString)) {
        return '00'
    }

    if (numString < 10) {
        return `0${numString}`
    } else {
        return numString
    }
}