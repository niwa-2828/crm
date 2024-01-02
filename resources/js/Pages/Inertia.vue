<script setup>
import { Link } from '@inertiajs/inertia-vue3'; 
import { ref } from 'vue'; 
const newTitle=ref('')
const newContent=ref('')
</script>

<template>
    <a href="/">a</a><br>
    <Link href="/">rink</Link><br>
    <Link v-bind:href="route('inertia.index')">名前付きルートの確認</Link><br>
    <Link v-bind:href="route('inertia.show',{id:1})">ルートパラメーター</Link>
    <div class="mb-8"></div>
    
    <input type="text" name="newTitle" v-model="newTitle">{{ newTitle }}
    <input type="text" name="newContent" v-model="newContent">{{ newContent }}<br>
    <Link as="button" method="post" :href="route('inertia.store')" :data="{
        title:newTitle,
        content:newContent
    }">DB保存テスト</Link>
</template>
