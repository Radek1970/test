var OxO4e9b=["stringSearch","stringReplace","MatchWholeWord","MatchCase","document","checked","length","value","Nothing to search.\x0APlease enter some text in the field labeled Find what:","selection","body","type","Control","text","Finished Searching the document. Would you like to start again from the top?","","textedit"," : ","Please use replace funtion."];var editwin=Window_GetDialogArguments(window);var stringSearch=Window_GetElement(window,OxO4e9b[0],true);var stringReplace=Window_GetElement(window,OxO4e9b[1],true);var MatchWholeWord=Window_GetElement(window,OxO4e9b[2],true);var MatchCase=Window_GetElement(window,OxO4e9b[3],true);var editdoc=editwin[OxO4e9b[4]];function get_ie_matchtype(){var Ox42b=0;var Ox42c=0;var Ox42d=0;if(MatchCase[OxO4e9b[5]]){Ox42c=4;} ;if(MatchWholeWord[OxO4e9b[5]]){Ox42d=2;} ;Ox42b=Ox42c+Ox42d;return (Ox42b);} ;function checkInputString(){if(stringSearch[OxO4e9b[7]][OxO4e9b[6]]<1){alert(OxO4e9b[8]);return false;} else {return true;} ;} ;function IsMatchSearchValue(Oxe){if(!Oxe){return false;} ;if(stringSearch[OxO4e9b[7]]==Oxe){return true;} ;if(MatchCase[OxO4e9b[5]]){return false;} ;return stringSearch[OxO4e9b[7]].toLowerCase()==Oxe.toLowerCase();} ;var _ie_range=null;function IE_Restore(){editwin.focus();if(_ie_range!=null){_ie_range.select();} ;} ;function IE_Save(){editwin.focus();_ie_range=editdoc[OxO4e9b[9]].createRange();} ;function MoveToBodyStart(){if(Browser_UseIESelection()){range=document[OxO4e9b[10]].createTextRange();range.collapse(true);range.select();IE_Save();} else {editwin.getSelection().collapse(editdoc.body,0);} ;} ;function DoFind(){if(Browser_UseIESelection()){IE_Restore();var Ox255=editdoc[OxO4e9b[9]];if(Ox255[OxO4e9b[11]]==OxO4e9b[12]){MoveToBodyStart();} ;var Ox33e=Ox255.createRange();Ox33e.collapse(false);if(Ox33e.findText(stringSearch.value,1000000000,get_ie_matchtype())){Ox33e.select();IE_Save();return true;} ;} else {var Ox33e=editwin.getSelection().getRangeAt(0);if(editwin.find(stringSearch.value,MatchCase.checked,false,false,MatchWholeWord.checked,false,false)){return true;} ;} ;} ;function DoReplace(){if(Browser_UseIESelection()){IE_Restore();var Ox255=editdoc[OxO4e9b[9]];if(Ox255[OxO4e9b[11]]!=OxO4e9b[12]){var Ox33e=Ox255.createRange();if(IsMatchSearchValue(Ox33e.text)){Ox33e[OxO4e9b[13]]=stringReplace[OxO4e9b[7]];Ox33e.collapse(false);IE_Save();return true;} ;} ;} else {var Ox255=editwin.getSelection();if(IsMatchSearchValue(Ox255.toString())){Ox255.deleteFromDocument();Ox255.getRangeAt(0).insertNode(editdoc.createTextNode(stringReplace.value));Ox255.getRangeAt(0).collapse(false);return true;} ;} ;return false;} ;function FindTxt(){if(!checkInputString()){return false;} ;while(true){if(DoFind()){return ;} ;if(!confirm(OxO4e9b[14])){return ;} ;MoveToBodyStart();} ;} ;function ReplaceTxt(){if(!checkInputString()){return ;} ;DoReplace();FindTxt();} ;function ReplaceAllTxt(){if(!checkInputString()){return ;} ;var Ox439=0;var msg=OxO4e9b[15];MoveToBodyStart();if(Browser_UseIESelection()){var Ox255=editdoc[OxO4e9b[9]];if(Ox255[OxO4e9b[11]]==OxO4e9b[12]){MoveToBodyStart();} ;var Ox43a=Ox255.createRange();var Ox439=0;var msg=OxO4e9b[15];Ox43a.expand(OxO4e9b[16]);Ox43a.collapse();Ox43a.select();while(Ox43a.findText(stringSearch.value,1000000000,get_ie_matchtype())){Ox43a.select();Ox43a[OxO4e9b[13]]=stringReplace[OxO4e9b[7]];Ox439++;} ;if(Ox439==0){msg=WordNotFound;} else {msg=WordReplaced+OxO4e9b[17]+Ox439;} ;alert(msg);} else {if((stringReplace[OxO4e9b[7]]).indexOf(stringSearch.value)==-1){DoFind();while(DoReplace()){Ox439++;DoFind();FindTxt();} ;if(Ox439==0){msg=WordNotFound;} else {msg=WordReplaced+OxO4e9b[17]+Ox439;} ;alert(msg);} else {FindTxt();alert(OxO4e9b[18]);} ;} ;} ;