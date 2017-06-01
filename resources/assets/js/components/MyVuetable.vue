// MyVuetable.vue

<template>
    <div class="ui container">
        <vuetable ref="vuetable"
                  api-url="/people"
                  pagination-path=""
                  :fields="fields"
                  :css="css"
                  :sort-order="sortOrder"
                  :per-page="10"
                  @vuetable:pagination-data="onPaginationData"
        >
            // Scoped slots https://vuejs.org/v2/guide/components.html#Scoped-Slots
            <template slot="actions" scope="props">
                <div class="custom-actions">
                    <button class="btn btn-default btn-sm"
                            @click="onAction('view-item', props.rowData, props.rowIndex)">
                        <span class="glyphicon glyphicon-zoom-in"></span>
                    </button>
                    <button class="btn btn-default btn-sm"
                            @click="onAction('edit-item', props.rowData, props.rowIndex)">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>
                    <button class="btn btn-default btn-sm"
                            @click="onAction('delete-item', props.rowData, props.rowIndex)">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </div>
            </template>

        </vuetable>

        <div class="vuetable-footer">
            <button class="btn btn-info footer-button" @click="onGroupAction()">Group action</button>

            <vuetable-pagination-info ref="paginationInfo"
            ></vuetable-pagination-info>

            <vuetable-pagination ref="pagination"
                :css="paginationCss"
                @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>
        </div>

    </div>
</template>

<script>

    import accounting from 'accounting' // for salary field formatting
    import moment from 'moment' // for birthday field
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import BootstrapStyle from './bootstrap-css.js'

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo
        },

        data() {
            return {

                css: BootstrapStyle,

                paginationCss: {
                    wrapperClass: 'pagination',
                    activeClass: 'btn-primary',
                    disabledClass: 'disabled',
                    pageClass: 'btn btn-border',
                    linkClass: 'btn btn-border',
                    icons: {
                        first: '',
                        prev: '',
                        next: '',
                        last: '',
                    }
                },

                fields: [
                    {
                        name: '__sequence',
                        title: '#',
                        titleClass: 'text-center',
                        dataClass: 'text-right'
                    },
                    {
                        name: '__checkbox',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
                    },
                    {
                        name: 'name',
                        title: 'Full Name',
                        titleClass: 'text-center',
                        dataClass: 'text-left',
                        sortField: 'name'
                    },
                    {
                        name: 'email',
                        title: 'Email',
                        titleClass: 'text-center',
                        dataClass: 'text-left',
                        sortField: 'email'
                    },
                    {
                        name: 'birthday',
                        title: 'Birthday',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        callback: 'formatDate|DD-MM-YYYY',
                        sortField: 'birthday'
                    },
                    {
                        name: 'address',
                        title: 'Home Address',
                        titleClass: 'text-center',
                        dataClass: 'text-left',
                        sortField: 'address'
                    },
                    {
                        name: 'gender',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        callback: 'genderLabel',
                        sortField: 'gender'
                    },
                    {
                        name: 'salary',
                        title: 'Salary',
                        titleClass: 'text-center',
                        dataClass: 'text-right',
                        callback: 'formatNumber',
                        sortField: 'salary'
                    },
                    {
                        name: '__slot:actions',
                        title: 'Actions',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
                    }
                ],

                sortOrder: [
                    {
                        field: 'name',
                        sortField: 'name',
                        direction: 'asc'
                    }
                ]
            }
        },

        methods: {
            //...
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
                this.$refs.paginationInfo.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },

            // Column formatting
            genderLabel (value) {
                return value === 'male'
                    ? '<span class="label label-warning"><span class="glyphicon glyphicon-star"></span> Male</span>'
                    : '<span class="label label-info"><span class="glyphicon glyphicon-heart"></span> Female</span>'
            },

            formatNumber (value) {
                return accounting.formatNumber(value, 2)
            },

            formatDate (value, fmt = 'D MMM YYYY') {
                return (value == null)
                    ? ''
                    : moment(value, 'YYYY-MM-DD').format(fmt)
            },

            // Row button action handler
            onAction (action, data, index) {
                console.log('slot) action: ' + action, data.name, index)
            },

            // Footer button action
            onGroupAction() {
                console.log('Group action. Selected rows: ', this.$refs.vuetable.selectedTo.join(', '));
            }
        }
    }
</script>

<style>

    /**
     * Disabling multi-line text
     */
    .vuetable-body > tr > td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /*
     * Column width
     */
    table.vuetable {
        width: 1140px;
        table-layout: fixed;
    }

    .vuetable-th-sequence {
        width: 35px;
    }

    .vuetable-th-checkbox-id {
        width: 25px;
    }

    .vuetable th#_name {
        width: 120px;
    }

    .vuetable th#_email {
        width: 120px;
    }

    .vuetable th#_birthday {
        width: 80px;
    }

    .vuetable th#_address {
        width: 200px;
    }

    .vuetable th#_gender {
        width: 80px;
    }

    .vuetable th#_salary {
        width: 130px;
    }

    .vuetable .vuetable-th-slot-actions {
        width: 120px;
    }


    /**
     * Footer
     */
    .vuetable-footer {
        height: 40px;
        margin: 0 0 20px 0;
    }
    .vuetable-pagination-info, .footer-button {
        float: left;
    }
    .vuetable-pagination-info {
        padding: 12px 25px;
        line-height: 14px;
    }
    .pagination {
        float: right;
        margin: 0;
    }
    .vuetable-footer:after{
        clear: both;
    }
</style>