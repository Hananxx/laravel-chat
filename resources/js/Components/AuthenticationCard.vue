<template>
    <div class="auth-card min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-gray-50 to-gray-100">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
<style>
    .auth-card {
        background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='23' height='23' patternTransform='scale(1) rotate(135)'><rect x='0' y='0' width='100%' height='100%' fill='hsla(210, 20%, 98%, 1)'/><path d='M3.25 10h13.5M10 3.25v13.5' transform='translate(1.5,0)' stroke-linejoin='round' stroke-linecap='round' stroke-width='0.5' stroke='hsla(0, 0%, 90%, 1)' fill='none'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
    }
</style>
