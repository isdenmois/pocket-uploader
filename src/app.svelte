<script>
  import HomePage from './pages/home.svelte';
  import UploadPage from './pages/upload.svelte';

  let files = null;

  function setFiles(event) {
    files = event.detail;
  }
</script>

{#if files && files.length > 0}
  <UploadPage {files} on:done={setFiles} />
{:else}
  <HomePage on:upload={setFiles} />
{/if}
