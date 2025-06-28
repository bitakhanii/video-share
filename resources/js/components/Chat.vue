<script>
import Messages from "@/components/Messages.vue";
import Bus from '../bus.js';
import moment from 'moment';

export default {
    name: "Chat",
    components: {Messages},

    data() {
        return {
            body: null,
            bodyBackedUp: null
        }
    },

    methods: {
        handleMessageInput(e) {
            this.bodyBackedUp = this.body;
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                this.send();
            }
        },

        buildTempMessage() {
            let tempID = Date.now();
            return {
                id: tempID,
                body: this.body,
                created_at: moment().format('YYYY/MM/DD HH:mm'),
                selfOwned: true,
                user: {
                    name: user.name,
                }
            }
        },

        send() {
            if (!this.body || this.body.trim() === '') return;

            let tempMessage = this.buildTempMessage();
            Bus.emit('message.added', tempMessage);

            axios.post('/chat/messages', {
                body: this.body.trim()
            }).catch(() => {
                this.body = this.bodyBackedUp;
                Bus.emit('message.remove', tempMessage);
                console.log('failed');
            })

            this.body = '';
        }
    }
}
</script>

<template>

    <div class="chat">
        <messages></messages>
        <form action="#" class="chat__form">
            <textarea
                id="body"
                cols="30"
                rows="4"
                class="chat__form-input"
                v-model="body"
                @keydown="handleMessageInput"
            ></textarea>
            <span class="chat__form-helptext">
                برای ارسال پیام Enter و برای خط ایجاد خط جدید Shift+Enter را فشار دهید
            </span>
        </form>
    </div>

</template>

<style scoped lang="scss">
.chat {
    background-color: #fff;
    border: 1px solid #d3e0e9;
    border-radius: 3px;
    margin-bottom: 20px;

    &__form {
        border-top: 1px solid #d3e0e9;
        padding: 10px;

        &-input {
            width: 100%;
            border: 1px solid #d3e0e9;
            padding: 5px 10px;
            outline: none;
        }

        &-helptext {
            color: #aaa;
        }
    }
}
</style>
