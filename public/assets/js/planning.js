//FullCalendar
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        buttonText: {
          today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour',
            list: 'Liste'
        },
        customButtons: {
            save: {
                text: 'Enregistrer'
            },
            export: {
                text: 'Exporter'
            },
            addEvent: {
                text:'Planifier'
            }
        },
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridDay addEvent'
        },
        footerToolbar: {
            left: 'save export'
        },
        locale: 'fr',
        timeZone: 'Europe/Paris',
        editable: true,
        eventResizableFromStart: true,
        selectable: true,
        dropable: true,
        allDaySlot: false
    });
    calendar.render();
});
