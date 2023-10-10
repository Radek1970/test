Wyzz WYSIWYG Editor

(c) The Mouse Whisperer 2007


VERSION
=======
v0.4


LICENCE
=======
This software is licenced under the LGPL, a copy of which is in the download package.
Please leave all copyright notices and links intact.


INSTALLATION
============
1. Unzip everything to somewhere convenient, maintaining the directory structure.
2. Upload to your website so that wyzz.js is in the same directory as your form.
3. Place the following line in the <head> area of the page containing your form:

   <script language="JavaScript" type="text/javascript" src="wyzz.js"></script>
   
4. After the textarea you want to Wyzzify, place a small script like this:

  <textarea name="textfield" id="textfield" rows="10" cols="40"></textarea><br />
  <script language="javascript1.2">
    make_wyzz('textfield');
  </script>
  
  Make sure that the argument of the make_wyzz() function matches the ID of the textarea.
  

MODIFICATION
============
Modify the Width and Height parameters near the start of the wyzz.js file to suit your application.
Modify the 'Edit Region Styles' to match the page to be edited.
Modify the entries in the buttonName array to amend the available toolar buttons and their order.


WARRANTY
========
None! This is free software, and it is up to you to verify its fitness for your purpose.
The author will not be held responsible for any loss or damage caused by the use of
any software in this package.
  
That's it! There's a forum on the site where you can ask any questions ...