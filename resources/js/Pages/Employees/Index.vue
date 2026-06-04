<script setup>
import MailSendLayout from "@/Layouts/MailSendLayout.vue";

const employees = [
    {
        id: 1,
        name: "山田太郎",
        company_name: "株式会社サンプル",
    },
];
</script>

<template>
    <MailSendLayout>
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-bold">社員一覧</h1>

            <div class="flex gap-1">
                <button class="rounded bg-blue-600 px-4 py-2 text-white">
                    社員登録
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
                        <th class="p-4 text-left">社員名</th>

                        <th class="p-4 text-left">所属会社</th>

                        <th class="p-4 text-center">操作</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="employee in employees"
                        :key="employee.id"
                        class="border-t"
                    >
                        <td class="p-4">
                            {{ employee.name }}
                        </td>

                        <td class="p-4">
                            {{ employee.company_name }}
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
