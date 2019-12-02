<?php
#zigg:title       = `Dealing with large SVG backgrounds`
#zigg:page-title  = `Dealing with large SVG backgrounds`
#zigg:slug        = `dealing-with-large-svg-backgrounds`
#zigg:type        = `markdown`
#zigg:template    = `blog-post`
#zigg:parent      = `blog`
#zigg:cover-image = `assets/images/blog/large-svg-backgrounds{$size}.png`
#zigg:cover-image-webp = `assets/images/blog/large-svg-backgrounds{$size}.webp`
#zigg:cover-alt   = `Isometric illustration of a monitor/computer screen being filled with paint.`
#zigg:date        = `2019-10-08`
#zigg:description = `Using SVGs on the web is a great way to have responsive images in your product. Usually SVGs are used for illustrations and icons, but what about using them for backgrounds? Let&apos;s dive in!`
?>

Using SVGs for icons and illustrations has made things a great deal easier for web developers. SVG graphics are inherently scalable because the image is built up from vectors and coordinate data. A smaller, larger or scaled version of the source image is done by a simple multiplication of all the numbers inside the image data.<br>
But what about using SVGs for backgrounds? What method works well for which situation?

### External reference
You can just drop your image as an external file in the `url()` function in your CSS, and most of the times it'll work just fine.

```css
body {
  background-image: url(image.svg);
}
```

### Inlined
An alternative way is to inline SVG data into your `url()` function. But make sure to not encode the image with base64: it takes up more size (up to 37% larger files) and it's simply unnecessary. Instead, only URL-encode special characters:

```css
body {
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle r='50' cx='50' cy='50' fill='tomato'/%3E%3C/svg%3E");
}
```

## Performance considerations
You should keep an eye on rendering performance whenever you're using (multiple) complex and/or large SVGs throughout your document. Since SVG images can have multiple layers, filters and complex paths, the browser might struggle with rendering some of them without causing some noticeable jank. At a certain point it might be better to opt for using a rasterized image for the sake of alleviating some performance-heavy calculations while rendering those SVGs.

## Visual bugs
Webkit browsers have always had a bug on high-DPI screens with background SVG images and the `background-size` property. Note that this only happens with the combination of `image-repeat` being on (i.e. `repeat`, `repeat-x` or `repeat-y`) and `background-size` having the default value (`auto`), or a unit value (i.e. `120rem`, `1920px` or a percentage value below 100%).

The bug comprises of the image appearing pixelated when enlarging the image above the original size.

<figure class="picture-wrapper picture-wrapper--outside picture-wrapper--left">
  <div class="picture-column">
    <picture class="lazy">
      <source data-srcset="assets/images/blog/webkit-visual-bug-svg-background-1024px.webp 1024w, assets/images/blog/webkit-visual-bug-svg-background-1920px.webp 1920w" type="image/webp">
      <source data-srcset="assets/images/blog/webkit-visual-bug-svg-background-1024px.png 1024w, assets/images/blog/webkit-visual-bug-svg-background-1920px.png 1920w" type="image/png">
      <img data-src="assets/images/blog/webkit-visual-bug-svg-background-1920px.png" data-action="zoom" alt="Abstract example of a chained Promise cycle.">
    </picture>
  </div>
  <figcaption class="picture-wrapper__caption">Example of an SVG background image appearing pixelated after using the <code>background-size</code> property.</figcaption>
</figure>

A method to prevent this is to either make the original image larger than the intended use, or to inline the image in your HTML. You can then use `position: absolute` with `z-index` to position the element and send it backwards.


```css
.parent {
  position: relative;
}

/* Large centered SVG background */
.background {
  z-index: -1;
  position: absolute;
  top: -30rem;
  width: 1920px;
  left: 50%;
  transform: translateX(-50%);
}
```

Something to pay attention to is what position your SVG element will be in your DOM. If it's not placed early in the `<body>` the rendering of the background might get deferred until the rest of the page is drawn first, leading to flickering.
