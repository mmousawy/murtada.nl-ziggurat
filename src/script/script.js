(() => {
  'use strict';

  const navButton = document.querySelector('.page-nav-label__button');
  const header = document.querySelector('.page-header');
  const nav = document.querySelector('.page-nav');
  const navBackground = document.querySelector('.page-nav__background');
  const contentOverlay = document.querySelector('.page-content-overlay');
  const gallery = document.querySelector('.gallery__pane');
  const backgroundItems = [];
  const email = ['info', 'murtada.nl'].join('@');

  let headerRect, headerHeight,
      menuIsOpen = false,
      scrollY = 0,
      prevScrollY = 0,
      headerPos = 0,
      blurSize = 0,
      opacity = 0,
      targetOpacity = 0,
      previousTime = 0;

  const navButtonHandler = (e) => {
    if (e.currentTarget.checked) {
      backgroundItems.forEach((item, itemIndex) => {
        const depth = 1.5 + Math.random() * 1.5;
        item.style.top = `${(itemIndex / backgroundItems.length) * 90 + Math.random() * (backgroundItems.length / 100)}vh`;
        item.style.left = `${Math.round(Math.random() * 90)}vw`;
        item.style.transform = `scale(${depth}) translate3d(0,0,0)`;
        item.style.opacity = .5 + (3 - depth) * .5;
      });

      nav.style.transitionDelay = '100ms';
      contentOverlay.style.transitionDelay = '0ms';
      nav.classList.add('is-open');
      navBackground.style.animationName = 'slideInBackground';
      contentOverlay.classList.add('is-visible');
      document.documentElement.classList.add('no-scroll');
      menuIsOpen = true;
      requestAnimationFrame(headerFrame);
    } else {
      nav.style.transitionDelay = '0ms';
      contentOverlay.style.transitionDelay = '100ms';
      nav.classList.remove('is-open');
      contentOverlay.classList.remove('is-visible');
      document.documentElement.classList.remove('no-scroll');
      menuIsOpen = false;
      requestAnimationFrame(headerFrame);

      setTimeout(() => {
        navBackground.style.animationName = 'none';
      }, 300);
    }
  };

  navButton.addEventListener('change', navButtonHandler);

  window.addEventListener('resize', resizeHandler);

  window.addEventListener('scroll', () => {
    requestAnimationFrame(scrollHandler);
  });

  [].slice.call(document.querySelectorAll('.page-header a')).forEach(navItem => {
    navItem.addEventListener('focus', (event) => {
      headerPos = 0;
      headerFrame();
    });
  });

  document.querySelector('.page-nav .page-nav__item--hire-me').addEventListener('click', (event) => {
    navButton.checked = false;
    navButtonHandler({
      currentTarget: navButton
    });
  });

  // Handle the resize event
  function resizeHandler() {
    if (gallery) {
      gallery.scrollPos = 1;
    }

    // Close the menu when in large media query
    if (window.innerWidth > 800) {
      nav.classList.remove('is-animated');

      if (navButton.checked) {
        navButton.checked = false;
        navButtonHandler({
          currentTarget: navButton
        });
      }
    } else {
      nav.classList.add('is-animated');
      if (gallery) {
        gallery.classList.add('snap');
        gallery.scrollLeft += 1;
      }
    }

    headerRect = header.getBoundingClientRect();
    headerHeight = headerRect.height;

    [].slice.call(document.querySelectorAll('.tooltip')).forEach(tooltip => {
      tooltip.style.top = 0;
      tooltip.style.left = 0;

      const originRect = tooltip.origin.getBoundingClientRect();

      tooltip.style.top = `${originRect.top + window.scrollY}px`;
      tooltip.style.left = `${originRect.left + originRect.width * .5 - tooltip.clientWidth * .5}px`;
    });
  }

  // Handle the scroll event
  function scrollHandler(now) {
    scrollY = Math.max(0, window.scrollY ? window.scrollY : document.documentElement.scrollTop);

    const scrollDelta = prevScrollY - scrollY;

    headerPos += scrollDelta;
    headerPos = Math.max(-headerHeight, Math.min(0, headerPos));

    prevScrollY = scrollY;

    if (now - previousTime > 10) {
      headerFrame();
    }

    previousTime = now;
  }

  // Position and animate header
  function headerFrame() {
    let minOpacity = 0;

    if (menuIsOpen) {
      // Menu is open
      targetOpacity = 1;

      if (headerPos < -.1) {
        headerPos -= headerPos * .2;
      } else {
        headerPos = 0;
      }

      // Animate to fully solid
      if (opacity < targetOpacity - .1) {
        opacity += (targetOpacity - opacity) * .1;
        requestAnimationFrame(headerFrame);
      } else {
        opacity = targetOpacity;
        headerPos = 0;
      }
    } else {
      // Menu is closed
      if (scrollY < headerHeight) {
        blurSize = (scrollY + headerPos) * .5;
      } else {
        blurSize = (headerHeight + headerPos) * .5;
      }

      opacity = blurSize * 1 / (headerHeight * .5);

      // Animate to current opacity
      if (targetOpacity > opacity + .1) {
        targetOpacity += (opacity - targetOpacity) * .1;
        opacity = targetOpacity;
        requestAnimationFrame(headerFrame);
      } else {
        targetOpacity = 0;
      }
    }

    // Always have a solid background when lower than the top of the page
    if (scrollY > headerHeight - headerPos) {
      minOpacity = 1;
    }

    header.style.transform = `translateY(${headerPos}px)`;
    header.style.boxShadow = `0 0 ${blurSize * opacity}px rgba(47,54,91,${.3 * opacity})`;
    header.style.backgroundColor = `rgba(255,255,255,${Math.min(minOpacity + opacity, 1)})`;
  }

  // Navigation background items
  const shapes = [].slice.call(document.querySelectorAll('.shape'));

  for (let index = 0; index < 6; index++) {
    const item = shapes[Math.floor(Math.random() * 3)].cloneNode(true);
    item.removeAttribute('hidden');
    item.classList.add('nav-bg-item');
    const path = item.querySelector('path');
    if (path) {
      path.classList.add('nav-bg-item__inside');
      path.classList.add(`nav-bg-item__inside--${Math.ceil(Math.random() * 10)}`);
    }

    backgroundItems.push(item);
    navBackground.appendChild(item);
  }

  // Open email function
  const openEmail = e => (window.location.href = `mailto:${email}`) && e.preventDefault();

  // E-mail copy
  const emailCopy = e => {
    copyToClipboard(email);

    e.preventDefault();

    if (document.querySelector('.tooltip')) {
      return;
    }

    const newTooltip = document.createElement('div');
    newTooltip.innerHTML = 'Copied to clipboard! <span class="emoji">🎉</span>';

    newTooltip.classList.add('tooltip');

    if (event.currentTarget.classList.contains('tooltip-right')) {
      newTooltip.classList.add('tooltip--right');
    }

    if (event.currentTarget.classList.contains('tooltip-left')) {
      newTooltip.classList.add('tooltip--left');
    }

    document.body.appendChild(newTooltip);

    const originRect = event.currentTarget.getBoundingClientRect();

    newTooltip.origin = event.currentTarget;

    newTooltip.style.top = `${originRect.top + window.scrollY}px`;
    newTooltip.style.left = `${originRect.left + originRect.width * .5 - newTooltip.clientWidth * .5}px`;

    event.currentTarget.focus();

    window.setTimeout(() => {
      newTooltip.classList.add('hide');

      window.setTimeout(() => {
        newTooltip.remove();
      }, 250);
    }, 2000);
  };

  function copyToClipboard (text) {
    // Use the Async Clipboard API when available. Requires a secure browing
    // context (i.e. HTTPS)
    if (navigator.clipboard) {
      return navigator.clipboard.writeText(text);
    }

    // ...Otherwise, use document.execCommand() fallback

    // Put the text to copy into a <span>
    var span = document.createElement('span');
    span.textContent = text;

    // Preserve consecutive spaces and newlines
    span.style.whiteSpace = 'pre';

    // Add the <span> to the page
    document.body.appendChild(span)

    // Make a selection object representing the range of text selected by the user
    var selection = window.getSelection();
    var range = window.document.createRange();
    selection.removeAllRanges();
    range.selectNode(span);
    selection.addRange(range);

    // Copy text to the clipboard
    var success = false

    try {
      success = window.document.execCommand('copy')
    } catch (err) {
      console.log('error', err);
    }

    // Cleanup
    selection.removeAllRanges();
    window.document.body.removeChild(span);

    // The Async Clipboard API returns a promise that may reject with `undefined`
    // so we match that here for consistency.
    return success
      ? Promise.resolve()
      : Promise.reject(); // eslint-disable-line prefer-promise-reject-errors
  }

  // Contact buttons
  [].slice.call(document.querySelectorAll('.button--contact')).forEach(button => {
    button.addEventListener('click', openEmail);
    button.addEventListener('keydown', event => {
      (event.keyCode == 13 || event.keyCode == 32)
        ? openEmail(event)
        : false;
    });
  });

  // Copy buttons
  [].slice.call(document.querySelectorAll('.copy-to-clipboard--email')).forEach(button => {
    button.addEventListener('click', emailCopy);
    button.addEventListener('keydown', event => {
      (event.keyCode == 13 || event.keyCode == 32)
        ? emailCopy(event)
        : false;
    });
  });

   // Lazy loading
   document.addEventListener('DOMContentLoaded', function() {
    var lazyImages = [].slice.call(document.querySelectorAll('picture.lazy'));

    if ('IntersectionObserver' in window) {
      let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            [].slice.call(entry.target.querySelectorAll('source[data-srcset], img[data-src]')).forEach(pictureSource => {
              !pictureSource.src && pictureSource.dataset.src && (pictureSource.src = pictureSource.dataset.src) && delete pictureSource.dataset.src;
              !pictureSource.srcset && pictureSource.dataset.srcset && (pictureSource.srcset = pictureSource.dataset.srcset) && delete pictureSource.dataset.srcset;
            });
            lazyImageObserver.unobserve(entry.target);

            setTimeout(() => {
              entry.target.classList.remove('lazy');
            }, 100);
          }
        });
      });

      lazyImages.forEach(function(lazyImage) {
        lazyImageObserver.observe(lazyImage);
      });
    } else {
      lazyImages.forEach(function(lazyImage) {
        [].slice.call(lazyImage.querySelectorAll('source[data-srcset], img[data-src]')).forEach(pictureSource => {
          pictureSource.dataset.src && (pictureSource.src = pictureSource.dataset.src);
          pictureSource.dataset.srcset && (pictureSource.srcset = pictureSource.dataset.srcset);
          delete pictureSource.dataset;
        });
        lazyImage.classList.remove('lazy');
      });
    }
  });

  if (gallery) {
    const galleryPictures = document.querySelectorAll('.gallery__picture');

    gallery.addEventListener('scroll', function(event) {
      const pos = this.scrollLeft + window.innerWidth * .5;

      let activePicture;

      for (let i = galleryPictures.length - 1; i > -1; i--) {
        const picture = galleryPictures[i];

        if (pos > picture.offsetLeft) {
          const otherPicture = this.querySelector('.active');
          activePicture = picture;

          if (otherPicture && activePicture !== otherPicture) {
            otherPicture.classList.remove('active');
          }

          break;
        }
      }

      activePicture.classList.add('active');
    });
  }

  resizeHandler();
  headerFrame();
  header.style.position = 'fixed';
})();
