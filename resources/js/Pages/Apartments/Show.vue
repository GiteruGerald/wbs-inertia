<template>
  <Head title="Apartments" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Apartment Show
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            href="/apartments"
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
              <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <!-- Apartment Details -->
                <div>
                  <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                      {{ apartment.name }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                      Apartment details.
                    </p>
                  </div>
                  <div
                    class="
                      bg-gray-50
                      px-4
                      py-5
                      sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                    "
                  >
                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                    <dd
                      class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                    >
                      {{ apartment.location }}
                    </dd>
                  </div>
                  <div
                    class="
                      bg-gray-50
                      px-4
                      py-5
                      sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6
                    "
                  >
                    <dt class="text-sm font-medium text-gray-500">Units</dt>
                    <dd
                      class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"
                    >
                      {{ units }}
                    </dd>
                  </div>
                </div>
                <hr />
              </div>
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
import { HomeIcon } from "@heroicons/vue/20/solid";
import { ref } from "vue";

const props = defineProps({
  units: Object,
  apartment: Object,
});

const storeAgreement = () => {
  processing.value = true;
  form.post("/agreements");
};
</script>
  