<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <Link
                    v-if="link.url === null"
                    disable
                >
                    <q-btn class="q-mt-md" color="primary" v-html="link.label" />
                </Link>
                <Link v-else
                    :href="link.url"
                >
                    <q-btn class="q-mt-md" color="primary" v-html="link.label" />
                </Link>
            </template>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        links: Array
    },

    components:
    {
        Link
    },
}
</script>
