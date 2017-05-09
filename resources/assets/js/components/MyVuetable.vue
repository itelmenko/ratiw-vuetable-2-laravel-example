// MyVuetable.vue

<template>
    <vuetable ref="vuetable"
              api-url="/people"
              :fields="fields"
    ></vuetable>
</template>

<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable'

    export default {
        components: {
            Vuetable
        },

        data() {
            return {
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
        }
    }
</script>