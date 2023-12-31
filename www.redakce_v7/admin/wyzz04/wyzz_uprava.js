// WYZZ Copyright (c) 2007 The Mouse Whisperer
// Contains code Copyright (c) 2006 openWebWare.com
// This copyright notice MUST stay intact for use.
//
// An open source WYSIWYG editor for use in web based applications.
// For full source code and docs, visit http://www.wyzz.info
//
// This library is free software; you can redistribute it and/or modify 
// it under the terms of the GNU Lesser General Public License as published 
// by the Free Software Foundation; either version 2.1 of the License, or 
// (at your option) any later version.
//
// This library is distributed in the hope that it will be useful, but 
// WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
// or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public 
// License for more details.
//
// You should have received a copy of the GNU Lesser General Public License along 
// with this library; if not, write to the Free Software Foundation, Inc., 59 
// Temple Place, Suite 330, Boston, MA 02111-1307 USA 

// Editor Width and Height
wyzzW = 670;
wyzzH = 250;

// Edit region styles
editorFontFamily = "verdana";
editorFontSize = "12px";
editorFontColor = "#666666";
editorBackground = "#ffffff";

version = "0.4";

// Mode wysiwyg = 1 or sourcecode = 0
mode = 1;

// Style Sheet
document.write('<link rel="stylesheet" type="text/css" href="wyzz04/wyzzstyles/style.css">\n');

// Order of available commands in toolbar
// Remove from this any buttons not required in your application
// prvni pulka
var buttonName = new Array("bold","italic","underline","strikethrough","separator","cut","copy","paste","separator","forecolor","backcolor","separator","subscript","superscript","separator","justifyleft","justifycenter","justifyright","indent","outdent","separator");

//preklad do cestiny pro pouziti title
var buttonNameCZ = new Array("tu�n�","italic","podtr�en�","p�e�krtnut�","separator","vyjmout","copy","paste","separator","barva p�sma","barva pozad�","separator","doln� index","horn� index","separator","zarovnat vlevo","zarovnat na st�ed","zarovnat do prava","indent","outdent","separator");

var buttonName2CZ = new Array("seznam odr�ky","seznam ��sla","p�smo zoom plus","p�smo zoom m�nus","odkaz","zp�t","vp�ed","separator","html k�d","separator","pomoc");


//druha pulka
var buttonName2 = new Array("insertunorderedlist","insertorderedlist","upsize","downsize","link","undo","redo","separator","htmlmode","separator","help");
//"insertimage",
//vyjmuto z var buttonName2






// Color picker - here we make an array of all websafe colors
// If you want to limit the colors available to users (e.g. to fit in with
// a site design) then use a restricted array of colors
// e.g. var buttonName = new Array("336699","66abff", .... etc

var buttonColors = new Array(216);

// Colors - replace this function with your own if you have special requirements for colors
function getColorArray() {
// Color code table 
c = new Array('00', '33', '66', '99', 'cc', 'ff'); 
var count = 0;
// Iterate red
for (r = 0; r < 6; r++) 
  { 
    // Iterate green
    for (g = 0; g < 6; g++) 
      { 
        // Iterate blue
        for (b = 0; b < 6; b++) 
          { 
            // Get RGB color
            buttonColors[count] = c[r] + c[g] + c[b]; 
            count++;
          } 
      } 
  }
}

getColorArray();
	
