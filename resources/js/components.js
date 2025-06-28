import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import Chat from './components/Chat.vue';
import Messages from './components/Messages.vue';
import Message from './components/Message.vue';
import Users from './components/Users.vue';
// ...کامپوننت‌های بیشتر

export function components(app) {
    app.component('example-component', ExampleComponent);
    app.component('chat', Chat);
    app.component('messages', Messages);
    app.component('message', Message);
    app.component('users', Users);
    // ...
}
