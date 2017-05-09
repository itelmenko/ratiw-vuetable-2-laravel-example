// MyVuetable.vue

<template>
    <div class="ui container">
        <vuetable ref="vuetable"
                  api-url="/people"
                  :fields="fields"
                  pagination-path=""
                  @vuetable:pagination-data="onPaginationData"
        ></vuetable>
        <vuetable-pagination ref="pagination"
            :css="cssPagination"
            @vuetable-pagination:change-page="onChangePage"
        ></vuetable-pagination>
    </div>
</template>

<script>

    import accounting from 'accounting'
    import moment from 'moment'
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'

    export default {
        components: {
            Vuetable,
            VuetablePagination
        },

        data() {
            return {

                cssPagination: {
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
                        dataClass: 'text-left'
                    },
                    {
                        name: 'email',
                        title: 'Email',
                        titleClass: 'text-center',
                        dataClass: 'text-left'
                    },
                    {
                        name: 'birthday',
                        title: 'Birthday',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
                    },
                    {
                        name: 'address',
                        title: 'Home Address',
                        titleClass: 'text-center',
                        dataClass: 'text-left'
                    },
                    {
                        name: 'salary',
                        title: 'Monthly Salary',
                        titleClass: 'text-center',
                        dataClass: 'text-right'
                    }
                ]
            }
        },

        methods: {
            //...
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            }
        }
    }
</script>