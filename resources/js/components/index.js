
import BaseInput from './BaseInput.vue';
import BaseTextarea from './BaseTextarea.vue';
import BaseButton from './BaseButton.vue';
import BaseCard from './BaseCard.vue';
import DropdownMenu from './DropdownMenu.vue';
import DropdownItem from './DropdownItem.vue';

import {
    DotsVerticalIcon,
} from "@heroicons/vue/solid";

export default app => {
  app.component('BaseInput', BaseInput)
  app.component('BaseTextarea', BaseTextarea)
  app.component('BaseButton', BaseButton)
  app.component('BaseCard', BaseCard)
  app.component('DropdownMenu', DropdownMenu)
  app.component('DropdownItem', DropdownItem)
  app.component('DotsVerticalIcon', DotsVerticalIcon)
}
