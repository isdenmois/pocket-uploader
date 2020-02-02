<script>
  export let title;

  function preventDefault(e) {
    e.preventDefault();
  }
</script>

<style>
  .page {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow-x: visible;
    overflow-y: hidden;
    z-index: 2;
  }

  .title {
    line-height: 40px;
    text-align: center;
    font-weight: bold;
  }

  .content {
    background-color: white;
    position: absolute;
    overflow: auto;
    top: 40px;
    bottom: var(--tabbarHeight);
    left: 0;
    right: 0;
    padding: 15px 20px;
    -webkit-overflow-scrolling: touch;
  }

  .tabbar {
    align-items: center;
    background-color: white;
    bottom: 0;
    display: flex;
    height: var(--tabbarHeight);
    position: fixed;
    left: 0;
    margin: 0;
    padding: 0;
    right: 0;
    justify-content: stretch;
    align-items: stretch;
  }
</style>

<div class="page">
  <div class="title">{title}</div>

  <div class="content">
    <slot />
  </div>

  <div class="tabbar" on:touchMove={preventDefault}>
    <slot name="tabbar" />
  </div>
</div>
