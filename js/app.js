const navHtml = '<nav class="nav"><ul class="nav-ul clearfix"><li class="nav-li"><a href="#top" class="nav-a">Start</a></li><li class="nav-li"><a href="#about" class="nav-a">O projekcie</a></li><li class="nav-li"><a href="#team" class="nav-a">Zespół</a></li><li class="nav-li"><a href="#transmission" class="nav-a important">Transmisja</a></li><li class="nav-li"><a href="https://zrzutka.pl/8amf3y" rel="noopener" class="nav-a" target="_blank">Wesprzyj</a></li><li class="nav-li"><a href="#contact" class="nav-a">Kontakt</a></li></ul></nav>';

const navMobile = document.querySelector("#nav-mobile");
const nav = document.getElementById("nav");
function navResize(x) {
  if (x.matches) { // If media query matches
    navMobile.innerHTML = navHtml;
    nav.innerHTML = '';
  } else {
    navMobile.innerHTML = '';
    nav.innerHTML = navHtml;
  }
}

var x = window.matchMedia("(max-width: 935px)");
navResize(x); // Call listener function at run time
x.addListener(navResize); // Attach listener function on state changes


initSmoothScrolling();

function initSmoothScrolling() {

  var duration = 400;

  var pageUrl = location.hash ?
    stripHash(location.href) :
    location.href;

  delegatedLinkHijacking();

  function delegatedLinkHijacking() {
    document.body.addEventListener('click', onClick, false);

    function onClick(e) {
      if (!isInPageLink(e.target))
        return;

      e.stopPropagation();
      e.preventDefault();

      jump(e.target.hash, {
        duration: duration,
        callback: function () {}
      });
    }
  }

  function isInPageLink(n) {
    return n.tagName.toLowerCase() === 'a' &&
      n.hash.length > 0 &&
      stripHash(n.href) === pageUrl;
  }

  function stripHash(url) {
    return url.slice(0, url.lastIndexOf('#'));
  }
}

function jump(target, options) {
  var
    start = window.pageYOffset,
    opt = {
      duration: options.duration,
      offset: options.offset || 0,
      callback: options.callback,
      easing: options.easing || easeInOutQuad
    },
    distance = typeof target === 'string' ?
    opt.offset + document.querySelector(target).getBoundingClientRect().top :
    target,
    duration = typeof opt.duration === 'function' ?
    opt.duration(distance) :
    opt.duration,
    timeStart, timeElapsed;

  requestAnimationFrame(function (time) {
    timeStart = time;
    loop(time);
  });

  function loop(time) {
    timeElapsed = time - timeStart;

    window.scrollTo(0, opt.easing(timeElapsed, start, distance, duration));

    if (timeElapsed < duration)
      requestAnimationFrame(loop)
    else
      end();
  }

  function end() {
    window.scrollTo(0, start + distance);

    if (typeof opt.callback === 'function')
      opt.callback();
  }

  // Robert Penner's easeInOutQuad - http://robertpenner.com/easing/
  function easeInOutQuad(t, b, c, d) {
    t /= d / 2
    if (t < 1) return c / 2 * t * t + b
    t--
    return -c / 2 * (t * (t - 2) - 1) + b
  }

}
