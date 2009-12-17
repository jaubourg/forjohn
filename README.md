Test regarding John Resig's current (12/17/09) implementation of jQuery.require
================================

Structure of the test:
-----------------------
* 5 javascript files (module[1-4].js & failing-module.js) are loaded (script tags in the html code)
* each of them depends on 1 service (a php script delivering javascript)
* thus, each moduleX.js file depends on a corresponding serviceX.php service
* and failing-module.js depends on failing-service.php which will always return a 400 HTTP STATUS
* each serviceX.php service declares a transformX function that performs modification in the DOM below #containerX (html body)
* each moduleX.js calls the corresponding transformX function
* to emulate low bandwidth, serviceX.php files stall for 1 to 5 seconds (random)
* failing-service.php stalls for 10 to 20 seconds (that being consistent with service providers generally taking more time to answer when an error arises)
* a piece of code is embedded into the html page which will turn the body background from grey to white when the ready event is fired

In order to be able to make this test, the content of jQuery.require.urlFilter has been commented out, so that it does not break the urls given to jQuery.require.

Test cases:
------------
3 test cases are provided:
* A) jQuery.getScript + jQuery.ready based (see common-getscript.js)
* B) jQuery.require based (see common-require.js)
* C) jQuery.require based WITHOUT failing-module.js being requested

Behaviour:
-----------
A)
* the body background is immediately set to white
* #containerX blocks get updated as serviceX.php are loaded (including the possibility to interact with them)
* failing-module.js doesn't cause any trouble

B)
* the body background is NEVER set to white
* No #containerX block gets updated even if its corresponding serviceX.php has been received
* failing-module.js prevents any code to be executed on the page

C)
* the body background is not set to white immediately
* #containerX blocks are not updated as serviceX.php are loaded
* once ALL of the serviceX.php files are loaded, the ready event is fired and all the blocks updated

Conclusion:
------------
Current implementation of jQuery.require:
* makes all dom-manipulation code dependant on all files by blocking the ready event (even code that does not depend on any external resource)
* forbids any progressive "rendering" (ie: dom transformation)
* prevents all dom-manipulation code from being executed if a SINGLE request fails

As it is today, jQuery.require is a step backward regarding javascript modularity and progressive page enhancement.

While today's trend is about widgets and independant modules, ALL CODE making use of jQuery.ready will get blocked by any plugin making use of jQuery.require.
If it stays as it is, when nobody knows what piece of code will be used together with his own, plugin developpers will go back to hacks in order to get around jQuery.ready
and it will get de-facto deprecated.

I completely disagree with how jQuery.require is being implemented at the moment.
The need for a synchronized multiple script loading system is a given but I still strongly believe stalling the ready event is NOT the solution.