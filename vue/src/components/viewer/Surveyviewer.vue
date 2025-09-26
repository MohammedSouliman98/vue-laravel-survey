<template>
  <fieldset class="mb-4">
    <div>
      <legend class="text-gray-900 font-medium">
        {{ index + 1  }}. {{ question.question }}
       </legend>
       <p class="text-gray-500 font-medium ">
        {{ question.description }}
       </p>
    </div>
    <div class="mt-3">
      <div v-if="question.type === 'select'">
        <select :value="modelValue" @change="emits('update:modelValue' , $event.target.value)"
        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4">
        <option value="">Please Select</option>
        <option v-for="option in question.data.options" :key="option.uuid" :value="option.text">
          {{ option.text }}
        </option>
        </select>
      </div>
      <div v-else-if="question.type === 'radio'">
        <div v-for="(option  , index ) in question.data.options" :key="option.uuid" class="flex items-center">
          <input type="radio" :name="'question' +question.id" :id="option.uuid" :value="option.text"
            @change="emits('update:modelValue' , $event.target.value)"
          >
          <label :for="option.uuid"
          class="ml-3 block text-sm font-medium text-gray-500">{{ option.text }}</label>
        </div>
      </div>
      <div v-else-if="question.type === 'checkbox'">
        <pre>{{ model }}</pre>
        <div v-for="(option  , index ) in question.data.options" :key="option.uuid" class="flex items-center">
          <input type="checkbox" :name="'question' + question.id" :id="option.uuid" v-model="model[option.text]"
            @change="onCheckboxChange"
          >
          <label :for="option.uuid"
          class="ml-3 block text-sm font-medium text-gray-500">{{ option.text }}</label>
        </div>
      </div>
      <div v-else-if="question.type === 'text'">
        <input type="text"
        :value="modelValue"
        @change="emits('update:modelValue' , $event.target.value)"
        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4"
        >
      </div>
      <div v-else-if="question.type === 'textarea'">
        <textarea name=""
        :value="modelValue"
        @change="emits('update:modelValue' , $event.target.value)"
        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4"
        ></textarea>
      </div>
    </div>
  </fieldset>
</template>

<script setup>
import { ref } from 'vue';

const {question , index , modelValue} = defineProps({
  question : Object,
  index : Number,
  modelValue: [String , Array]
})

const emits = defineEmits(["update:modelValue"]);


let model  = ref() ;

if(question.type === "checkbox"){
  
  model = ref({})

}

function onCheckboxChange($event){
  const selectedOptions = [];
  for (let text in model.value){
    if(model.value[text]){
      selectedOptions.push(text)
    }
  }

  emits( "update:modelValue" ,selectedOptions )
}

</script>

<style>

</style>