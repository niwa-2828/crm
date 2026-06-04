<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import FlashMessage from '@/Components/FlashMessage.vue'

const name = ref('');
const mail = ref('');

const submit = () => {
    if (!name.value) {
        alert('会社名を入力してください')
        return;
    }

    router.post(route('companies.store'), {
        name: name.value,
        mail: mail.value,
    }, {
        onSuccess: () => {
            name.value = '';
            mail.value = '';
        },
    });
};
</script>

<template>
    <FlashMessage />

    <form @submit.prevent="submit">
        <div>
            <label>会社名</label>
            <input v-model="name" type="text" />
        </div>
        <div>
            <label>メール</label>
            <input v-model="mail" type="email" />
        </div>
        <button type="submit">登録</button>
    </form>
</template>
FlashMessage />

</template>