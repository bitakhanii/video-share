<script>
import Bus from '../bus.js'

export default {
    name: "Users",

    data() {
        return {
            users: []
        }
    },

    mounted() {
        Bus.on('users.here', (users) => {
            this.users = users;
        });
        Bus.on('user.joined', (user) => {
            this.users.unshift(user);
        });
        Bus.on('user.left', (user) => {
            this.users = this.users.filter((u) => {
               return user.id !== u.id;
            });
        })
    }
}
</script>

<template>

    <div class="users">
        <div class="users__header">{{  users.length }}کاربر آنلاین</div>
        <div class="users__user" v-for="user in users">
            <a href="#">{{ user.name }}</a>
        </div>
    </div>

</template>

<style scoped lang="scss">
.users {

    background-color: #fff;
    border: 1px solid #d3e0e9;
    border-radius: 3px;

    &__header {
        padding: 15px;
        font-weight: 800;
        margin: 0;
    }

    &__user {
        padding: 0 15px;

        &:last-child {
            padding-bottom: 15px;
        }
    }
}
</style>
