import Vue from 'vue';
import FeatherIcon from './shared/FeatherIcon';
import TModal from "./shared/TModal.vue"
import SelectInput from '@/shared/SelectInput'
import TextInput from '@/shared/TextInput'
import Icon from '@/shared/Icon'
import TextareaInput from '@/shared/TextareaInput'

Vue.component(Icon.name,Icon)
Vue.component(TModal.name, TModal)
Vue.component(TextareaInput.name, TextareaInput)
Vue.component(SelectInput.name, SelectInput)
Vue.component(TextInput.name, TextInput)
Vue.component(FeatherIcon.name, FeatherIcon);


