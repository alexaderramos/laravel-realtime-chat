require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'

//for auto scroll
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll);

//for notifications
import Toaster from 'v-toaster'
Vue.use(Toaster, {timeout: 5000});
    // You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'

Vue.component('message-component', require('./components/MessageComponent').default);

const app = new Vue({
    el: '#app',
    data: {
        message:'',
        chat:{
            message:[],
            user:[],
            color:[],
            time:[]

        },
        typing:'',
        numberOfUsers: 0
    },
    methods: {
        send(){
            if (this.message.length !=0){
                this.chat.message.push(this.message);
                this.chat.user.push('you');
                this.chat.color.push('success');
                this.chat.time.push(this.getTime());

                axios.post('/send', {
                    message: this.message
                })
                    .then(response => {
                        //console.log(response);
                        this.message = '';
                    })
                    .catch(error => {
                        console.log('Error: '+error);
                    });
            }
        },
        getTime(){
            let time = new Date();
            return time.getHours()+":"+time.getMinutes();
        }
    },
    watch:{
        message(){
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message
                });
        }
    },
    mounted(){
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                this.chat.user.push(e.user);
                this.chat.color.push('warning');
                this.chat.time.push(this.getTime());
            })
            .listenForWhisper('typing', (e) => {
                if (e.name != ''){
                    this.typing = 'typing...'
                }else{
                    this.typing = ''
                }
            });
        Echo.join(`chat`)
            .here((users) => {
                this.numberOfUsers = users.length;
            })
            .joining((user) => {
                this.numberOfUsers += 1;
                this.$toaster.success(user.name+' is joined the chat room');

            })
            .leaving((user) => {
                this.numberOfUsers -= 1;
                this.$toaster.warning(user.name+' is leaved the chat room');
            });
    }
});
