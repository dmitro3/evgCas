<script setup></script>

<template>
    <div
        class="bg-secondary-sidebar flex flex-col gap-6 items-center p-6 rounded-2xl"
    >
        <div class="flex justify-between items-center w-full">
            <div class="flex gap-3 items-center text-lg">
                <img
                    src="/assets/images/header/default_avatar.png"
                    alt="avatar"
                    class="w-12 h-12 rounded-full"
                />
                Username
            </div>
            <div class="flex gap-3 items-center">
                <svg
                    v-for="i in 5"
                    width="20"
                    height="19"
                    viewBox="0 0 20 19"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M9.66797 0L12.9008 5.55041L19.1785 6.90983L14.8988 11.6996L15.5458 18.0902L9.66797 15.5L3.79012 18.0902L4.43716 11.6996L0.157404 6.90983L6.43515 5.55041L9.66797 0Z"
                        fill="#298AFF"
                        :fill-opacity="i <= 3 ? '1' : '0.25'"
                    />
                </svg>
            </div>
        </div>
        <div class="text-white/75">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
            ad minim veniam, quis nostrud exercitation ullamco laboris 🔥
        </div>
    </div>
</template>
