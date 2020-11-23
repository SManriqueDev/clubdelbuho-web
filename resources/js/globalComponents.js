import Vue from 'vue';
import FeatherIcon from './Shared/FeatherIcon';
import TModal from "./Shared/TModal.vue"
import SelectInput from '@/Shared/SelectInput'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'


Vue.component(TModal.name, TModal)
Vue.component(TextareaInput.name, TextareaInput)
Vue.component(SelectInput.name, SelectInput)
Vue.component(TextInput.name, TextInput)
Vue.component(FeatherIcon.name, FeatherIcon);


