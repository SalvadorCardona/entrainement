<script setup lang="ts">
import getMessages, {type MessageRead} from "~/module/chat-box/api/getMessages";
import createMessage from "~/module/chat-box/api/createMessage";
import {subscribeMessage} from "~/module/chat-box/api/subscribeMessage";
import {createUniqId} from "~/module/shared/createUniqId";

const hidden = ref<boolean>(false)
const scrollContainer = ref<HTMLElement | null>(null)
const messages = ref<MessageRead[]>([])
const currentMessage = ref<string>('')

const onGetMessage = () => {
  getMessages()
    .then((response) => {
      messages.value = response.data['hydra:member']
      scrollToBottom()
    })
}

const scrollToBottom = () => {
  if (scrollContainer.value) {
    scrollContainer.value.scrollTop = scrollContainer.value.scrollHeight
  }
}

const onCreateMessage = () => {
  const newMessage = {content: currentMessage.value}

  currentMessage.value = ''
  createMessage(newMessage)

  messages.value.push({
    id: createUniqId(),
    content: newMessage.content,
    role: 'Guest',
  });

  scrollToBottom()
}

onKeyStroke('Enter', onCreateMessage)

if (process.client) {
  const eventSource = subscribeMessage();

 eventSource.onmessage = event => {
   const data = JSON.parse(event.data) as MessageRead;
   messages.value.push(data);
   scrollToBottom()
 };
}

onGetMessage()

</script>

<template>
  <div class="fixed bottom-0 right-0 mb-4 mr-4" v-if="hidden">
    <button @click="hidden = false" id="open-chat" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300 flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      Chat with Admin Bot
    </button>
  </div>
  <div id="chat-container" class="fixed bottom-16 right-4 w-96" v-if="!hidden">
    <div class="bg-white shadow-md rounded-lg max-w-lg w-full">
      <div class="p-4 border-b bg-blue-500 text-white rounded-t-lg flex justify-between items-center">
        <p class="text-lg font-semibold">Admin Bot</p>
        <button @click="hidden = true" id="close-chat" class="text-gray-300 hover:text-gray-400 focus:outline-none focus:text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <div id="chatbox" ref="scrollContainer" class="p-4 h-80 overflow-y-auto">
        <!-- Chat messages will be displayed here -->
        <div
            :class="message.role === 'Guest' ? 'user' : 'admin'"
             v-for="message in messages"
             :key="message.id">
          <p >{{message.content}}</p>
        </div>
      </div>
      <div class="p-4 border-t flex">
        <input v-model="currentMessage" id="user-input" type="text" placeholder="Type a message" class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button @click="onCreateMessage" id="send-button" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">Send</button>
      </div>
    </div>
  </div>
</template>

<style scoped lang="postcss">
.admin {
  @apply mb-2
}
.admin > p {
  @apply bg-blue-500 text-white rounded-lg py-2 px-4 inline-block
}
.user {
  @apply mb-2 text-right
}
.user > p {
  @apply bg-gray-200 text-gray-700 rounded-lg py-2 px-4 inline-block
}
</style>
