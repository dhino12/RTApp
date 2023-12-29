if (document.querySelector('[data-toggle="widget-calendar"]')) {
    console.log(Date.now());
    var calendarEl = document.querySelector('[data-toggle="widget-calendar"]');
    var today = new Date();
    var mYear = today.getFullYear();
    var weekday = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var mDay = weekday[today.getDay()];
    var m = today.getMonth();
    var d = today.getDate();
    document.getElementsByClassName("widget-calendar-year")[0].innerHTML = mYear;
    document.getElementsByClassName("widget-calendar-day")[0].innerHTML = mDay;
    var calendar = new FullCalendar.Calendar(calendarEl,{
        timeZone: 'UTC',
        contentHeight: "auto",
        initialView: "dayGridMonth",
        selectable: true,
        initialDate: Date.now(),
        editable: true,
        headerToolbar: false,
        weekday: 'short',
        events: [{
            title: "Call with Dave",
            start: "2023-11-18",
            end: "2023-11-18",
            className: "bg-gradient-to-tl from-red-600 to-rose-400",
        }, {
            title: "Lunch meeting",
            start: "2023-11-21",
            end: "2023-11-22",
            className: "bg-gradient-to-tl from-red-500 to-yellow-400",
        }, {
            title: "All day conference",
            start: "2023-11-29",
            end: "2023-11-29",
            className: "bg-gradient-to-tl from-green-600 to-lime-400",
        }, {
            title: "Meeting with Mary",
            start: "2023-12-01",
            end: "2023-12-01",
            className: "bg-gradient-to-tl from-blue-600 to-cyan-400",
        }, {
            title: "Winter Hackaton",
            start: "2023-12-03",
            end: "2023-12-03",
            className: "bg-gradient-to-tl from-red-600 to-rose-400",
        }, {
            title: "Digital event",
            start: "2023-12-07",
            end: "2023-12-09",
            className: "bg-gradient-to-tl from-red-500 to-yellow-400",
        }, {
            title: "Marketing event",
            start: "2023-12-10",
            end: "2023-12-10",
            className: "bg-gradient-to-tl from-purple-700 to-pink-500",
        }, {
            title: "Dinner with Family",
            start: "2023-12-19",
            end: "2023-12-19",
            className: "bg-gradient-to-tl from-red-600 to-rose-400",
        }, {
            title: "Black Friday",
            start: "2023-12-23",
            end: "2023-12-23",
            className: "bg-gradient-to-tl from-blue-600 to-cyan-400",
        }, {
            title: "Cyber Week",
            start: "2023-12-02",
            end: "2023-12-02",
            className: "bg-gradient-to-tl from-red-500 to-yellow-400",
        }],
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next',
        },
        right: 'dayGridMonth,timeGridWeek,timeGridDay',
        editable: true,
        dayMaxEvents: true, // when too many events in a day, show the popover
        eventDidMount: function (info) {
            // Initialize Tippy.js tooltip for each event
            tippy(info.el, {
              content: info.event.title,
              arrow: true,
              placement: 'bottom',
            });
        },
    });
    calendar.render(); 
}
console.log(document.querySelector('[data-toggle="calendar"]'));
if (document.querySelector('[data-toggle="calendar"]')) {
    console.log('jalan calendar');
    var calendar = new FullCalendar.Calendar(document.getElementById("calendar"),{
        contentHeight: 'auto',
        initialView: "dayGridMonth",
        headerToolbar: {
            start: 'title',
            center: '',
            end: 'today prev,next'
        },
        selectable: true,
        editable: true,
        initialDate: '2020-12-01',
        events: [{
            title: 'Call with Dave',
            start: '2020-11-18',
            end: '2020-11-18',
            className: 'bg-gradient-to-tl from-red-600 to-rose-400'
        }, {
            title: 'Lunch meeting',
            start: '2020-11-21',
            end: '2020-11-22',
            className: 'bg-gradient-to-tl from-red-500 to-yellow-400'
        }, {
            title: 'All day conference',
            start: '2020-11-29',
            end: '2020-11-29',
            className: 'bg-gradient-to-tl from-green-600 to-lime-400'
        }, {
            title: 'Meeting with Mary',
            start: '2020-12-01',
            end: '2020-12-01',
            className: 'bg-gradient-to-tl from-blue-600 to-cyan-400'
        }, {
            title: 'Winter Hackaton',
            start: '2020-12-03',
            end: '2020-12-03',
            className: 'bg-gradient-to-tl from-red-600 to-rose-400'
        }, {
            title: 'Digital event',
            start: '2020-12-07',
            end: '2020-12-09',
            className: 'bg-gradient-to-tl from-red-500 to-yellow-400'
        }, {
            title: 'Marketing event',
            start: '2020-12-10',
            end: '2020-12-10',
            className: 'bg-gradient-to-tl from-purple-700 to-pink-500'
        }, {
            title: 'Dinner with Family',
            start: '2020-12-19',
            end: '2020-12-19',
            className: 'bg-gradient-to-tl from-red-600 to-rose-400'
        }, {
            title: 'Black Friday',
            start: '2020-12-23',
            end: '2020-12-23',
            className: 'bg-gradient-to-tl from-blue-600 to-cyan-400'
        }, {
            title: 'Cyber Week',
            start: '2020-12-02',
            end: '2020-12-02',
            className: 'bg-gradient-to-tl from-red-500 to-yellow-400'
        }, ],
        views: {
            month: {
                titleFormat: {
                    month: "long",
                    year: "numeric"
                }
            },
            agendaWeek: {
                titleFormat: {
                    month: "long",
                    year: "numeric",
                    day: "numeric"
                }
            },
            agendaDay: {
                titleFormat: {
                    month: "short",
                    year: "numeric",
                    day: "numeric"
                }
            }
        },
    });
    calendar.render();
}