/* Emulates insertAdjacentHTML(), insertAdjacentText() and insertAdjacentElement() three functions 
so they work with Netscape 6/Mozilla - By Thor Larholm me@jscript.dk */
if(typeof HTMLElement!="undefined" && !HTMLElement.prototype.insertAdjacentElement) {
        HTMLElement.prototype.insertAdjacentElement = function (where,parsedNode) {
        switch (where) {
        case 'beforeBegin':
          this.parentNode.insertBefore(parsedNode,this)
          break;
        case 'afterBegin':
          this.insertBefore(parsedNode,this.firstChild);
          break;
        case 'beforeEnd':
          this.appendChild(parsedNode);
          break;
        case 'afterEnd':
          if (this.nextSibling) {
              this.parentNode.insertBefore(parsedNode,this.nextSibling);
            } else {
              this.parentNode.appendChild(parsedNode);
              break;
            }
          }
	}

	HTMLElement.prototype.insertAdjacentHTML = function (where,htmlStr) {
          var r = this.ownerDocument.createRange();
          r.setStartBefore(this);
          var parsedHTML = r.createContextualFragment(htmlStr);
          this.insertAdjacentElement(where,parsedHTML)
	}

	HTMLElement.prototype.insertAdjacentText = function (where,txtStr) {
          var parsedText = document.createTextNode(txtStr)
          this.insertAdjacentElement(where,parsedText)
	}
}

function closeColorPicker(thisid) {
  document.getElementById(thisid).style.display = "none";
}

// the hyperlink dialog
  function insertLink(n) {
    var newWindow = '';
    var linkurl = '';
    var linktitle = '';
    var targetText = grabSelectedText(n);
    var linkurl = prompt('Enter the target URL of the link:');
    var linktitle = prompt('Please give a title for the link:');
    var openNew = confirm('Should this link open in a new window?\n\nOK = Open in NEW Window\nCancel = Open in THIS window');
    if(openNew)     {
      newWindow = "blank";
      } else {
      newWindow = "self";
    }    
    if(newWindow==''||linkurl==''||linktitle=='') {
      alert('Please enter all the required information.');
      insertLink(n);
      } else {
      var hyperLink = '<a href="' + linkurl + '" target="_' + newWindow + '" title="' + linktitle + '">' + targetText + '</a>';
      insertHTML(hyperLink, n);
      }
  }
  
  function insertImage(n) {
    var imgurl = prompt('Enter the target URL of the image:');
    var imgtitle = prompt('Please give a title for the link:');
    var theImage = '<img src="' + imgurl + '" title="' + imgtitle + '" />';
    insertHTML(theImage, n);  }

