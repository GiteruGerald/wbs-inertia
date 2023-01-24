<template>
    
    <TransitionGroup
        
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs"
        >

        <ToastListItem
        v-for="(item, index) in toast.items"
        :key="index"
        @remove="remove(index)"
        :message="item.message"
        :duration="3000"
        />
    </TransitionGroup>
</template>

<script setup>
import ToastListItem from "@/Components/ToastListItem.vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";
import toast from "@/Stores/toast";

const page = usePage();

let removeFinishEventListener = Inertia.on("finish", () => {
  if (page.props.value.toast) {
    toast.add({
      message: page.props.value.toast,
    });
  }
});

onMounted(() => removeFinishEventListener());

function remove(index) {
  toast.remove(index);
}
</script>
