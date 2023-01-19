<template>
  <Head title="Readings" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Reading
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
          :href="route('readings.index')"
            class="
              px-4
              py-2
              bg-indigo-500
              hover:bg-indigo-600
              text-white
              rounded
            "
            >Back</Link
          >
        </div>
        <div class="flex">
          <div class="container px-5 mx-auto flex">
            <div
              class="
                bg-white
                rounded-lg
                p-8
                flex flex-col
                md:ml-auto
                w-full
                mt-10
                md:mt-0
                relative
                z-10
                shadow-md
              "
            >
              <form @submit.prevent="updateReading">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                  <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                    <!-- Unit  -->
                    <div>
                      <label
                        for="unit"
                        class="block text-sm font-medium text-gray-700"
                        >Edit Unit {{ reading.unit.unit_no }}   </label
                      >
                      <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Bill Month: {{ reading.bill.month }}
                      </p>
                    </div>
                    <!-- Previous -->
                    <div>
                      <label
                        for="previous"
                        class="block text-sm font-medium text-gray-700"
                        >Previous Reading</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          v-model="form.previous"
                          type="number"
                          id="previous"
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          placeholder="previous"
                        />
                        <!-- Display error msg -->
                        <div
                          v-if="errors.previous"
                          v-text="errors.previous"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                    <!-- Current -->
                    <div>
                      <label
                        for="current"
                        class="block text-sm font-medium text-gray-700"
                        >Current Reading</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          v-model="form.current"
                          type="number"
                          id="current"
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          placeholder="current"
                        />
                        <!-- Display error msg -->
                        <div
                          v-if="errors.current"
                          v-text="errors.current"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                  </div>
                  <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button
                      type="submit"
                      class="
                        inline-flex
                        justify-center
                        rounded-md
                        border border-transparent
                        bg-indigo-600
                        py-2
                        px-4
                        text-sm
                        font-medium
                        text-white
                        shadow-sm
                        hover:bg-indigo-700
                        focus:outline-none
                        focus:ring-2
                        focus:ring-indigo-500
                        focus:ring-offset-2
                      "
                      :disabled="processing"
                    >
                      Save
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div></div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
    <script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";
import { onMounted } from "vue";

let processing = ref(false);

const props = defineProps({
  reading: Object,
  // units: Object,
  errors: Object,
});

const form = useForm({
  unit_id: props.reading.unit_id,
  previous: props.reading.previous,
  current: props.reading.current,
});


const updateReading = () => {
  // processing.value = true;
  Inertia.post(`/readings/${props.reading.id}/update`, {
    previous: form.previous,
    current: form.current,
  });
};
</script>
    