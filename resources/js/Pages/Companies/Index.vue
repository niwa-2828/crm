<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";

const companies = [
    {
        id: 1,
        name: "株式会社サンプル",
    },
];

defineProps({
    companies : Array,
})
</script>

<template>
    <MailSendLayout>
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold">会社一覧</h1>

            <div class="flex gap-1">
            <button class="rounded bg-blue-600 px-4 py-2 text-white">
                会社登録
            </button>
            <button class="rounded bg-pink-300 ml-1 px-4 py-2 text-white">
                戻る
            </button>
            </div>
        </div>

        <div class="overflow-hidden rounded-lg bg-white shadow">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">会社名</th>

                        <th class="p-4 text-center">操作</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="company in companies"
                        :key="company.id"
                        class="border-t"
                    >
                        <td class="p-4">
                            {{ company.name }}
                        </td>

                        <td class="p-4 text-center">
                            <button
                                class="mr-2 rounded bg-yellow-500 px-3 py-1 text-white"
                            >
                                修正
                            </button>

                            <button
                                class="rounded bg-red-600 px-3 py-1 text-white"
                            >
                                削除
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </MailSendLayout>
</template>
