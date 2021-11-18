<template>
    <div class="h-screen overflow-scroll flex flex-col-reverse">
        <div class="p-2 msg-container">
            <slot/>
        </div>
    </div>
</template>

<style scoped>
.msg-container{
    background-image: url("data:image/svg+xml,<svg id='patternId' width='100%' height='100%' xmlns='http://www.w3.org/2000/svg'><defs><pattern id='a' patternUnits='userSpaceOnUse' width='22' height='22' patternTransform='scale(1) rotate(135)'><rect x='0' y='0' width='100%' height='100%' fill='hsla(284, 0%, 100%, 1)'/><path d='M3.25 10h13.5M10 3.25v13.5' transform='translate(1,0)' stroke-linecap='square' stroke-width='1' stroke='hsla(280, 0%, 94%, 1)' fill='none'/></pattern></defs><rect width='800%' height='800%' transform='translate(0,0)' fill='url(%23a)'/></svg>")
}
</style>

<script>
    export default {

    }
</script>
