var OxO392f=["INPUT","TEXTAREA","DIV","SPAN","","contentWindow","innerHTML","body","document","length","type","text","id","isContentEditable","showModalDialog","?","?Modal=true","\x26Modal=true","dialogHeight:340px; dialogWidth:395px; edge:Raised; center:Yes; help:No; resizable:Yes; status:No; scroll:No","newWindow","height=300,width=400,scrollbars=no,resizable=no,toolbars=no,status=no,menubar=no,location=no","ElementIndex","dialogArguments","window","opener","value","SpellMode","start","suggest","end","SpellingForm","checkElements","innerText","StatusText","Spell Checking Text ...","CurrentText","WordIndex","Spell Check Complete","selectedIndex","ReplacementWord","form","options"];var showCompleteAlert=true;var tagGroup= new Array(OxO392f[0],OxO392f[1],OxO392f[2],OxO392f[3]);var checkElements= new Array();function getText(Ox315){var Ox316=document.getElementById(checkElements[Ox315]);var Ox317=OxO392f[4];var Ox318=document.getElementById(Ox316.id);if(Ox318[OxO392f[5]]){Ox317=Ox318[OxO392f[5]][OxO392f[8]][OxO392f[7]][OxO392f[6]];} else {Ox317=Ox318[OxO392f[8]][OxO392f[7]][OxO392f[6]];} ;return Ox317;} ;function setText(Ox315,Ox319){var Ox316=document.getElementById(checkElements[Ox315]);var Ox318=document.getElementById(Ox316.id);if(Ox318[OxO392f[5]]){Ox318[OxO392f[5]][OxO392f[8]][OxO392f[7]][OxO392f[6]]=Ox319;} else {Ox318[OxO392f[8]][OxO392f[7]][OxO392f[6]]=Ox319;} ;} ;function checkSpelling(){checkElements= new Array();for(var i=0;i<tagGroup[OxO392f[9]];i++){var Ox31b=tagGroup[i];var Ox31c=document.getElementsByTagName(Ox31b);for(var Ox31d=0;Ox31d<Ox31c[OxO392f[9]];Ox31d++){if((Ox31b==OxO392f[0]&&Ox31c[Ox31d][OxO392f[10]]==OxO392f[11])||Ox31b==OxO392f[1]){checkElements[checkElements[OxO392f[9]]]=Ox31c[Ox31d][OxO392f[12]];} else {if((Ox31b==OxO392f[2]||Ox31b==OxO392f[3])&&Ox31c[Ox31d][OxO392f[13]]){checkElements[checkElements[OxO392f[9]]]=Ox31c[Ox31d][OxO392f[12]];} ;} ;} ;} ;openSpellChecker();} ;function checkSpellingById(Ox2d9,Ox31f){checkElements= new Array();checkElements[checkElements[OxO392f[9]]]=Ox2d9;openSpellChecker(Ox31f);} ;function checkElementSpelling(Ox316){checkElements= new Array();checkElements[checkElements[OxO392f[9]]]=Ox316[OxO392f[12]];openSpellChecker();} ;function openSpellChecker(Ox31f){if(window[OxO392f[14]]){var Ox322;if(Ox31f.indexOf(OxO392f[15])==-1){Ox322=OxO392f[16];} else {Ox322=OxO392f[17];} ;var Ox323=window.showModalDialog(Ox31f+Ox322,window,OxO392f[18]);} else {var Ox324=window.open(Ox31f,OxO392f[19],OxO392f[20]);} ;} ;var iElementIndex=-1;var parentWindow;function initialize(){iElementIndex=parseInt(document.getElementById(OxO392f[21]).value);if(parent[OxO392f[23]][OxO392f[22]]){parentWindow=parent[OxO392f[23]][OxO392f[22]];} else {if(top[OxO392f[24]]){parentWindow=top[OxO392f[24]];} ;} ;var Ox328=document.getElementById(OxO392f[26])[OxO392f[25]];switch(Ox328){case OxO392f[27]:break ;;case OxO392f[28]:updateText();break ;;case OxO392f[29]:updateText();;default:if(loadText()){document.getElementById(OxO392f[30]).submit();} else {endCheck();} ;break ;;} ;} ;function loadText(){if(!parentWindow[OxO392f[8]]){return false;} ;for(++iElementIndex;iElementIndex<parentWindow[OxO392f[31]][OxO392f[9]];iElementIndex++){var Ox212=parentWindow.getText(iElementIndex);if(Ox212[OxO392f[9]]>0){updateSettings(Ox212,0,iElementIndex,OxO392f[27]);document.getElementById(OxO392f[33])[OxO392f[32]]=OxO392f[34];return true;} ;} ;return false;} ;function updateSettings(Ox32b,Ox21c,Ox32c,Ox32d){document.getElementById(OxO392f[35])[OxO392f[25]]=Ox32b;document.getElementById(OxO392f[36])[OxO392f[25]]=Ox21c;document.getElementById(OxO392f[21])[OxO392f[25]]=Ox32c;document.getElementById(OxO392f[26])[OxO392f[25]]=Ox32d;} ;function updateText(){if(!parentWindow[OxO392f[8]]){return false;} ;var Ox212=document.getElementById(OxO392f[35])[OxO392f[25]];parentWindow.setText(iElementIndex,Ox212);} ;function endCheck(){if(showCompleteAlert){alert(OxO392f[37]);} ;closeWindow();} ;function closeWindow(){top.close();} ;function changeWord(Ox316){var Ox332=Ox316[OxO392f[38]];Ox316[OxO392f[40]][OxO392f[39]][OxO392f[25]]=Ox316[OxO392f[41]][Ox332][OxO392f[25]];} ;