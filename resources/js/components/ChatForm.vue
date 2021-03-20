<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" 
            class="appearance-none rounded-md relative block px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
         placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage"
         >
            <button class="mt-4 group relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600" id="btn-chat" @click="sendMessage">
                Send
            </button>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>