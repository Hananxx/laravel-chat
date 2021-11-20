<template>
    <div :class="sender ?
    'bg-gradient-to-b from-purple-400 to-purple-450 drop-shadow-purple rounded-br-none text-white '
    : 'bg-gradient-to-b from-gray-200 to-gray-300 shadow rounded-tl-none text-gray-800'"
         class="p-2 px-4 my-4 rounded-3xl w-2/3 xl:w-1/2 2xl:w-2/5 relative flex flex-col z-10">
        <h3 class="font-semibold">{{message.user.name}}</h3>
        <p class="ml-3">{{message.message}}</p>
<!--        <div :class="sender ? 'bg-blue-200 right-5' : 'bg-gray-200 left-5'" class="w-5 h-5 absolute -bottom-2.5 rotate-45 z-0"></div>-->
    </div>
</template>
<script>
export default {
    props: ['message', 'sender']
}
</script>
