<template>
    <div v-if="paginate.links.length > 3" class="row">
        <Link :href="paginate.links.first_page_url + '&' + params" :disable="paginate.prev_page_url === null">
            <q-btn class="q-mt-md" color="primary" icon="first_page" flat :disable="paginate.prev_page_url === null"/>
        </Link>

        <Link :href="paginate.prev_page_url + '&' + params" :disable="paginate.prev_page_url === null">
            <q-btn class="q-mt-md" color="primary" icon="chevron_left" flat :disable="paginate.prev_page_url === null" />
        </Link>

        <q-btn class="q-mt-md" color="primary" flat :label="paginate.current_page + ' / ' + paginate.last_page ">
        </q-btn>

        <Link :href="paginate.next_page_url + '&' + params" :disable="paginate.next_page_url === null">
            <q-btn class="q-mt-md" color="primary" icon="chevron_right" flat :disable="paginate.next_page_url === null"/>
        </Link>

        <Link :href="paginate.links.last_page_url + '&' + params" :disable="paginate.next_page_url === null" >
            <q-btn class="q-mt-md" color="primary" icon="last_page" flat :disable="paginate.next_page_url === null" />
        </Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        paginate: Array,
        params: String
    },

    components:
    {
        Link
    },
}
</script>
