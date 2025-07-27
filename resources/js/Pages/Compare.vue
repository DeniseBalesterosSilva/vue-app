<template>

<Section>
    <h3>Compare</h3>

</Section>
   
</template>


<script>
import { router as Inertia } from '@inertiajs/vue3';

import AppLayout from '../App.vue';
import Section from '@/Components/MySection.vue'

export default {
    layout: AppLayout,
    name: 'Compare',
    components: {
        Section,
    },
    props: {
        
    },
}
</script>

