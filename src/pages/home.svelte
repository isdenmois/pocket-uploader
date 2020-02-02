<script>
  import { onMount, createEventDispatcher } from 'svelte';
  import Page from '../components/page.svelte';
  import FileSelect from '../components/file-select.svelte';
  import Line from '../components/line.svelte';
  import { request } from '../services/request';

  const dispatch = createEventDispatcher();
  let files = [];

  onMount(async () => {
    try {
      files = await request('/list.php');
    } catch (e) {
      alert(e);
    }
  });

  async function uploadFiles({ detail: files }) {
    dispatch('upload', files);
  }
</script>

<Page title="Книги">
  {#each files as file}
    <Line name={file} />
  {/each}

  <div slot="tabbar" class="flex">
    <FileSelect accept=".fb2,.fb2.zip,.epub" on:select={uploadFiles}>Добавить книгу</FileSelect>
  </div>
</Page>