function make_wyzz(textareaID) {
  
  // Hide the textarea 
  document.getElementById(textareaID).style.display = 'none'; 
	
  // get textareaID
  var n = textareaID;
	
  // Toolbars width is 2 pixels wider than the editor
  toolbarWidth = parseFloat(wyzzW) + 2;
	
  // Generate WYSIWYG toolbar
  var toolbar =  '<table cellpadding="0" cellspacing="0" border="0" class="toolbar" style="width:' + toolbarWidth + 'px;"><tr>';
  
  // Output buttons for toolbar prvni pulka
  var colNumbers = 0;
  for (btn in buttonName) {
    colNumbers ++;
    if(buttonName[btn] == "separator") {
      toolbar += '';
      } 
      
      else {
      toolbar += '<td style="width: 22px;"><img src="wyzz04/wyzzicons/' +buttonName[btn]+ '.gif" border=0 unselectable="on" title="' +buttonNameCZ[btn]+ '" id="' +buttonName[btn]+ '" class="button" onClick="formatText(this.id,\'' + n + '\');" onmouseover="if(className==\'button\'){className=\'buttonOver\'};" onmouseout="if(className==\'buttonOver\'){className=\'button\'};" unselectable="on" width="20" height="20"></td>';
      
      
      }
  }
  toolbar += '<td>&nbsp;</td></tr>';


// Output buttons for toolbar druha pulka
  var colNumbers = 0;
  for (btn in buttonName2) {
    colNumbers ++;
    if(buttonName2[btn] == "separator") {
      toolbar += '<td class="separator">&nbsp;</td>';
      } 
      
      else {
      toolbar += '<td style="width: 22px;"><img src="wyzz04/wyzzicons/' +buttonName2[btn]+ '.gif" border=0 unselectable="on" title="' +buttonName2CZ[btn]+ '" id="' +buttonName2[btn]+ '" class="button" onClick="formatText(this.id,\'' + n + '\');" onmouseover="if(className==\'button\'){className=\'buttonOver\'};" onmouseout="if(className==\'buttonOver\'){className=\'button\'};" unselectable="on" width="20" height="20"></td>';
      
      
      }
  }
  toolbar += '<td>&nbsp;</td></tr>';
//////////////////////////////////////////////

// the foreground color picker
  var swatchcount = 0;
  toolbar += '<tr><td colspan=' + colNumbers + '>';
  
  toolbar += '<div id="colorpicker" style="display:none">';
	for (clr in buttonColors) {
		  toolbar += '<a href="#" class="colorButton" onClick="formatTextColor(\'' + buttonColors[clr] + '\',\'' + n + '\');" style="background: #' + buttonColors[clr] + '">&nbsp;</a>';
                  swatchcount++;
                  if(swatchcount%18==0) {
                    toolbar += '<br>';
                  }
	}
  toolbar += '<img class="closebutton" src="wyzzicons/close.gif" border=0 onclick="closeColorPicker(\'colorpicker\')"></div>';
  
// the background color picker
toolbar += '<div id="colorbackpicker" style="display:none">';
	for (clr in buttonColors) {
		  toolbar += '<a href="#" class="colorButton" onClick="formatBackColor(\'' + buttonColors[clr] + '\',\'' + n + '\');" style="background: #' + buttonColors[clr] + '">&nbsp;</a>';
                  swatchcount++;
                  if(swatchcount%18==0) {
                    toolbar += '<br>';
                  }
	}
  toolbar += '<img class="closebutton" src="wyzzicons/close.gif" border=0 onclick="closeColorPicker(\'colorbackpicker\')"></div>'; 
  
// link picker
  toolbar += '<div id="linkdialog" style="display:none">';
  toolbar += 'URL: <input type="text" name="url" id="linkUrl"><br>Title: <input type="text" name="linkTitle" id="linkTitle"><br>Open in New Window: <input type="checkbox" name="linkLocation" id="linkLocation" value="blank"><br><input type="button" value="Add Link" onclick="insertLink(\'' + n + '\')"><br><br>';
  toolbar += '<img class="closebutton" src="wyzzicons/close.gif" border=0 onclick="closeColorPicker(\'linkdialog\')"></div>'; 

// The help/about box
// The copyright and link must remain unaltered
  toolbar += '<div id="helpbox" style="display:none">';
  toolbar += '<div class="help"><h4>Wyzz v' + version + '</h4><br>&copy; 2007 <a href="http://www.wyzz.info" target=_blank>www.wyzz.info</a><br><br></div>';
  toolbar += '<img class="closebutton" src="wyzzicons/close.gif" border=0 onclick="closeColorPicker(\'helpbox\')"></div></td></tr></table>';   

// Create iframe for editor
var iframe = '<table cellpadding="0" cellspacing="0" border="0" style="width:' + wyzzW + 'px; height:' + wyzzH + 'px;border: 1px inset #dddddd;"><tr><td valign="top">\n'
  + '<iframe frameborder="0" id="wysiwyg' + n + '"></iframe>\n'
  + '</td></tr></table>\n';
  
  // Insert toolbar after the textArea
  document.getElementById(n).insertAdjacentHTML("afterEnd", toolbar + iframe);
	
  // Give the iframe the required height and width
  document.getElementById("wysiwyg" + n).style.height = wyzzH + "px";
  document.getElementById("wysiwyg" + n).style.width = wyzzW + "px";
	
  // Pass the textarea's existing text into the editor
  var content = document.getElementById(n).value;
  var doc = document.getElementById("wysiwyg" + n).contentWindow.document;
	
  // Write the textarea's content into the iframe
  doc.open();
  doc.write(content); 
  doc.close();

  var browserName = navigator.appName;
  if (browserName == "Microsoft Internet Explorer") {    
    doc.body.style.fontFamily 	= editorFontFamily;
    doc.body.style.fontSize 	= editorFontSize;
    doc.body.style.color          = editorFontColor;
    doc.body.style.background 	= editorBackground;
    // Make the iframe editable
    doc.body.contentEditable = true;
  } else {
    // Make the iframe editable
    doc.designMode = "on";  
    // Lets style the editor area
    doc.body.style.fontFamily 	= editorFontFamily;
    doc.body.style.fontSize 	= editorFontSize;
    doc.body.style.color          = editorFontColor;
    doc.body.style.background 	= editorBackground;
  }
	
  // Update the textarea with content in WYSIWYG when user submits form
  var browserName = navigator.appName;
  if (browserName == "Microsoft Internet Explorer") {
    for (var idx=0; idx < document.forms.length; idx++) {
      document.forms[idx].attachEvent('onsubmit', function() { updateTextArea(n); });
    }
  }
  else {
  	for (var idx=0; idx < document.forms.length; idx++) {
    	document.forms[idx].addEventListener('submit',function OnSumbmit() { updateTextArea(n); }, true);
    }
  }
}

