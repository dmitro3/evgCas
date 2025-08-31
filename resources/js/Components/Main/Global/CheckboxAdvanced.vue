<template>
  <label class="custom-checkbox" :class="[sizeClass, variantClass]">
    <input
      type="checkbox"
      :checked="modelValue"
      :disabled="disabled"
      @change="$emit('update:modelValue', $event.target.checked)"
    />
    <div class="custom-checkbox-box" :class="boxClass">
      <svg
        v-if="!loading"
        class="custom-checkbox-checkmark"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
          clip-rule="evenodd"
        />
      </svg>
      <div v-else class="loader-small"></div>
    </div>
    <div v-if="label || $slots.default" class="custom-checkbox-label" :class="labelClass">
      <slot>{{ label }}</slot>
      <span v-if="required" class="text-red-primary ml-1">*</span>
    </div>
  </label>
  <div v-if="error" class="text-red-primary text-sm mt-1">{{ error }}</div>
  <div v-if="helper" class="text-secondary-light/50 text-sm mt-1">{{ helper }}</div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  modelValue: {
    type: Boolean,
    default: false
  },
  label: {
    type: String,
    default: ''
  },
  disabled: {
    type: Boolean,
    default: false
  },
  loading: {
    type: Boolean,
    default: false
  },
  required: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: ''
  },
  helper: {
    type: String,
    default: ''
  },
  size: {
    type: String,
    default: 'md',
    validator: (value) => ['sm', 'md', 'lg'].includes(value)
  },
  variant: {
    type: String,
    default: 'primary',
    validator: (value) => ['primary', 'success', 'warning', 'danger'].includes(value)
  },
  rounded: {
    type: Boolean,
    default: false
  }
})

defineEmits(['update:modelValue'])

const sizeClass = computed(() => {
  const sizes = {
    sm: 'text-sm',
    md: 'text-base',
    lg: 'text-lg'
  }
  return sizes[props.size]
})

const boxClass = computed(() => {
  const sizes = {
    sm: 'w-4 h-4',
    md: 'w-5 h-5',
    lg: 'w-6 h-6'
  }

  const variants = {
    primary: 'border-secondary-light/30 checked:border-primary checked:bg-primary',
    success: 'border-secondary-light/30 checked:border-green checked:bg-green',
    warning: 'border-secondary-light/30 checked:border-orange checked:bg-orange',
    danger: 'border-secondary-light/30 checked:border-red-primary checked:bg-red-primary'
  }

  const rounded = props.rounded ? 'rounded-full' : 'rounded'

  return [sizes[props.size], variants[props.variant], rounded].join(' ')
})

const labelClass = computed(() => {
  const sizes = {
    sm: 'ml-2 text-sm',
    md: 'ml-2 text-base',
    lg: 'ml-3 text-lg'
  }
  return sizes[props.size]
})
</script>

<style scoped>
.loader-small {
  width: 12px;
  height: 12px;
  border: 2px solid #fff;
  border-bottom-color: transparent;
  border-radius: 50%;
  display: inline-block;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}

@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
