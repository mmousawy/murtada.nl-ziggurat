(() => {
  'use strict';

  const navButton = document.querySelector('.page-nav-label__button');
  const body = document.querySelector('body');
  const header = document.querySelector('.page-header');
  const nav = document.querySelector('.page-nav');
  const navBackground = document.querySelector('.page-nav__background');
  const contentOverlay = document.querySelector('.page-content-overlay');
  const gallery = document.querySelector('.gallery');
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

    if (body.classList.contains('is-inverted')) {
      header.style.backgroundColor = `rgba(0,48,86,${Math.min(minOpacity + opacity, 1)})`;
    } else {
      header.style.backgroundColor = `rgba(255,255,255,${Math.min(minOpacity + opacity, 1)})`;
    }
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
    const flkty = new Flickity(gallery.querySelector('.gallery__pane'), {
      imagesLoaded: true,
      percentPosition: false,
      fullscreen: true,
    });

    gallery.querySelector('.flickity-viewport').addEventListener('click', (e) => {
      e.preventDefault();
    }, true);
  }

  resizeHandler();
  headerFrame();
  header.style.position = 'fixed';

  if (document.querySelector('.stork-animation')) {
    const storkAnimationContent = document.querySelector('.stork-animation__table-content');
    const storkDragDrop = document.querySelector('.stork__drag-drop');
    const storkDragDropIcon = storkDragDrop.querySelector('.stork__icon');
    const rowTemplate = document.querySelector('#stork-animation__row-template');
    const storkForm = document.querySelector('#purchase form');
    const storkFormFieldset = storkForm.querySelector('fieldset');
    const storkFormPre = document.querySelector('.pre-signup');
    const storkFormPost = document.querySelector('.post-signup');

    const storkAnimations = {
      files: [
        {
          type: 'img',
          name: 'design-doc-01.sketch'
        },
        {
          type: 'img',
          name: 'logo_cursief.svg'
        },
        {
          type: 'img',
          name: 'catdog.jpg'
        },
        {
          type: 'doc',
          name: 'assignment-museum.doc'
        },
        {
          type: 'doc',
          name: 'coffee_varieties.pdf'
        },
        {
          type: 'doc',
          name: 'Web Components.pdf'
        },
        {
          type: 'zip',
          name: 'Archive 3.zip'
        },
        {
          type: 'zip',
          name: 'beautiful landscape.zip'
        },
        {
          type: 'zip',
          name: 'LoadsaFiles.zip'
        },
        {
          type: 'dir',
          name: 'assets'
        },
        {
          type: 'dir',
          name: 'pictures'
        },
        {
          type: 'dir',
          name: 'Project files'
        },

      ],
      filesizes: [
        'B',
        'KB',
        'MB'
      ],
      owners: [
        'Murtada',
        'Kaleigh',
        'Gideon',
        'Tamara',
        'Alice',
        'Johan',
        'Tamara'
      ],
    };

    // Create a new element from the row template
    let rowCount = 0;

    function createRow(fileNr, isAnimated) {
      rowCount++;

      const rowFrag = document.importNode(rowTemplate.content, true);

      // We will lose the reference of the appended element when appending with the
      // fragment, so we make a copy
      const rowElement = rowFrag.children[0];

      rowElement.elements = {
        icon: rowElement.querySelector('.stork-animation__table-td--filename .stork__file-icon'),
        filename: rowElement.querySelector('.stork-animation__table-td--filename .stork__file-name'),
        filesize: rowElement.querySelector('.stork-animation__table-td--filesize'),
        owner: rowElement.querySelector('.stork-animation__table-td--owner'),
        date: rowElement.querySelector('.stork-animation__table-td--date')
      };

      const fileSizeUnit = storkAnimations.filesizes[Math.floor(Math.random() * storkAnimations.filesizes.length)];

      const getRandomFileSize = {
        'MB': () => 1 + Math.round((Math.random() * 50) * 100) / 100,
        'KB': () => 1 + Math.round((Math.random() * 1000) * 100) / 100,
        'B': () => Math.round(Math.random() * 1000)
      };

      const fileSize = getRandomFileSize[fileSizeUnit]();

      rowElement.elements.icon.dataset.type = storkAnimations.files[fileNr].type;
      rowElement.elements.filename.innerHTML = storkAnimations.files[fileNr].name;
      rowElement.elements.filesize.innerHTML =  fileSize + ' ' + fileSizeUnit;
      rowElement.elements.owner.innerHTML = storkAnimations.owners[Math.floor(Math.random() * storkAnimations.owners.length)];

      if (rowCount % 2 === 0) {
        rowElement.classList.add('is-alt');
      }

      if (isAnimated) {
        rowElement.classList.add('is-animated');
        setTimeout(() => {
          storkAnimationContent.querySelector('.stork-animation__table-body:last-of-type').remove();
        }, 500);
      }

      const dateOptions = { hour: '2-digit', minute: '2-digit' };
      const now = new Date();
      let lastWeek = new Date();
      lastWeek.setDate(lastWeek.getDate() - 7);

      rowElement.elements.date.innerHTML = (randomDate(lastWeek, now, 8.5, 18)).toLocaleDateString('nl-NL', dateOptions);

      storkAnimationContent.prepend(rowElement);
    }

    for (let i = 0; i < 4; i++) {
      const fileNr = Math.floor(Math.random() * storkAnimations.files.length);
      createRow(fileNr);
    }

    const fileNr = Math.floor(Math.random() * storkAnimations.files.length);

    storkDragDropIcon.dataset.type = storkAnimations.files[fileNr].type;

    setTimeout(() => {
      createRow(fileNr, true);
    }, 1500);

    storkDragDrop.addEventListener('animationiteration', (event) => {
      if (event.animationName === 'dragDrop') {
        const fileNr = Math.floor(Math.random() * storkAnimations.files.length);

        storkDragDropIcon.dataset.type = storkAnimations.files[fileNr].type;

        setTimeout(() => {
          createRow(fileNr, true);
        }, 1500);
      }
    });

    storkForm.addEventListener('submit', event => {
      event.preventDefault();

      const signupEmail = event.target.querySelector('input[name="product_signup_email"]').value;

      sendMail(signupEmail);
    });

    function sendMail(emailAddress) {
      const request = new XMLHttpRequest();

      request.open('POST', '/stork-signup', true);
      request.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
      request.responseType = 'json';

      storkFormFieldset.setAttribute('disabled', true);

      request.send(JSON.stringify({
        email: emailAddress
      }));

      request.onload = () => {
        storkFormFieldset.removeAttribute('disabled');

        if (request.status === 200) {
          const response = request.response;

          if (response.success === true) {
            storkFormPre.setAttribute('hidden', true);
            storkFormPost.removeAttribute('hidden');

            return;
          }
        }

        console.log(request);

        // Should not reach this if successful
        alert('Something went wrong! Please try again.')
      };
    }
  }

  function randomDate(start, end, startHour, endHour) {
    var date = new Date(+start + Math.random() * (end - start));
    var hour = startHour + Math.random() * (endHour - startHour) | 0;
    date.setHours(hour);
    return date;
  }
})();
