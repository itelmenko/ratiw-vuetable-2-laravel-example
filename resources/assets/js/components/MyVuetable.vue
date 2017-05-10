// MyVuetable.vue

<template>
    <div class="ui container">
        <vuetable ref="vuetable"
                  api-url="/people"
                  :fields="fields"
                  :css="css"
                  pagination-path=""
                  :sort-order="sortOrder"
                  @vuetable:pagination-data="onPaginationData"
        ></vuetable>
        <vuetable-pagination-info ref="paginationInfo"
        ></vuetable-pagination-info>
        <vuetable-pagination ref="pagination"
            :css="paginationCss"
            @vuetable-pagination:change-page="onChangePage"
        ></vuetable-pagination>
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
                        title: 'Monthly Salary',
                        titleClass: 'text-center',
                        dataClass: 'text-right',
                        callback: 'formatNumber',
                        sortField: 'salary'
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
            }
        }
    }
</script>