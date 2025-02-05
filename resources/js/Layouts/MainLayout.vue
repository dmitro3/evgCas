<script setup>
import Aside from '../Components/Main/Aside.vue';
import Header from '../Components/Main/Header.vue';
</script>

<template>
    <main class="flex">
        <Aside />
        <div class="flex-col flex-1">
            <Header />
            <div class="py-14">
                <slot />
            </div>

        </div>
    </main>
</template>


<style scoped></style>