function formatTextColor(color, n, selected) {
  document.getElementById('wysiwyg' + n).contentWindow.document.execCommand('forecolor', false, color);
  document.getElementById('colorpicker').style.display = "none";		
}

function formatBackColor(color, n, selected) {
  document.getElementById('wysiwyg' + n).contentWindow.document.execCommand('backcolor', false, color);
  document.getElementById('colorbackpicker').style.display = "none";	
}

function formatText(id, n, selected) {
  // When user clicks button make sure it always targets correct textarea
  document.getElementById("wysiwyg" + n).contentWindow.focus();	
  if(id=="upsize") {
    var currentFontSize = document.getElementById("wysiwyg"+n).contentWindow.document.queryCommandValue("FontSize");
    if(currentFontSize == '') currentFontSize = 3; // fudge for FF
    if(currentFontSize < 7) {
      var newFontSize = parseInt(currentFontSize) + 1;
      } else {
      var newFontSize = currentFontSize;
      }
      document.getElementById("wysiwyg" + n).contentWindow.document.execCommand("FontSize", false, newFontSize);
    }
  else if(id=="downsize") {
    var currentFontSize = document.getElementById("wysiwyg"+n).contentWindow.document.queryCommandValue("FontSize");
    if(currentFontSize > 1) {
      var newFontSize = currentFontSize - 1;
      } else {
      var newFontSize = currentFontSize;
      }
      document.getElementById("wysiwyg" + n).contentWindow.document.execCommand("FontSize", false, newFontSize);
    }
    else if(id=="forecolor"){
      if(document.getElementById('colorpicker').style.display == ""){
          document.getElementById('colorpicker').style.display = "none";
      } else {
          document.getElementById('colorpicker').style.display = "";	
      }
    } 
    else if(id=="backcolor"){
      if(document.getElementById('colorbackpicker').style.display == ""){
          document.getElementById('colorbackpicker').style.display = "none";
      } else {
          document.getElementById('colorbackpicker').style.display = "";	
      }
    }
    else if(id=="htmlmode"){		
      var getDoc = document.getElementById("wysiwyg" + n).contentWindow.document;      
      if(mode == 1) {
        if(navigator.appName == "Microsoft Internet Explorer") {
          var iHTML = getDoc.body.innerHTML;
          getDoc.body.innerText = iHTML;
        } else {
          var html = document.createTextNode(getDoc.body.innerHTML);
          getDoc.body.innerHTML = "";
          getDoc.body.appendChild(html);
        }
        getDoc.body.style.fontSize = "12px";
        getDoc.body.style.fontFamily = "Courier New";
        mode = 0;
      } else {
        if(navigator.appName == "Microsoft Internet Explorer") {
          var iText = getDoc.body.innerText;
          getDoc.body.innerHTML = iText;
        } else {
          var html = getDoc.body.ownerDocument.createRange();
          html.selectNodeContents(getDoc.body);
          getDoc.body.innerHTML = html.toString();
        }
        getDoc.body.style.fontSize = "";
        getDoc.body.style.fontFamily = "";
        mode = 1;        
      }
    }
    else if(id=="help"){	
      if(document.getElementById('helpbox').style.display == ""){
          document.getElementById('helpbox').style.display = "none";
      } else {
          document.getElementById('helpbox').style.display = "";	
      }    
    }
    else if(id=="link"){
      var browserName = navigator.appName;	 	 
      if (browserName == "Microsoft Internet Explorer") {    
        document.getElementById("wysiwyg" + n).contentWindow.document.execCommand('createLink',true,' ');
      } else {
        insertLink(n);
      }
    }
    else if(id=="insertimage") {
      var browserName = navigator.appName;	 	 
      if (browserName == "Microsoft Internet Explorer") {       
        document.getElementById("wysiwyg" + n).contentWindow.document.execCommand(id, true, null);
      } else {
        insertImage(n);
      }
    }
    else {
    document.getElementById("wysiwyg" + n).contentWindow.document.execCommand(id, false, null);
  }
}

