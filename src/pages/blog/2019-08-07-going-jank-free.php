<?php
#zigg:title       = `Going jank free - Achieving 60 FPS smooth websites`
#zigg:page-title  = `Going jank free - Achieving 60 FPS smooth websites`
#zigg:slug        = `going-jank-free-achieving-60-fps-smooth-websites`
#zigg:type        = `markdown`
#zigg:template    = `./template/blog-post.php`
#zigg:parent      = `blog`
#zigg:cover-image = `blog/_jank-free{$size}.png`
#zigg:date        = `2019-08-07`
#zigg:description = `Websites that are silky smooth 60 FPS are like the holy grail for web developers. In this post, I'll go in-depth to explain how to attain this enigmatic feat.`
?>

I love small details in web design. Little geometric shapes, lines and scribbles in the background or layered through the content; it's a nice way to add visual flair without taking up space for content.<br>
How about some animations when scrolling and navigating through a page? Subtle animations can draw the user's attention, provide visual clues and can be used for visual storytelling.<br>
Web technology has been rapidly gaining new features to easily create creative and visually impressive multimedia experiences, all in your browser!

<figure class="picture-wrapper">
  <video controls muted src="assets/images/blog/60fps-website-example-cursief-co.m4v"></video>
  <figcaption class="picture-wrapper__caption">Intro and UI animations on the Cursief website.</figcaption>
</figure>

But adding more complexity to your website normally comes at a cost: through a combination of more nodes in the HTML document, advanced CSS features and usually a bunch of JavaScript, the page will quickly feel bloated, slow or choppy. Users with lower-end hardware will be the first to notice your website being sluggish, subsequently leading to less interactivity and impressions. What is going on?


## What is "jank"?

Most device screens are 60 Hz, which indicates that the screen refreshes the visible image 60 times a second. In the development world, we talk about frames per second (FPS) instead of Hz, and we call the property "refresh rate". Software that runs on these devices (like browsers) usually try to match the refresh rate of the screen as closely as possible. So when an animation or transition is running, the browser tries to put 60 new pictures (or frames) per second on the screen.

<figure class="picture-wrapper">
  <video autoplay loop muted src="assets/images/blog/janky-example.webm"></video>
  <figcaption class="picture-wrapper__caption">Example of a "janky" animation.</figcaption>
</figure>

If we calculate (1000 ms / 60 FPS) the time each frame has to be rendered, we'll see that a frame only has a total time of 16.<span style="text-decoration: overline;">6</span> ms. In reality the duration is actually closer to **10ms** per frame, since browsers have some housekeeping work to do behind the scenes. When the browser fails to render in that duration, the framerate drops lower than the refresh rate of the screen. This results in judder of the page content on screen. This is also referred to as **jank**, and it negatively impacts the user experience.



## 1. The pixel pipeline

Websites consist of a mix of file types. From media files to JavaScript and stylesheet files; not only are they functionally different, the browser also parses these files in several distinct ways. How a browser downloads, renders and places an image in the document is much different than how it handles CSS files for example.

JavaScript and CSS files are assets that allow you to manipulate the DOM. When working with animations or transitions, you should be aware of the pixel pipeline. That's the name for the five steps the browser makes during each rendered frame. Knowing about these steps and how your JS, HTML and CSS affect the duration of each of these steps is crucial for high performance websites.

<figure class="picture-wrapper">
  <picture class="lazy">
    <source data-srcset="assets/images/blog/_pixel-pipeline-512px.png 512w, assets/images/blog/_pixel-pipeline-1024px.png 1024w" type="image/png">
    <img data-src="assets/images/blog/_pixel-pipeline-1024px.png" alt="Use case diagram for the PsyData project" data-action="zoom" alt="Schema of the pixel pipeline">
  </picture>
  <figcaption class="picture-wrapper__caption">Schema of the browser's pixel pipeline.</figcaption>
</figure>

