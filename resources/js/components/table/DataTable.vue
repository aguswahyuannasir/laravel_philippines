<template>
    <v-client-table :columns="columns" :data="data" :options="options" :theme="theme" id="dataTable">
        <a slot="Aksi" slot-scope="props" target="_blank" :href="props.row.NmPenghasilan" class="icon-eye"></a>
    </v-client-table>
</template>

<script>
    import Vue from 'vue'
    import {ClientTable, Event} from 'vue-tables-2'

    Vue.use(ClientTable);

    export default {
        name: 'DataTable',
        props: ['tableItem'],
        components: {
            ClientTable,
            Event
        },
        data: function () {
            return {
                columns: ['NmPenghasilan', 'AmtPenghasilan', 'FlagAktif', 'Aksi'],
                data: this.tableItem,
                options: {
                    headings: {
                        NmPenghasilan: 'Nama',
                        AmtPenghasilan: 'Amount',
                        FlagAktif: 'Aktif'
                    },
                    sortable: ['NmPenghasilan', 'AmtPenghasilan'],
                    sortIcon: { base:'fa', up:'fa-sort-asc', down:'fa-sort-desc', is:'fa-sort' },
                    pagination: {
                        chunk: 5,
                        edge: false,
                        nav: 'scroll'
                    }
                },
                filterable: false,
                useVuex: false,
                theme: 'bootstrap4',
                template: 'default'
            }
        },
        watch: {
            tableItem: function(data) {
                this.data = data
            }
        }
    };
</script>

<style lang="scss">

</style>
