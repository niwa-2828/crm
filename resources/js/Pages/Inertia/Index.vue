<script setup>
import { Link } from '@inertiajs/inertia-vue3'; 

defineProps({
    blogs:Array
})
</script>

<template>
    <div v-if="$page.props.flash.message" class="bg-blue-300">
    {{ $page.props.flash.message }}
    </div>
    <ul v-for="blog in blogs" :key="blog.id">
    <li> 件名：  <Link class="text-blue-400" v-bind:href="route('inertia.show',{id:blog.id})">{{ blog.title }}</Link></li>
    <li>本文 {{ blog.content }}</li>
    </ul>

    <a href="/">a</a><br>
    <Link href="/">rink</Link><br>
    <Link v-bind:href="route('inertia.index')">名前付きルートの確認</Link><br>
    <Link v-bind:href="route('inertia.show',{id:1})">ルートパラメーター</Link>
</template>