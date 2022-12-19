<template>
    <div v-if="links.length > 3">
        <div v-for="link in links">
            <Link
                v-if="link.url === null"
                disable
            >
                <q-btn class="q-mt-md" color="primary" v-html="link.label" />
            </Link>
            <Link v-else
                :href="link.url + '&' + params"
            >
                <q-btn class="q-mt-md" color="primary" v-html="link.label" />
            </Link>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        links: Array,
        params: String
    },

    components:
    {
        Link
    },

    created() {
        console.log(this.links);
        console.log(this.params);
        // console.log(this.$route.query);
    }
}
</script>