function insertHTML(html, n) {
  var browserName = navigator.appName;	 	 
	if (browserName == "Microsoft Internet Explorer") {	  
	  document.getElementById('wysiwyg' + n).contentWindow.document.selection.createRange().pasteHTML(html);   
	} 
	 
	else {
	  var div = document.getElementById('wysiwyg' + n).contentWindow.document.createElement("span");
		 
		div.innerHTML = html;
		var node = insertNodeAtSelection(div, n);		
	}
}

function insertNodeAtSelection(insertNode, n) {
  // get current selection
  var sel = document.getElementById('wysiwyg' + n).contentWindow.getSelection();

  // get the first range of the selection (there's almost always only one range)
  var range = sel.getRangeAt(0);

  // deselect everything
  sel.removeAllRanges();

  // remove content of current selection from document
  range.deleteContents();

  // get location of current selection
  var container = range.startContainer;
  var pos = range.startOffset;

  // make a new range for the new selection
  range = document.createRange();

  if (container.nodeType==3 && insertNode.nodeType==3) {

    // if we insert text in a textnode, do optimized insertion
    container.insertData(pos, insertNode.nodeValue);

    // put cursor after inserted text
    range.setEnd(container, pos+insertNode.length);
    range.setStart(container, pos+insertNode.length);
  } 
	
	else {
    var afterNode;
    
		if (container.nodeType==3) {
      // when inserting into a textnode we create 2 new textnodes and put the insertNode in between
      var textNode = container;
      container = textNode.parentNode;
      var text = textNode.nodeValue;

      // text before the split
      var textBefore = text.substr(0,pos);

      // text after the split
      var textAfter = text.substr(pos);

      var beforeNode = document.createTextNode(textBefore);
      afterNode = document.createTextNode(textAfter);

      // insert the 3 new nodes before the old one
      container.insertBefore(afterNode, textNode);
      container.insertBefore(insertNode, afterNode);
      container.insertBefore(beforeNode, insertNode);

      // remove the old node
      container.removeChild(textNode);
    } 
	
	  else {
      // else simply insert the node
      afterNode = container.childNodes[pos];
      container.insertBefore(insertNode, afterNode);
    }

    range.setEnd(afterNode, 0);
    range.setStart(afterNode, 0);
  }

  sel.addRange(range);
}

function updateTextArea(n) {
  document.getElementById(n).value = document.getElementById("wysiwyg" + n).contentWindow.document.body.innerHTML;
}

function grabSelectedText(n){ 
   var browserName = navigator.appName; 
   var selectedText = ''; 
   // for IE 
   if (browserName == "Microsoft Internet Explorer") { 
      var theText = document.getElementById("wysiwyg" + n).contentWindow.document.selection; 
      if(theText.type =='Text')   { 
         var newText = theText.createRange(); 
         selectedText = newText.text; 
      } 
   } 
   // for Mozilla/Netscape 
   else { 
      var selectedText = document.getElementById("wysiwyg" + n).contentWindow.document.getSelection(); 
   } 
   return selectedText; 
} 
