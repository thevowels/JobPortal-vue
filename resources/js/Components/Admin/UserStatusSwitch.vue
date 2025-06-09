<script setup >
const props = defineProps(['user'])
import {Button} from "@/components/ui/button/index.js";
import { useForm} from "@inertiajs/vue3";

const form = useForm({
    'user_id' : props.user.id,
    'status' : props.user.status === 'active' ? 'inactive': 'active',
})

</script>

<template>
    <Button variant="outline" class="w-full" @click="() => form.post(route('setUserStatus'), {preserveScroll: true})">
        Set {{ user.status === 'active' ? 'inactive': 'active'}}
    </Button>

</template>
