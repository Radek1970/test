var OxO3c55=["=","; path=/;"," expires=",";","cookie","length","","#ffffff","CECC","onmouseover","event","srcElement","target","className","colordiv","style","onmouseout","onclick","CheckboxColorNames","checked","cname","backgroundColor","cvalue","colorpicker.php?UC=","Culture","\x26setting=","EditorSetting","dialogWidth:500px;dialogHeight:420px;help:0;status:0;resizable:1","dialogArguments","object","onchange","color","editor","divpreview","value","#","RecentColors","SPAN","ValidColor"];function SetCookie(name,Ox23f,Ox240){var Ox241=name+OxO3c55[0]+escape(Ox23f)+OxO3c55[1];if(Ox240){var Ox228= new Date();Ox228.setSeconds(Ox228.getSeconds()+Ox240);Ox241+=OxO3c55[2]+Ox228.toUTCString()+OxO3c55[3];} ;document[OxO3c55[4]]=Ox241;} ;function GetCookie(name){var Ox243=document[OxO3c55[4]].split(OxO3c55[3]);for(var i=0;i<Ox243[OxO3c55[5]];i++){var Ox244=Ox243[i].split(OxO3c55[0]);if(name==Ox244[0].replace(/\s/g,OxO3c55[6])){return unescape(Ox244[1]);} ;} ;} ;function GetCookieDictionary(){var Ox246={};var Ox243=document[OxO3c55[4]].split(OxO3c55[3]);for(var i=0;i<Ox243[OxO3c55[5]];i++){var Ox244=Ox243[i].split(OxO3c55[0]);Ox246[Ox244[0].replace(/\s/g,OxO3c55[6])]=unescape(Ox244[1]);} ;return Ox246;} ;function GetCookieArray(){var arr=[];var Ox243=document[OxO3c55[4]].split(OxO3c55[3]);for(var i=0;i<Ox243[OxO3c55[5]];i++){var Ox244=Ox243[i].split(OxO3c55[0]);var Ox241={name:Ox244[0].replace(/\s/g,OxO3c55[6]),value:unescape(Ox244[1])};arr[arr[OxO3c55[5]]]=Ox241;} ;return arr;} ;var __defaultcustomlist=[OxO3c55[7],OxO3c55[7],OxO3c55[7],OxO3c55[7],OxO3c55[7],OxO3c55[7],OxO3c55[7],OxO3c55[7]];function GetCustomColors(){var Ox24b=__defaultcustomlist.concat();for(var i=0;i<18;i++){var Ox24c=GetCustomColor(i);if(Ox24c){Ox24b[i]=Ox24c;} ;} ;return Ox24b;} ;function GetCustomColor(Ox24e){return GetCookie(OxO3c55[8]+Ox24e);} ;function SetCustomColor(Ox24e,Ox24c){SetCookie(OxO3c55[8]+Ox24e,Ox24c,60*60*24*365);} ;var _origincolor=OxO3c55[6];document[OxO3c55[9]]=function (Ox2e8){Ox2e8=window[OxO3c55[10]]||Ox2e8;var Ox270=Ox2e8[OxO3c55[11]]||Ox2e8[OxO3c55[12]];if(Ox270[OxO3c55[13]]==OxO3c55[14]){firecolorchange(Ox270[OxO3c55[15]].backgroundColor);} ;} ;document[OxO3c55[16]]=function (Ox2e8){Ox2e8=window[OxO3c55[10]]||Ox2e8;var Ox270=Ox2e8[OxO3c55[11]]||Ox2e8[OxO3c55[12]];if(Ox270[OxO3c55[13]]==OxO3c55[14]){firecolorchange(_origincolor);} ;} ;document[OxO3c55[17]]=function (Ox2e8){Ox2e8=window[OxO3c55[10]]||Ox2e8;var Ox270=Ox2e8[OxO3c55[11]]||Ox2e8[OxO3c55[12]];if(Ox270[OxO3c55[13]]==OxO3c55[14]){var Ox3b5=document.getElementById(OxO3c55[18])&&document.getElementById(OxO3c55[18])[OxO3c55[19]];if(Ox3b5){do_select(Ox270.getAttribute(OxO3c55[20])||Ox270[OxO3c55[15]][OxO3c55[21]]);} else {do_select(Ox270.getAttribute(OxO3c55[22])||Ox270[OxO3c55[15]][OxO3c55[21]]);} ;} ;} ;var _editor;function firecolorchange(Ox3b8){} ;function ShowColorDialog(Ox353){var Ox25a=OxO3c55[23]+editor.GetScriptProperty(OxO3c55[24])+OxO3c55[25]+editor.GetScriptProperty(OxO3c55[26]);var Ox3ba=OxO3c55[27];var Ox25c=showModalDialog(Ox25a,null,Ox3ba);if(Ox25c!=null&&Ox25c!==false){Ox353(Ox25c);} ;} ;if(top[OxO3c55[28]]){if( typeof (top[OxO3c55[28]])==OxO3c55[29]){if(top[OxO3c55[28]][OxO3c55[30]]){firecolorchange=top[OxO3c55[28]][OxO3c55[30]];_origincolor=top[OxO3c55[28]][OxO3c55[31]];_editor=top[OxO3c55[28]][OxO3c55[32]];} ;} ;} ;var _selectedcolor=null;function do_select(Ox24c){_selectedcolor=Ox24c;firecolorchange(Ox24c);var Ox13=document.getElementById(OxO3c55[33]);if(Ox13){Ox13[OxO3c55[34]]=Ox24c;} ;} ;function do_saverecent(Ox24c){if(!Ox24c){return ;} ;if(Ox24c[OxO3c55[5]]!=7){return ;} ;if(Ox24c.substring(0,1)!=OxO3c55[35]){return ;} ;var Ox251=Ox24c.substring(1,7);var Ox3be=GetCookie(OxO3c55[36]);if(!Ox3be){Ox3be=OxO3c55[6];} ;if((Ox3be[OxO3c55[5]]%6)!=0){Ox3be=OxO3c55[6];} ;for(var i=0;i<Ox3be[OxO3c55[5]];i+=6){if(Ox3be.substr(i,6)==Ox251){Ox3be=Ox3be.substr(0,i)+Ox3be.substr(i+6);i-=6;} ;} ;if(Ox3be[OxO3c55[5]]>31*6){Ox3be=Ox3be.substr(0,31*6);} ;Ox3be=Ox251+Ox3be;SetCookie(OxO3c55[36],Ox3be,60*60*24*365);} ;function do_insert(){var Ox24c;var divpreview=document.getElementById(OxO3c55[33]);if(divpreview){Ox24c=divpreview[OxO3c55[34]];} else {Ox24c=_selectedcolor;} ;try{document.createElement(OxO3c55[37])[OxO3c55[15]][OxO3c55[31]]=Ox24c;do_saverecent(Ox24c);Window_SetDialogReturnValue(window,Ox24c);Window_CloseDialog(window);} catch(x){alert(CE_GetStr(OxO3c55[38]));divpreview[OxO3c55[34]]=OxO3c55[6];return false;} ;} ;