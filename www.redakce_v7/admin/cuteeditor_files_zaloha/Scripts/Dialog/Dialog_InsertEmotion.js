var OxO6f8b=[""," ","=\x22","\x22","src","^[a-z]*:[/][/][^/]*","Edit","\x3CIMG border=\x220\x22 align=\x22absmiddle\x22 src=\x22","\x22 src_cetemp=\x22","\x22\x3E","ImageTable","IMG","length","className","dialogButton","onmouseover","CuteEditor_ColorPicker_ButtonOver(this)","onclick","insert(this)"];var editor=Window_GetDialogArguments(window);function attr(name,Ox23f){if(!Ox23f||Ox23f==OxO6f8b[0]){return OxO6f8b[0];} ;return OxO6f8b[1]+name+OxO6f8b[2]+Ox23f+OxO6f8b[3];} ;function insert(img){if(img){var src=img[OxO6f8b[4]];src=src.replace( new RegExp(OxO6f8b[5],OxO6f8b[0]),OxO6f8b[0]);var Ox454=OxO6f8b[0];if(editor.GetActiveTab()==OxO6f8b[6]){Ox454=OxO6f8b[7]+src+OxO6f8b[8]+src+OxO6f8b[9];} else {Ox454=OxO6f8b[7]+src+OxO6f8b[9];} ;editor.PasteHTML(Ox454);Window_CloseDialog(window);} ;} ;function do_Close(){Window_CloseDialog(window);} ;var ImageTable=Window_GetElement(window,OxO6f8b[10],true);var images=ImageTable.getElementsByTagName(OxO6f8b[11]);var len=images[OxO6f8b[12]];for(var i=0;i<len;i++){var img=images[i];img[OxO6f8b[13]]=OxO6f8b[14];img[OxO6f8b[15]]= new Function(OxO6f8b[16]);img[OxO6f8b[17]]= new Function(OxO6f8b[18]);} ;