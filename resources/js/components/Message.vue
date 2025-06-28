<script>
export default {
    name: "Message",
    props: ['message']
}
</script>

<template>

    <div class="chat__message" :class="{'chat__message--own': message.selfOwned}">
        <strong class="chat__message-user">
            {{  message.user.name }}
        </strong>
        <span class="chat__message-timestamp">{{  message.created_at }}</span>
        <p class="chat__message-body">{{ message.body }}</p>
    </div>

</template>

<style scoped lang="scss">
.chat {
    &__message {
        padding: 15px;
        border-bottom: 1px solid #eee;

        &--own {
            background-color: #a6e1ec;
        }

        &-user {
            font-weight: 800;
        }

        &-timestamp {
            color: #aaa;
            margin-right: 12px;
        }

        &-body {
            margin-bottom: 0;
            white-space: pre-wrap;
        }
    }
}
</style>
