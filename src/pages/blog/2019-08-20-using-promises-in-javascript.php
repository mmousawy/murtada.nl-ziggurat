<?php
#zigg:title       = `Using promises & async/await in JavaScript`
#zigg:page-title  = `Using promises & async/await in JavaScript`
#zigg:slug        = `using-promises-and-async-await-in-javascript`
#zigg:type        = `markdown`
#zigg:template    = `./template/blog-post.php`
#zigg:parent      = `blog`
#zigg:cover-image = `blog/_promises{$size}.png`
#zigg:date        = `2019-08-20`
#zigg:description = `Promises in JavaScript are used as a representation of an eventual completion of an asynchronous operation. What are the benefits over traditional methods of asynchronous completion handling and how and when do you use promises?`
?>

JavaScript has always had ways to handle asynchronous operations. You could always use callbacks, eventListeners and as a last resort maybe use `setTimeout`. With the `Promise` object the JavaScript language adds another layer of control to callbacks.

Since [ES2017](https://www.ecma-international.org/ecma-262/8.0/), the `Promise` object and `await` operator have become available. Support for async functions is pretty good: with [over 90% global support](https://caniuse.com/#feat=async-functions), I'd say you should start using these features in your next project.

## Doing it the old fashioned way: events, callbacks and setTimeout
In frontend programming promises are often used for network requests. A very popular type of request is `AJAX` or `XMLHttpRequest`.<br>
In the old days, whenever you needed to wait for the result of an asynchronous operation to finish, you'd better hope the API had an event you could listen to with `addEventListener`. Another way would be to use a callback and trigger it at the end of the event. As a last resort, you could poll the value of a variable at an interval and call a handler when the value has changed.

There is no 'wrong' choice here. Most language features are tools, made for specific cases to solve specific problems. Using the right tool for the right job is a good idea though. Of the old fashioned methods, my preference goes to events and event handling.

### Event demo
<iframe height="290" scrolling="no" title="AJAX (XHR) request with delay" data-src="//codepen.io/doubtingreality/embed/aboBwLx/?height=265&theme-id=light&default-tab=result" frameborder="no" allowtransparency="true" allowfullscreen="true" class="lazy">
  See the Pen <a href='https://codepen.io/doubtingreality/pen/aboBwLx/'>AJAX (XHR) request with delay</a> by Murtada al Mousawy
  (<a href='https://codepen.io/doubtingreality'>@doubtingreality</a>) on <a href='https://codepen.io'>CodePen</a>.
</iframe>

The good thing about events in JavaScript is that you can listen to them and call a function to handle the event. Since we're dealing with asynchronous operations, the events API is a great native solution to the problem of not knowing when to call a handler. Listening to an event binds a function to the event and it gets automatically called when the event dispatches from the source.<br>
There are a ton of built-in events throughout the JavaScript language which is implemented for the browser. From HTML elements like buttons, inputs and images to XMLHttpRequests: they all have plug and play events you can listen for to handle the specific response. Listening to an event can be done after invoking the the request, which makes it great for code you're not able to access.

### Callback demo
<iframe height="265" scrolling="no" title="Example JS callback" data-src="//codepen.io/doubtingreality/embed/ZEzByNP/?height=265&theme-id=light&default-tab=result" frameborder="no" allowtransparency="true" allowfullscreen="true" class="lazy">
  See the Pen <a href='https://codepen.io/doubtingreality/pen/ZEzByNP/'>Example JS callback</a> by Murtada al Mousawy
  (<a href='https://codepen.io/doubtingreality'>@doubtingreality</a>) on <a href='https://codepen.io'>CodePen</a>.
</iframe>

For this demo I'm simulating a delayed response, executing a `callback` when the operation is finished. the A callback is nothing more than a function that gets passed to another function with the purpose of being called by that other function. Writing an API that accepts a callback function as a parameter is really easy, so you'll find this solution in a lot of third-party libraries, plugins and APIs. The downside is that _you_ are going to have to invoke the original function with the callback as a parameter, which in some cases is impossible, since you're not always able to change the original code.

### Timeout demo
<iframe height="310" scrolling="no" title="Example JS setTimeout callback" data-src="//codepen.io/doubtingreality/embed/ExYNvmV/?height=265&theme-id=light&default-tab=result" frameborder="no" allowtransparency="true" allowfullscreen="true" class="lazy">
  See the Pen <a href='https://codepen.io/doubtingreality/pen/ExYNvmV/'>Example JS setTimeout callback</a> by Murtada al Mousawy
  (<a href='https://codepen.io/doubtingreality'>@doubtingreality</a>) on <a href='https://codepen.io'>CodePen</a>.
</iframe>

Here's another demo with a simulated delayed response, this time using `setTimeout` to know when the operation is finished. When you're really in a pinch, the API doesn't provide an event or callback parameter, you could always use a timeout to check the value of the response. When the value changes, run some code to handle the response. Super slow and has a lot of extra delay since we have to set an interval.


## The Promise approach

With `Promise` it becomes simple to implement a callback for an asynchronous operation. The main idea is that a function inside the promise will let the promise object know when its done, be it successfully: `resolve` or erroneously: `reject`.
The resolve and reject handlers can be called within the promise by calling the them respectively.

<figure class="picture-wrapper picture-wrapper--outside">
  <picture class="lazy">
    <source data-srcset="assets/images/blog/_promise_cycle-1024px.png 1024w, assets/images/blog/_promise_cycle-1920px.png 1920w" type="image/png">
    <img data-src="assets/images/blog/_promise_cycle-1920px.png" data-action="zoom" alt="Abstract example of a chained Promise cycle.">
  </picture>
  <figcaption class="picture-wrapper__caption">Abstract example of a chained Promise cycle.</figcaption>
</figure>

A `Promise` can have one of these states at a specific time:

- __Pending__: Initial state of the promise (operation is running)
- __Fulfilled__: Operation completed successfully (also referred to as `resolved`) [i.e. `resolve()`]
- __Rejected__: Operation failed [i.e. `reject()`]

### Creating a promise

A promise is created using `new Promise(executor)`, with a single parameter that will be executed as the body of the promise. Within the promise, you need to use either `resolve` and or `reject` to go to finish the operation a success or failure state. The promise object will become `thenable` and `catchable`, allowing you to use the `.then(value)` and `.catch(value)`.

```javascript
const examplePromise = new Promise((resolve, reject) => {
  /* Here goes your asynchronous operation.
   * Eventually ending in either: */
  resolve(someValue); // fulfilled
  reject(anotherValue); // rejected
});

/* Now call the promise and handle the result */
examplePromise
.then((result) => {
  // Handle the resolve response
})
.catch((result) => {
  // Handle the reject response
});
```

### AJAX/XHR Promise demo

Like the first demo above, I'm going to request an external JSON data point with XHR. This time _promisifying_ the request function so it becomes _thenable_. We can handle the success and failure states outside of the event handlers, making the overall code more concise.

<iframe height="310" scrolling="no" title="XHR with Promise" data-src="//codepen.io/doubtingreality/embed/eYOBaQE/?height=265&theme-id=light&default-tab=result" frameborder="no" allowtransparency="true" allowfullscreen="true" class="lazy">
  See the Pen <a href='https://codepen.io/doubtingreality/pen/eYOBaQE/'>XHR with Promise</a> by Murtada al Mousawy
  (<a href='https://codepen.io/doubtingreality'>@doubtingreality</a>) on <a href='https://codepen.io'>CodePen</a>.
</iframe>


### Chaining promises

One cool thing about promises is that they can be __chained__ together. Because the `then()` and `catch()` methods return promises themselves, you're able to do something like:

```javascript
const loadAsset = (url) => {
  return new Promise((resolve, reject) => {
    // if asset is loaded
    resolve();

    // on error
    reject();
  });
};

loadAsset('script.js')
.then(() => {
  return loadAsset('script2.js');
})
.then(() => {
  return loadAsset('script3.js');
})
.then(() => {
  return loadAsset('script4.js');
});
```

Chaining is a powerful feature of promises. We can use this to load in assets one by one. Here's an example:

<iframe height="600" scrolling="no" title="Promisified image loading" data-src="//codepen.io/doubtingreality/embed/dybOxRN/?height=265&theme-id=light&default-tab=result" frameborder="no" allowtransparency="true" allowfullscreen="true" class="lazy">
  See the Pen <a href='https://codepen.io/doubtingreality/pen/dybOxRN/'>Promisified image loading</a> by Murtada al Mousawy
  (<a href='https://codepen.io/doubtingreality'>@doubtingreality</a>) on <a href='https://codepen.io'>CodePen</a>.
</iframe>

<link href="assets/prism.css" rel="stylesheet" />
<script src="script/lib/prism.js"></script>
<script async src="https://static.codepen.io/assets/embed/ei.js"></script>


### Handling multiple separate promises

Imagine having multiple asynchronous operations how can we be be sure they're all completed without chaining them? So you don't want to wait for each promise to be done, but do want to know when they're all finished. A handy little method exists for this specific case: `Promise.all()`.<br>
The method returns a single promise that resolves when all promises are successfully completed (fulfilled), and rejects when the first rejection is encountered. The first parameter it expects should be an `iterable` (i.e. array) with the references to the promises.

```javascript
const promise1 = Promise.resolve(3);
const promise2 = 42;
const promise3 = new Promise((resolve, reject) => {
  setTimeout(resolve, 200, 'I am done!')
});

Promise.all([promise1, promise2, promise3]).then(function(values) {
  console.log(values);
});
```

The good thing is that the responses are always returned in the same order as the promises were provided in the iterable object. With this method it becomes a lot easier to know when all of the asynchronous operations are finished.

### Drawbacks of Promises

One thing you'll notice is that using promises can make your code a bit obfuscated. Something like the term _callback hell_ comes to mind, where your code is an entangled mess of functions.


## Another layer: async & await

The `async` function declaration and the `await` expression are here to make things easier. Where using a `Promise` would make your code less readable, the async and await syntax make it clear and even more concise that you are dealing with asynchronous operations.

Just like using `new Promise()` you can declare a function to be a promise by doing:

```javascript
async function exampleFunction() {
  return 1;
}
```

In this example, `exampleFunction` is now a promise!

You can now use `.then()` to handle the fulfilled state, but there's an alternative: `await`.<br>
This expression lets JavaScript know that the value will be resolved from a promise and will wait for the promise to settle to continue the expression. In the meantime the engine can still run other code and won't require extra CPU resources to handle the await expression.

__Note that `await` only works in `async` functions__.

Here's a demo of using async and await in an actual case:

<iframe height="600" scrolling="no" title="Fetch random user with async &amp; await" data-src="//codepen.io/doubtingreality/embed/yLBgYxj/?height=265&theme-id=light&default-tab=result" frameborder="no" allowtransparency="true" allowfullscreen="true" class="lazy">
  See the Pen <a href='https://codepen.io/doubtingreality/pen/yLBgYxj/'>Fetch random user with async &amp; await</a> by Murtada al Mousawy
  (<a href='https://codepen.io/doubtingreality'>@doubtingreality</a>) on <a href='https://codepen.io'>CodePen</a>.
</iframe>


## Final thoughts

There are situations to use callbacks instead of promises in Javascript. Always try to use the right tool for the right job. Promises are not an alternative to callbacks - they actually employ callbacks to have more control over asynchronous operations.

__Callbacks can be called multiple times and have no inherent state.__ Callbacks can be both asynchronous and synchronous, depending on how they are used. Callbacks are great for interaction events and generally anything that will call the callback multiple times in the same way.

Unlike a callback, __a `Promise` is inherently asynchronous__. Promises have distinct states and methods (`then()` and `catch()`) that you can use to handle either the fulfilled (`resolve()`) or failed (`reject()`) state. Promises can be chained by returning another promise at the fulfilled state. A good use case for promises are AJAX/XHR calls and load events.

With `async` and `await` you can take promises to the next level and declare promisified functions (i.e. `async function x()`) that can have asynchronous operations inside (i.e. `await loadAsset()`). The engine will stop executing the async function until the await expression has been resolved. This syntax provides you the ability to run the code _synchronously_ in the modern JavaScript language.

Read more about [promises](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise), [async](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/async_function) and [await](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/await) on MDN.
