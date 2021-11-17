<template>
    <div class="bg-gray-100 p-2 m-3 rounded-md">
        {{message.user.name}} : {{message.message}}
    </div>
</template>

<script>
export default {
    props: ['message']
}
</script>
