<script>
  export let name;
  export let progress;

  const REGEX = /\.([\w]+)(\.zip)?$/;

  $: ext = getExt();

  function getExt() {
    const match = name && name.match(REGEX);

    return match ? match[1] : '';
  }
</script>

<style>
  .row {
    display: flex;
    margin-top: 15px;
  }
  .row:first-child {
    margin-top: 0;
  }

  .icon {
    width: 22px;
    height: 29px;
    background: url('/icons/file.svg');
    position: relative;
  }

  .ext {
    position: absolute;
    bottom: 2px;
    color: white;
    width: 100%;
    text-align: center;
    font-size: 10px;
  }

  .title {
    flex: 1;
    margin-left: 15px;
  }

  .progress {
    position: relative;
    background-color: #eceff1;
    border-radius: 10px;
    height: 3px;
    margin-top: 5px;
  }

  .progress:after {
    content: '';
    position: absolute;
    width: var(--progress);
    background-color: #03a9f4;
    border-radius: 10px;
    height: 3px;
  }
</style>

<div class="row">
  <div class="icon">
    <span class="ext">{ext}</span>
  </div>
  <div class="title">
    <div>{name}</div>

    {#if progress}
      <div class="progress" style="--progress:{progress}%" />
    {/if}
  </div>
</div>
