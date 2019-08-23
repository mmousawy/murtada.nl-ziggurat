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
      header.classList.add('is-stuck');
      navBackground.style.animationName = 'slideInBackground';
      contentOverlay.classList.add('is-visible');
      document.documentElement.classList.add('no-scroll');
      menuIsOpen = true;
    } else {
      nav.style.transitionDelay = '0ms';
      contentOverlay.style.transitionDelay = '100ms';
      nav.classList.remove('is-open');
      contentOverlay.classList.remove('is-visible');
      document.documentElement.classList.remove('no-scroll');
      menuIsOpen = false;

      if (scrollY === 0) {
        header.classList.remove('is-stuck');
      }

      setTimeout(() => {
        navBackground.style.animationName = 'none';
      }, 300);
    }
  };

  navButton.addEventListener('change', navButtonHandler);

  window.addEventListener('resize', resizeHandler);

  window.addEventListener('scroll', throttleScroll, { passive: true });

  let debounceTimer;
  let debounceTimeOut = 150;
  let throttleTimeOut = 100;
  let prev = 0;

  function throttleScroll() {
    requestAnimationFrame(now => {
      if (now - prev > throttleTimeOut) {
        scrollHandler();

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(scrollHandler, debounceTimeOut);

        prev = now;
      }
    });
  }

  [].slice.call(document.querySelectorAll('.page-header a')).forEach(navItem => {
    navItem.addEventListener('focus', (event) => {
      header.classList.remove('is-hidden');
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
  function scrollHandler() {
    scrollY = Math.max(0, window.scrollY ? window.scrollY : document.documentElement.scrollTop);

    const scrollDelta = prevScrollY - scrollY;

    if (scrollDelta < -15) {
      // Scrolling down
      if (scrollY > headerHeight * 1.5) {
        header.classList.add('is-hidden');
      }
    } else if (scrollDelta > 15) {
      // Scrolling up
      if (scrollY > headerHeight * 1.5) {
        if (!header.classList.contains('is-stuck')) {
          header.classList.add('is-stuck');
        }
        header.classList.remove('is-hidden');
      }
    }

    if (scrollY < 1) {
      header.classList.remove('is-stuck');
      header.classList.remove('is-hidden');
    }

    prevScrollY = scrollY;
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
    var lazyElements = [].slice.call(document.querySelectorAll('picture.lazy, iframe.lazy'));

    if ('IntersectionObserver' in window) {
      let lazyElementObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            if (entry.target.nodeName === 'PICTURE') {
              entry.target.querySelectorAll('source[data-srcset], img[data-src]').forEach(lazyElementSource => {
                const loadImg = new Image();

                const isSrcSet = typeof lazyElementSource.dataset.srcset !== 'undefined';

                loadImg.onload = () => {
                  if (isSrcSet) {
                    lazyElementSource.srcset = loadImg.srcset;
                  } else {
                    lazyElementSource.src = loadImg.src;
                  }

                  entry.target.classList.remove('lazy');
                }

                if (isSrcSet) {
                  loadImg.srcset = lazyElementSource.dataset.srcset;
                } else {
                  loadImg.src = lazyElementSource.dataset.src;
                }
              });
            } else if (entry.target.nodeName === 'IFRAME') {
              entry.target.src = entry.target.dataset.src;
            }

            lazyElementObserver.unobserve(entry.target);
          }
        });
      });

      lazyElements.forEach(function(lazyElement) {
        lazyElementObserver.observe(lazyElement);
      });

    } else {
      lazyElements.forEach(function(lazyElement) {
        [].slice.call(lazyElement.querySelectorAll('source[data-srcset], img[data-src]')).forEach(elementSource => {
          elementSource.dataset.src && (elementSource.src = elementSource.dataset.src);
          elementSource.dataset.srcset && (elementSource.srcset = elementSource.dataset.srcset);
          delete elementSource.dataset;
        });
        lazyElement.classList.remove('lazy');
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
  scrollHandler();

  if (document.querySelector('.stork-animation')) {
    const storkAnimationContent = document.querySelector('.stork-animation__table-content');
    const storkDragDrop = document.querySelector('.stork__drag-drop');
    const storkDragDropIcon = storkDragDrop.querySelector('.stork__icon');
    const rowTemplate = document.querySelector('#stork-animation__row-template');

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
        'Akira',
        'Nora',
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
  }

  function randomDate(start, end, startHour, endHour) {
    var date = new Date(+start + Math.random() * (end - start));
    var hour = startHour + Math.random() * (endHour - startHour) | 0;
    date.setHours(hour);
    return date;
  }

  const newsletterForm = document.querySelector('#newsletter-form');

  if (!newsletterForm) {
    return;
  }

  const newsletterFormFieldset = newsletterForm.querySelector('fieldset');
  const newsletterFormPre = newsletterForm.querySelector('.pre-signup');
  const newsletterFormPost = newsletterForm.querySelector('.post-signup');

  newsletterForm.addEventListener('submit', event => {
    event.preventDefault();

    const signupEmail = event.target.querySelector('input[name="product_signup_email"]').value;

    sendMail(signupEmail);
  });

  function sendMail(emailAddress) {
    const request = new XMLHttpRequest();

    request.open('POST', '/newsletter-signup', true);
    request.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
    request.responseType = 'json';

    newsletterFormFieldset.setAttribute('disabled', true);

    request.send(JSON.stringify({
      email: emailAddress
    }));

    request.onload = () => {
      newsletterFormFieldset.removeAttribute('disabled');

      if (request.status === 200) {
        const response = request.response;

        if (response.success === true) {
          newsletterFormPre.setAttribute('hidden', true);
          newsletterFormPost.removeAttribute('hidden');

          return;
        }
      }

      console.log(request);

      // Should not reach this if successful
      alert('Something went wrong! Please try again.')
    };
  }

  document.querySelector("#purchase-stork").addEventListener('submit', event => {
    const request = new XMLHttpRequest();

    request.open('POST', '/products/stork/checkout', true);

    newsletterFormFieldset.setAttribute('disabled', true);

    request.send(new FormData(event.target));

    request.onload = () => {
      if (request.status === 200) {
        const response = JSON.parse(request.response);

        if (response.success === true && response.data.status === 'open') {
          document.location.href = response.data._links.checkout.href;
          return;
        }
      }

      // Should not reach this if successful
      alert('Something went wrong! Please try again.')
    };

    event.preventDefault();
  });
})();
