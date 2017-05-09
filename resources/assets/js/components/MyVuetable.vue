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
                        title: 'Full Name'
                    },
                    'email',
                    'birthday',
                    {
                        name: 'address',
                        title: 'Home Address'
                    },
                    {
                        name: 'salary',
                        title: 'Monthly Salary'
                    }
                ]
            }
        }
    }
</script>