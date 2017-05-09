// MyVuetable.vue

<template>
    <vuetable ref="vuetable"
              api-url="/people"
              :fields="['name', 'email', 'birthday', 'address', 'salary']"
    ></vuetable>
</template>

<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable'

    export default {
        components: {
            Vuetable
        }
    }
</script>