var OxOa814=["value","idSource","length","checked","linebreaks","\x0D\x0A","ig","\x3Cbr /\x3E","\x0D","\x0A"];var editor=Window_GetDialogArguments(window);function cancel(){Window_CloseDialog(window);} ;function insertContent(){var Ox3ae=document.getElementById(OxOa814[1])[OxOa814[0]];if(Ox3ae&&Ox3ae[OxOa814[2]]>0){if(document.getElementById(OxOa814[4])[OxOa814[3]]){Ox3ae=Ox3ae.replace(( new RegExp(OxOa814[5],OxOa814[6])),OxOa814[7]);Ox3ae=Ox3ae.replace(( new RegExp(OxOa814[8],OxOa814[6])),OxOa814[7]);Ox3ae=Ox3ae.replace(( new RegExp(OxOa814[9],OxOa814[6])),OxOa814[7]);} ;editor.PasteHTML(Ox3ae);Window_CloseDialog(window);} ;} ;