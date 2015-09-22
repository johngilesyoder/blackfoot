(function ($, root, undefined) {
  
  $(function () {
    
    'use strict';
    
    // DOM ready, take it away

    $('#hero-logo').addClass('test');

    // init controller
    var controllerParallax = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "onEnter", duration: "200%"}});
    var controllerIcon = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "0.4", duration: "200%"}});
    var controllerCounter = new ScrollMagic.Controller({globalSceneOptions: {duration: "200%"}});
    var controllerBubble = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: ".8", duration: "200%"}});

    var counterOptions = {
      useEasing : true, 
      useGrouping : true, 
      separator : ',', 
      decimal : '.', 
      prefix : '$', 
      suffix : '' 
    };
    var counter = new CountUp("counter-number", 0, 1000000, 0, 1.5, counterOptions);

    // Counter Function
    function counterStart (e) {
      counter.start();
    }


    // build scenes
    new ScrollMagic.Scene({triggerElement: "#parallax-main"})
      .setTween("#parallax-main .hero-bg", {y: "30%", ease: Linear.easeNone})
      //.addIndicators()
      .addTo(controllerParallax);

    new ScrollMagic.Scene({triggerElement: "#parallax-location"})
      .setTween("#parallax-location .hero-bg", {y: "30%", ease: Linear.easeNone})
      //.addIndicators()
      .addTo(controllerParallax);

    new ScrollMagic.Scene({triggerElement: "#parallax-adventures"})
      .setTween("#parallax-adventures .hero-bg", {y: "30%", ease: Linear.easeNone})
      //.addIndicators()
      .addTo(controllerParallax);

    new ScrollMagic.Scene({triggerElement: "#parallax-business"})
      .setTween("#parallax-business .hero-bg", {y: "30%", ease: Linear.easeNone})
      //.addIndicators()
      .addTo(controllerParallax);

    new ScrollMagic.Scene({triggerElement: "#parallax-ecology"})
      .setTween("#parallax-ecology .hero-bg", {y: "30%", ease: Linear.easeNone})
      //.addIndicators()
      .addTo(controllerParallax);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-location"})
      // trigger animation by adding a css class
      .setClassToggle("#icon-location", "zap")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-location"})
      // trigger animation by adding a css class
      .setClassToggle("#title-location", "blur-out")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-adventures"})
      // trigger animation by adding a css class
      .setClassToggle("#icon-adventures", "zap")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-adventures"})
      // trigger animation by adding a css class
      .setClassToggle("#title-adventures", "blur-out")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-business"})
      // trigger animation by adding a css class
      .setClassToggle("#icon-business", "zap")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-business"})
      // trigger animation by adding a css class
      .setClassToggle("#title-business", "blur-out")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-ecology"})
      // trigger animation by adding a css class
      .setClassToggle("#icon-ecology", "zap")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // build scene
    var scene = new ScrollMagic.Scene({triggerElement: "#parallax-ecology"})
      // trigger animation by adding a css class
      .setClassToggle("#title-ecology", "blur-out")
      //.addIndicators({name: "1 - add a class"}) // add indicators (requires plugin)
      .addTo(controllerIcon);

    // COUNTER
    new ScrollMagic.Scene({triggerElement: "#counter-number"})
      .on("enter", counterStart)
      .addTo(controllerCounter);

    // BUBBLES
    var scene = new ScrollMagic.Scene({triggerElement: "#bubbles"})
      // trigger animation by adding a css class
      .setClassToggle("#bubble-small", "roll")
      .addTo(controllerBubble);

    var scene = new ScrollMagic.Scene({triggerElement: "#bubbles"})
      // trigger animation by adding a css class
      .setClassToggle("#bubble-large", "roll")
      .addTo(controllerBubble);

  });
  
})(jQuery, this);
