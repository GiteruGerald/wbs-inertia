<template>
  <Head title="Apartments" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Apartments Create
      </h2>
    </template>
    <!-- TODO: Add image to apartment -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            :href="route('apartments.index')"
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
              <form @submit.prevent="storeApartment">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                  <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                    <div>
                      <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Name</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          v-model="form.name"
                          type="text"
                          name="name"
                          id="name"
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          placeholder="Name of Apartment"
                        />
                        <!-- Display error msg -->
                        <div
                          v-if="errors.name"
                          v-text="errors.name"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                    <!-- Location  -->
                    <div>
                      <label
                        for="location"
                        class="block text-sm font-medium text-gray-700"
                        >Location</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          v-model="form.location"
                          type="text"
                          id="location"
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          placeholder="Location of Apartment"
                        />
                        <!-- Display error msg -->
                        <div
                          v-if="errors.location"
                          v-text="errors.location"
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

let processing = ref(false);

const props = defineProps({
  errors: Object,
});

const form = useForm({
  name: null,
  location: null,
});

const storeApartment = async () => {
  processing.value = true;

  await form.post("/apartments");
};
</script>
  