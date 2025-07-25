<template>

   <p>AssetsList</p>

</template>


<script>
import AppLayout from '../App.vue';
import Table from '@/Table/Table.vue'
import TableCell from '@/Table/TableCell.vue'
import TableHead from '@/Table/TableHead.vue'
import TableRow from '@/Table/TableRow.vue'

export default {
    layout: AppLayout,
    name: 'Dash',
    components: {
        Table,
        TableCell,
        TableHead,
        TableRow
    },
    
}
</script>

