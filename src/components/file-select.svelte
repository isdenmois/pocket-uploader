<script>
  import { createEventDispatcher } from 'svelte';
  export let accept;

  const dispatch = createEventDispatcher();

  function onChange(event) {
    const target = event.target;

    if (target.files.length) {
      const files = [];

      for (let i = 0; i < target.files.length; i++) {
        files[i] = target.files[i];
      }

      dispatch('select', files);
    }

    target.value = '';
  }
</script>

<style>
  .wrapper {
    background-color: var(--blue);
    color: white;
    font-size: 20px;
  }

  .wrapper:active {
    background-color: var(--blueActive);
  }

  .input {
    height: 100%;
    opacity: 0;
    position: absolute;
    width: 100%;
    z-index: 5;
    top: 0;
    left: 0;
  }
</style>

<div class="wrapper flex flex-center">
  <input class="input" type="file" multiple {accept} on:change={onChange} />
  <slot />
</div>
