<template>

<Section>
    <div class="flex items-center justify-between d p-4">
        <div class="flex space-x-3 items-center">
            <ComboSelect v-model="selectedAssetType" :options="assetTypes" label="Tipo de Ativo" id="assetTypeSelect" all-option model-value="" route-name="compare"/>
        </div>
    </div>
    <Table>
        <template #head><TableHead>
            
            <TableCell tag="th" class="px-4 py-3 font-bold">Tipo</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">Ativo</TableCell>
            <TableRowSort column="weight" route-name="compare" :sort-column="sortBy" :sort-direction="sortDir">Peso</TableRowSort>
            <!-- <TableCell tag="th" class="px-4 py-3 font-bold">Peso</TableCell> -->
            <TableCell tag="th" class="px-4 py-3 font-bold">Investido</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">Desejada</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">Comprar</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">Segmento</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">% Segmento</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">% Tipo</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">% Geral</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">Dividendos</TableCell>
            <TableCell tag="th" class="px-4 py-3 font-bold">Ultimo aporte</TableCell>

            </TableHead>
        </template>

        <template #body>
            <TableRow v-for="position in positions.data" :key="position.id">
                <TableCell>{{ position.asset_type }}</TableCell>
                <TableCell>{{ position.asset_ticker }}</TableCell>
                <TableCell>{{ position.weight }}</TableCell>
                <TableCell>{{ position.value }}</TableCell>
                <TableCell>{{ position.wanted }}</TableCell>
                <TableCell>{{ position.to_buy }}</TableCell>
                <TableCell>{{ position.sector }}</TableCell>
                <TableCell>{{ position.sector_percent }}%</TableCell>
                <TableCell>{{ position.percent }}%</TableCell>
                <TableCell>{{ position.overall_share }}%</TableCell>
                <TableCell>{{ position.dividends }}</TableCell>
                <TableCell>{{ position.last_deal }}</TableCell>
            </TableRow>
        </template>
    </Table>

</Section>
   
</template>


<script>
import { router as Inertia } from '@inertiajs/vue3';

import AppLayout from '../App.vue';
import Section from '@/Components/Section.vue'
import ComboSelect from '@/Components/ComboSelect.vue'
import Table from '@/Table/Table.vue'
import TableCell from '@/Table/TableCell.vue'
import TableHead from '@/Table/TableHead.vue'
import TableRow from '@/Table/TableRow.vue'
import TableRowSort from '@/Table/TableRowSort.vue'

export default {
    layout: AppLayout,
    name: 'Compare',
    components: {
        Section,
        Table,
        TableCell,
        TableHead,
        TableRow,
        TableRowSort,
        ComboSelect
    },
    props: {
        positions: {
            type: Object,
        },
        assetTypes: {
            type: Array,
        },
        positionsBySector: {
            type: Object,
        },
        search: {
            type: String,
        },
        assetTypeIdSelected: {
            type: String,
        },
        sortBy: {
            String,
        },
        sortDir: {
            String,
        }
    },
     data() {
        return {
            selectedAssetType: this.selectedAssetType
        }
    },

    watch: {
        selectedAssetType(newValue) {
            this.searchByAssetType(newValue)
        }
    },
    methods: {
        searchByAssetType(assetType) {
            Inertia.visit(this.route('compare'), {
                method: 'post',
                data: {
                    assetTypeIdSelected: assetType
                },
                preserveScroll: true,
                preserveState: true
            })
        }
    }
    
}
</script>

