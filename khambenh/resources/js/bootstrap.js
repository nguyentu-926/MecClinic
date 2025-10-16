import axios from 'axios';
window.axios = axios;

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Lắng nghe sự kiện
window.Echo.channel('appointments')
    .listen('.appointment.approved', (e) => {
        console.log('Appointment approved:', e.appointment);
        alert('Có lịch hẹn mới đã được duyệt!');
    });
