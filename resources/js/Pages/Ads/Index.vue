<template>
    <list-ads :ads="ads" :favourites="favourites" />
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import ListAds from '@/Components/ListAds.vue';

export default {
    layout : AppLayout,
    name: 'Index ad',
    props: {
        ads: Object,
        favourites: Object,
    },
    components: {
        Link,
        ListAds,
    },
}
</script>
