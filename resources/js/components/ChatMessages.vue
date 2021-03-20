
<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages" :key="message">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>
                <div class="chat-message m-3">
                    <div class="flex items-end">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                        <div><span class="px-4 py-2 rounded-lg inline-block bg-gray-300 text-gray-600">{{message.message}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['messages']
  };
</script>