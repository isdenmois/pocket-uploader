<script>
  import { onMount, createEventDispatcher } from 'svelte';
  import Page from '../components/page.svelte';
  import Line from '../components/line.svelte';
  import { request } from '../services/request';

  export let files = null;

  const dispatch = createEventDispatcher();
  let current = 0;
  let progress = [];
  let done = false;

  onMount(async () => {
    for (let f of files) {
      setProgress(0);
      const body = new FormData();

      body.append('file', f);

      try {
        await request('/upload.php', { method: 'POST', body, headers: {} }, setProgress);
      } catch (e) {
        alert((e && e.responseText) || e);
      }

      current++;
    }

    request('/scan.php');

    done = true;
  });

  function setProgress(value) {
    progress[current] = value;
    progress = progress;
  }

  function goBack() {
    dispatch('done', null);
  }
</script>

<style>
  .continue {
    background-color: var(--blue);
    color: white;
    font-size: 20px;
  }

  .continue:active {
    background-color: var(--blueActive);
  }
</style>

<Page title={done ? 'Загружено' : 'Загрузка'}>
  {#each files as file, i}
    <Line name={file.name} progress={progress[i]} />
  {/each}

  <div slot="tabbar" class="flex">
    {#if done}
      <div class="continue flex flex-center" on:click={goBack}>Продолжить</div>
    {/if}
  </div>
</Page>