When changing a "layout" property of an element in a page, the browser will have to check all the other elements and update the layout, or "reflow" the page. Areas on the page that have been affected will have to be repainted and composited back together. Properties that trigger a reflow change the element's geometry (`width`, `height`, `position`, etc.). For example, reflows can be forced by changing a `display` property, appending an element to the document or animating the element's size or position.<br>
A comprehensive list of JavaScript methods and CSS properties that force layout/reflow can be found here: [What forces layout / reflow
](https://gist.github.com/paulirish/5d52fb081b3570c81e3a) and at [CSS Triggers](https://csstriggers.com/).



## 2. Writing performant CSS for animation

Looking at the pixel pipeline, you can tell that CSS has effect on the style and layout steps. Whenever you update a property that affects the flow of the page, the browser will reflow the page. This is performance-costly, but modern browsers are smart enough to only paint the updated area, not the entire page.

### Animating paint and compositing properties
It's a good idea to minimize the amount of reflows the browser has to do during an animation. You might think that a combination of `position: absolute` and changing the `top` or `left` properties won't affect the surrounding elements, but that's not correct. For example, elements can have a percentage value for `width`, which it will derive from the parent element. Also using units like `em`, `vh` and `vw` are environment variables that will cause reflow.

### Optimize compositing
Every element's geometry properties (i.e. `width`, `margin`, `top`) are handled by the CPU in the first place. For each frame in the animation the geometry of the element will be recalculated and the trigger a reflow, then the updated area gets drawn (paint step in pipeline). Next, the drawn area has to be stitched back together by the compositing step.

To optimize the compositing, the browser has to ensure that the animated CSS property:
- does not affect the document's flow,
- does not depend on the document's flow,
- does not cause a repaint.

### Forcing GPU acceleration
CSS animations aren't always handled by the GPU. To force GPU accelerated rendering you can use one of the many classic (hacky) methods in CSS like: `transform: translateZ(0)` or `transform: translate3d(0, 0, 0)`.<br>
What the browser does is cache the current drawn image of the element in GPU memory and handle all rendering by GPU. So in the pixel pipeline we are moving all the work to the compositing step from there on. Be aware that by changing an element's layout or paint property like `width` or `border`, the browser will have to reflow and repaint the affected area. So use this hack wisely!



## 3. Writing efficient JavaScript for animation

Animating in JavaScript is not the same as doing it with CSS. You have to keep track of a timer or work with a timeline with keyframes and tween between steps in an animation. Assigning new values for the animated properties will also have to be done during each step.
For full JS animations I advice to use established libraries like [GreenSock](https://greensock.com/gsap/) or [Anime.js](https://animejs.com/).

Still, if you really insist on writing your own, here's some things to consider.

### Leveraging CSS solutions
It might be most efficient if your animation can be set up in CSS and played by switching to a different class with JavaScript.

<p class="codepen" data-height="268" data-theme-id="light" data-default-tab="result" data-user="doubtingreality" data-slug-hash="WVdYXw" style="height: 268px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;" data-pen-title="Animation example">
  <span>See the Pen <a href="https://codepen.io/doubtingreality/pen/WVdYXw/">
  Animation example</a> by Murtada al Mousawy (<a href="https://codepen.io/doubtingreality">@doubtingreality</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>

In the example above, the element with the letter "A" inside is being animated by CSS. The only thing clicking on the button does is toggle a class on the element.

### RequestAnimationFrame and timers
When working with animations in JS, it's best to use [`requestAnimationFrame()`](https://developer.mozilla.org/en-US/docs/Web/API/window/requestAnimationFrame) or rAF for short. rAF does not guarantee that your animation will be smooth or 60 FPS, but it tries to avoid frame loss and is more efficient than `setInterval` or `setTimeout`.<br>
When a browser tab is inactive, rAF will pause the animation by blocking requestAnimationFrame callbacks which will **preserve animation state**.

rAF is non-deterministic, which means that we don't know when exactly it will get called. That's why we are forced to use time to keep track of the animation progress. If we'd purely use rAF, the animation could last 1 second (60 FPS), or 2 seconds (30 FPS) or more, depending on the refresh rate of your browser and the system work load.
<p class="codepen" data-height="290" data-theme-id="light" data-default-tab="result" data-user="doubtingreality" data-slug-hash="vodaab" style="height: 290px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;" data-pen-title="CSS vs JS animation requestAnimationFrame">
  <span>See the Pen <a href="https://codepen.io/doubtingreality/pen/vodaab/">
  CSS vs JS animation requestAnimationFrame</a> by Murtada al Mousawy (<a href="https://codepen.io/doubtingreality">@doubtingreality</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>

An example with element "A" being animated by CSS and element "B" being animated by JS with `requestAnimationFrame`.

### Throttling and debouncing (scroll)events

The `scroll` or `mouseMove` events are a little tricky to get performant. Having the events call a function for each time they're triggered is a surefire way to drain your system's resources.<br>
What we need to do is **throttle** and **debounce** the callback of the event.
<p class="codepen" data-height="265" data-theme-id="light" data-default-tab="result" data-user="doubtingreality" data-slug-hash="ZgrMXR" style="height: 265px; box-sizing: border-box; display: flex; align-items: center; justify-content: center; border: 2px solid; margin: 1em 0; padding: 1em;" data-pen-title="Scroll event throttle and debounce">
  <span>See the Pen <a href="https://codepen.io/doubtingreality/pen/ZgrMXR/">
  Scroll event throttle and debounce</a> by Murtada al Mousawy (<a href="https://codepen.io/doubtingreality">@doubtingreality</a>)
  on <a href="https://codepen.io">CodePen</a>.</span>
</p>

By implementing throttling and debouncing in the event handler, we reduce the amount of times the callback is fired. Any animation that relies on the callback is now much less resource-heavy.

## 4. Use DevTools to find performance issues

The developer toolbar is your best way to find and eliminate optimization issues. There are a couple of tools and options in Chrome DevTools that might come in handy when you're unsure what is causing the jank.

### FPS meter
The FPS meter is a good way to get a quick glance of what is happening on the screen, performance-wise. Enable it through the command palette (⌘ + ⇧ + P) while the DevTools panel is open, and search for "Show frames per second (FPS) meter". Or enable it through: Customize and control DevTools menu (⋮) <span class="arrow">›</span> More tools <span class="arrow">›</span> Rendering <span class="arrow">›</span> FPS meter. You can interact with a 3D model of the composited layers, check the memory usage per layer and see the layer is composited.

### Performance tool
With the performance tool in Chrome, you can record runtime performance data. Pressing record, you can interact with the website while performance metrics are being captured. After stopping the recording, the data gets processed and the results will be shown in the performance panel.<br>
You'll get hit in the face with an enormous amount of data, so knowing how to read and analyze the data is important.

<figure class="picture-wrapper">
  <video controls src="assets/images/blog/performance-tool.mp4"></video>
  <figcaption class="picture-wrapper__caption">The Chrome DevTools performance tool in action.</figcaption>
</figure>

### Layers tool
Whenever you're optimizing for the compositing step, it is a good idea to check the Layers tool. Open the command palette and search for "Layers" or go to Customize and control DevTools menu (⋮) <span class="arrow">›</span> More tools <span class="arrow">›</span> Layers.

You can read all about how to use these tools and how to analyze the data here: [Performance Analysis Reference](https://developers.google.com/web/tools/chrome-devtools/evaluate-performance/reference).



## Final thoughts

Smooth animations on the web are not a given. When you see a smoothly animated website, you know that there's a lot of time and effort put into the details. When a device has a refresh rate of 60 Hz, the browser will aim for 60 frames per second rendering. The developer has influence on some crucial steps in the pixel pipeline and can optimize the time the browser takes to render each frame. Being aware of the pixel pipeline gives you a clearer way to make UX and UI choices around optimization.

As a front-end developer you're always striving to create something beautiful and eye-catching but it should not distract the user from reaching their their own goals on the website. Janky animations are something you want to avoid not only because they can be jarring and confusing for the user, they also lower the experience quality of your product.


<script async src="https://static.codepen.io/assets/embed/ei.js"></script>
