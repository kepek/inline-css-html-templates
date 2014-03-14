## Inline CSS &amp; HTML Templates

Every good Front-end developer know well that CSS created for Newsletter Template should be written inline for each HTML element.

Not anymore! This simple tool will help you creating Newsletter Templates with popular technologies like: HTML, Twig, JSON &amp; LESS.

- Yes, you can use all the benefits of Twig (includes, blocks, filters, etc!).
- Yes, you can speed up your work by using the benefits of LESS!
- Yes, you can define your content in JSON file for each template separately!
- Yes, you can use "Debug" mode. It means: Clean code. It will help you Inspect DOM elements in Browsers.

The thing is that you can finally split your LESS/CSS and HTML into separated files.

Tool will automatically convert everything to one file.

Yes! It's not a mistake! CSS will be added as inline styles to each element you specified in your Stylesheet.

Sounds good, right? Try it! :-)

TL;DR
----------

Tool which will help you creating inline CSS &amp HTML templates much much quicker!

Installing
----------

#### With Git
Navigate to your Terminal.app and go to Sites directory:

	cd ~/Sites/

And clone the repo to a new directory right then and there:

	git clone git@github.com/kepek/inline-css-html-templates.git

#### Manually
* Download the .zip file from the GitHub downloads modal
* Unzip the files and rename the folder to "inline-css"
* Copy the folder to your Sites directory:
	- `(~/Sites/)`

Bugs &amp; Additions
----------------

Have a bug or want to add something? Please create an issue or a pull request right here.

Usage
------------

Install all required [Composer](https://getcomposer.org/) packages.

When you don't have Composer installed yet, do this:

	curl -sS https://getcomposer.org/installer | php
	php composer.phar install

When you already have a Composer, do this:

	composer install

Visit your website (for example):

	http://127.0.0.1/inline-css/

Check our Basic template:

	http://127.0.0.1/inline-css/templates/basic.html

Check our Basic template in Debug mode:

	http://127.0.0.1/inline-css/templates/basic.html?debug=true

Template Structure
------------

	my-template.html
	my-template.less
	my-template.json

Resources (Thanks!)
----------
* [getcomposer.org](https://getcomposer.org/)
* [twig.sensiolabs.org](http://twig.sensiolabs.org/)
* [github.com/zaininnari/html-minifier](https://github.com/zaininnari/html-minifier)
* [github.com/tijsverkoyen/CssToInlineStyles](https://github.com/tijsverkoyen/CssToInlineStyles)
* [leafo.net/lessphp](https://leafo.net/lessphp/)

Contact
------------
[michal@kechner.name](mailto:michal@kechner.name)
