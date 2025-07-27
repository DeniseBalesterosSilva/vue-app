<template>

<Section>
    <form @submit.prevent="submit" class="mx-auto p-4">
         <div class="flex items-end gap-2 mb-5">
             <BaseInput label="Task" id="taskName" type="text" placeholder="Type the task..." v-model="taskName"/>

             <ComboSelect label="Priority" id="priority" :options=priorities v-model="priority"></ComboSelect>

             <Button label="Add Task" />
         </div>
            
    </form>

</Section>
   
</template>


<script>
import { router as Inertia } from '@inertiajs/vue3';

import AppLayout from '../App.vue';
import Section from '@/Components/MySection.vue'
import BaseInput from '@/Form/BaseInput.vue'
import Button from '@/Form/Button.vue';
import ComboSelect from '@/Form/ComboSelect.vue';

export default {
    layout: AppLayout,
    name: 'Compare',
    components: {
        Section,
        BaseInput,
        Button,
        ComboSelect
    },
    props: {
        priorities: Array,
    },

    data() {
        return {
            taskName: "",
            priority: null,
        };
    },

    methods: {
    async submit() {
      try {
        console.log("Enviando dados...");
        console.log("Nome da tarefa:", this.priority);
          Inertia.visit(this.route('compare'), {
                method: 'post',
                data: {
                    name: this.taskName,
                    priority: this.priority
                },
                preserveScroll: true,
                preserveState: true
            })
      } catch (error) {
        console.error("Erro ao enviar:", error);
      }
    }
  }
}
</script>

