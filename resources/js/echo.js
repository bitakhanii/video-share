import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import Bus from './bus.js'

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER, // یا چیزی که در پنل Pusher هست
    forceTLS: true
});

window.Echo.join(('chat'))
    .here((users) => {
        Bus.emit('users.here', users);
    })
    .joining((user) => {
        Bus.emit('user.joined', user);
    })
    .leaving((user) => {
        Bus.emit('user.left', user);
    })
    .listen('App\\Events\\MessageCreated', (e) => {
       Bus.emit('message.added', e.message);
    })

