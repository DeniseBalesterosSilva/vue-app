<template>

<Section>

    <Table>
        <template #head><TableHead>
            <TableRowSort column="date" route-name="consolidated" :sort-column="sortBy" :sort-direction="sortDir">Data</TableRowSort>

            <TableCell tag="th" class="px-4 py-3 font-bold">Total</TableCell>
            <TableCell v-for="type in types" :key="type" tag="th" class="px-4 py-3">{{ type }}</TableCell>
            </TableHead>
        </template>

        <template #body>
            <TableRow v-for="consolidated in consolidateds.data" :key="consolidated.id">
                <TableCell class="font-bold">{{ consolidated.date }}</TableCell>
                <TableCell class="font-bold">{{ moneyFormat(consolidated.doc.Total) }}</TableCell>
                <TableCell v-for="type in types" :key="type" class="text-xs">{{ moneyFormat(consolidated.doc[type]) }}</TableCell>
            </TableRow>
        </template>
    </Table>
    
    <div class="flex flex-wrap justify-center gap-2 mt-4 mb-4">
        <pagination :data="consolidateds" />
    </div>

</Section>

</template>


<script>
import AppLayout from '../App.vue';
import Section from '@/Components/Section.vue'
import Pagination from '@/Components/Pagination.vue'
import Table from '@/Table/Table.vue'
import TableCell from '@/Table/TableCell.vue'
import TableHead from '@/Table/TableHead.vue'
import TableRow from '@/Table/TableRow.vue'
import TableRowSort from '@/Table/TableRowSort.vue'

export default {
    layout: AppLayout,
    name: 'Consolidated',
    components: {
        Section,
        Pagination,
        Table,
        TableCell,
        TableHead,
        TableRow,
        TableRowSort,
    },
    props: {
        consolidateds: {
            type: Object,
        },
        types: {
            type: Array,
        },
        sortBy: {
            String,
        },
        sortDir: {
            String,
        }
    },
}
</script>

