var OxOe341=["Verdana","innerHTML","Unicode","innerText","\x3Cspan style=\x27font-family:","\x27\x3E","\x3C/span\x3E","selfont","length","checked","value","charstable1","charstable2","fontFamily","style","display","block","none"];var editor=Window_GetDialogArguments(window);function getchar(obj){var Ox454;var Ox49a=getFontValue()||OxOe341[0];if(!obj[OxOe341[1]]){return ;} ;Ox454=obj[OxOe341[1]];if(Ox49a==OxOe341[2]){Ox454=obj[OxOe341[3]];} else {if(Ox49a!=OxOe341[0]){Ox454=OxOe341[4]+Ox49a+OxOe341[5]+obj[OxOe341[1]]+OxOe341[6];} ;} ;editor.PasteHTML(Ox454);Window_CloseDialog(window);} ;function cancel(){Window_CloseDialog(window);} ;function getFontValue(){var Ox254=document.getElementsByName(OxOe341[7]);for(var i=0;i<Ox254[OxOe341[8]];i++){if(Ox254.item(i)[OxOe341[9]]){return Ox254.item(i)[OxOe341[10]];} ;} ;} ;function sel_font_change(){var Ox49d=getFontValue()||OxOe341[0];var Ox49e=Window_GetElement(window,OxOe341[11],true);var Ox49f=Window_GetElement(window,OxOe341[12],true);Ox49e[OxOe341[14]][OxOe341[13]]=Ox49d;Ox49e[OxOe341[14]][OxOe341[15]]=(Ox49d!=OxOe341[2]?OxOe341[16]:OxOe341[17]);Ox49f[OxOe341[14]][OxOe341[15]]=(Ox49d==OxOe341[2]?OxOe341[16]:OxOe341[17]);} ;