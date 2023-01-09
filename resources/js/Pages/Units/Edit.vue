<template>
  <Head title="Units" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Unit Edit
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex m-2 p-2">
          <Link
            :href="route('units.index')"
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
              <form @submit.prevent="updateUnit">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                  <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                    <div>
                      <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Unit Name</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          v-model="form.unit_no"
                          type="text"
                          id="unit_no"
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          placeholder="Name of Unit"
                        />
                        <!-- Display error msg -->
                        <div
                          v-if="errors.unit_no"
                          v-text="errors.unit_no"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                    <!-- Apartment  -->
                    <div>
                      <label
                        for="location"
                        class="block text-sm font-medium text-gray-700"
                        >Apartment</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <select
                          class="
                            block
                            w-0.25
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          v-model="form.apartment_id"
                        >
                          <option
                            v-for="apartment in apartments.data"
                            :value="apartment.id"
                            :key="apartment.id"
                          >
                            {{ apartment.name }}
                          </option>
                        </select>
                        <!-- Display error msg -->
                        <div
                          v-if="errors.apartment_id"
                          v-text="errors.apartment_id"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                    <!-- Type -->
                    <div>
                      <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Type</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <select
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          v-model="form.type"
                        >
                          <option hidden>Select Unit Type</option>
                          <option value="studio">studio</option>
                          <option value="1 bedroom">1 bedroom</option>
                          <option value="2 bedroom">2 bedroom</option>
                          <option value="3 bedroom">3 bedroom</option>
                          <option value="4 bedroom">4 bedroom</option>
                        </select>
                        <!-- Display error msg -->
                        <div
                          v-if="errors.type"
                          v-text="errors.type"
                          class="text-red-800 text-sm mt-2"
                        ></div>
                      </div>
                    </div>
                    <!-- MeterNo -->
                    <div>
                      <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Meter No</label
                      >
                      <div class="mt-1 flex rounded-md shadow-sm">
                        <input
                          v-model="form.meter_no"
                          type="number"
                          id="meter_no"
                          class="
                            block
                            w-full
                            flex-1
                            rounded-none rounded-r-md
                            border-gray-300
                            focus:border-indigo-500 focus:ring-indigo-500
                            sm:text-sm
                          "
                          placeholder="Meter_No of Unit"
                        />
                        <!-- Display error msg -->
                        <div
                          v-if="errors.meter_no"
                          v-text="errors.meter_no"
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
import { Inertia } from "@inertiajs/inertia";
import { ref } from "@vue/reactivity";

let processing = ref(false);

const props = defineProps({
  unit: Object,
  apartments: Object,
  errors: Object,
});

// const form = useForm(props.unit)
const form = useForm({
  unit_no: props.unit.unit_no,
  apartment_id: props.unit.apartment_id,
  meter_no: props.unit.meter_no,
  type: props.unit.type,
});



const updateUnit = () => {
    Inertia.post(`/units/${props.unit.id}`, {
  _method: 'put',
  
  unit_no:form.unit_no,
  apartment_id:form.apartment_id,
  meter_no:form.meter_no,
  type:form.type,
    });
  }

</script>
  