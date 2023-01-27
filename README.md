# FAQ-Shortcodes
FAQ Shortcodes for Wordpress. 

### Description 
Shortocode that generates a list of Custom Post Types with a FAQ Schema Markup as described in the official Google Search Central Documentation:  https://developers.google.com/search/docs/appearance/structured-data/faqpage

### How to use it

The shortcode format is the below: 

[faq_generate post='' number='' heading='' accordion='']

where attributes mean

* post -> the slug of any post type you want to display (ex. 'post' || 'faq')
* number -> the number of posts you want to display
* heading -> The HTML Heading of the Question (h1, h2, h3 etc)
* accordion -> Whether you want to display your FAQ as accordion or just plain Question and answer. (It can take values of 1 or 0)

The default attributes' values are: 

[faq_generate post='post' number='5' heading='h3' accordion='0']

That means that you can use any of the attributes you want or none of them (just [faq_generate])
