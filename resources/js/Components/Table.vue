<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
                class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
            >
                <div class="overflow-hidden border-b border-gray-200 shadow">
                    <table
                        class="min-w-full bg-white divide-y divide-gray-200"
                        style="height: 1px"
                    >
                        <thead
                            class="text-left bg-medGray text-darkGray font-bungee"
                        >
                            <tr class="text-xs sm:text-base whitespace-nowrap">
                                <slot name="table-head" />
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <slot name="table-body" />
                        </tbody>
                    </table>
                    <slot name="overlay" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {};
</script>
