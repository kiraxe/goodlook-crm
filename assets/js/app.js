require('../../web/public/css/main.scss');
var $ = require('jquery/dist/jquery.min');
require("../../web/public/libs/jquery-ui-1.12.1.custom/jquery-ui.js");
require("../../web/public/libs/jquery.maskedinput-master/dist/jquery.maskedinput.min");
require('bootstrap/dist/js/bootstrap.min');
require('popper.js/dist/popper.min');
require('../../web/public/js/main.js');
require('../../web/public/js/ordersForm.js');

import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin ],
        selectable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        dateClick: function (info) {
            alert('clicked ' + info.dateStr);
        },
        select: function (info) {
            alert('selected ' + info.startStr + ' to ' + info.endStr);
        }
    });
});