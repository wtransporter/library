import {createApp} from 'vue'
import './bootstrap'
import Test from './components/TheTest.vue'

let app = createApp()

app.component('test', Test).default

app.mount("#app-v")