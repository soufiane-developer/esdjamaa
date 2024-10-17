<div class="text">jhgfds</div>

<section class="scrollport">
  <div>
    <div class="logo"><img src="../img/logo.png" alt=""></div>
    <h2>heloo</h2>
    <p>frgrfbrgfbrgbrgbrgfbgbrfgbfrgbfgbfgbfbfbfgbf</p>
  </div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
</section>
<style>
    @import "https://unpkg.com/open-props";
@import "https://unpkg.com/open-props/normalize.min.css";

.scrollport {
  -webkit-mask-image: linear-gradient(to right, #0000, #000, #000, #0000);
  
  overflow-x: auto;
  overscroll-behavior-x: contain;
  
  display: flex;
  gap: var(--size-10);
  align-items: start;
  padding: var(--size-10);
}

.scrollport > div {
  block-size: var(--size-15);
  aspect-ratio: var(--ratio-square);
  background-color: var(--surface-2);
  border-radius: var(--radius-3);
  box-shadow: var(--shadow-4);
}
body {
  display: grid;
  place-content: center;
}
</style>