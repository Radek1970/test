var OxO4b22=["contains","parentNode","selection","document","type","None","Text","body","rangeCount","window","Control","anchorOffset","childNodes","anchorNode","isCollapsed","focusNode","length","nodeType","nodeName","INPUT","TEXTAREA","BUTTON","IMG","SELECT","TABLE","position","style","absolute","relative","top","contentWindow","contentDocument","parentWindow","id","frames","frameElement","//TODO:frame contentWindow not found?","iframe","editor","img","onload","src","","src_cetemp","contentEditable","designMode","on","clearAttributes","marginTop","0","marginLeft","color","black","background","white","unselectable","2D-Position","LiveResize","innerHTML","outerHTML","MAP","name","useMap","#","areas","href","target","alt","coords",",","\x3Cimg id=\x27myIMAGE","\x27 border=1 src=\x27Images/space.gif\x27 title=\x27","\x27 style=\x27position:absolute;left:","px;top:","px;width:","px;height:","px;z-index:","\x27\x3E","MapLink.php","dialogWidth:350px;dialogHeight:200px;help:no;scroll:no;status:no;resizable:0;","zoom","width","height","\x27  border=1 src=\x27Images/space.gif\x27 title=\x27","\x27 style=\x27position:absolute;z-index:",";width:20;height:20;left:",";top:","myIMAGE","\x3Carea shape=\x27rect\x27 coords=\x27","\x27","href=\x27","\x27 ","target=\x27","alt=\x27","\x3E","PasteHTML","\x3Cmap name=\x27","\x3C/map\x3E","off","AutoMap","display","img_zoom_in","none","img_zoom_out","img_bestfit","img_actualsize"];function Element_Contains(element,Ox298){if(!Browser_IsOpera()){if(element[OxO4b22[0]]){return element.contains(Ox298);} ;} ;for(;Ox298!=null;Ox298=Ox298[OxO4b22[1]]){if(element==Ox298){return true;} ;} ;return false;} ;function Window_CreateSelectionRange(Ox2bf){var Ox33e;if(Browser_UseIESelection()){var Ox255=Ox2bf[OxO4b22[3]][OxO4b22[2]];if(Ox255[OxO4b22[4]]==OxO4b22[5]||Ox255[OxO4b22[4]]==OxO4b22[6]){Ox33e=Ox255.createRange();} else {Ox33e=document[OxO4b22[7]].createTextRange();Ox33e.moveToElement(Ox255.createRange().item(0));} ;} else {var Ox255=Ox2bf.getSelection();if(Ox255[OxO4b22[8]]==0){Ox33e=Ox2bf[OxO4b22[3]].createRange();} else {Ox33e=Ox255.getRangeAt(0).cloneRange();} ;} ;Ox33e[OxO4b22[9]]=Ox2bf;return Ox33e;} ;function Window_GetSelectionNode(Ox2bf){var Ox298=Window_GetSelectionNode_Core(Ox2bf);if(Ox298==Ox2bf[OxO4b22[3]][OxO4b22[7]]){return null;} ;if(!Element_Contains(Ox2bf[OxO4b22[3]].body,Ox298)){return null;} ;return Ox298;} ;function Window_GetSelectionNode_Core(Ox2bf){var Ox255;if(Browser_UseIESelection()){Ox255=Ox2bf[OxO4b22[3]][OxO4b22[2]];if(Ox255[OxO4b22[4]]==OxO4b22[5]||Ox255[OxO4b22[4]]==OxO4b22[6]){return Ox255.createRange().parentElement();} ;return Ox255.createRange().item(0);} ;var Ox255=Ox2bf.getSelection();if(Window_GetSelectionType(Ox2bf)==OxO4b22[10]){return Ox255[OxO4b22[13]][OxO4b22[12]][Ox255[OxO4b22[11]]];} ;if(Ox255[OxO4b22[14]]){return Ox255[OxO4b22[13]];} ;if(Ox255[OxO4b22[13]]==Ox255[OxO4b22[15]]){return Ox255[OxO4b22[13]];} ;var p=Ox255[OxO4b22[13]];var Oxf=p[OxO4b22[12]];for(var i=0;i<Oxf[OxO4b22[16]];i++){var Ox35e=Oxf.item(i);if(Ox255.containsNode(Ox35e,true)){if(i!=0&&Ox255.containsNode(Oxf.item(i-1),false)){continue ;} ;if(i<Oxf[OxO4b22[16]]-1&&Ox255.containsNode(Oxf.item(i+1),false)){continue ;} ;return Ox35e;} ;} ;if(Ox255[OxO4b22[8]]==1){return Range_GetParentNode(Window_CreateSelectionRange(Ox2bf));} ;if(!Element_Contains(Ox2bf[OxO4b22[3]].body,Ox255.anchorNode)){return null;} ;return Element_GetSameParent(Ox255.anchorNode,Ox255.focusNode);} ;function Window_GetSelectionElement(Ox2bf){var Ox298=Window_GetSelectionNode(Ox2bf);if(Ox298==null){return null;} ;if(Ox298[OxO4b22[17]]==1){return Ox298;} ;return Ox298[OxO4b22[1]];} ;function Window_GetSelectionType(Ox2bf){if(Browser_UseIESelection()){return Ox2bf[OxO4b22[3]][OxO4b22[2]][OxO4b22[4]];} ;var Ox255=Ox2bf.getSelection();if(Ox255[OxO4b22[14]]){return OxO4b22[6];} ;if(Ox255[OxO4b22[13]]!=Ox255[OxO4b22[15]]){return OxO4b22[6];} ;var p=Ox255[OxO4b22[13]];var Oxf=p[OxO4b22[12]];for(var i=0;i<Oxf[OxO4b22[16]];i++){var Ox35e=Oxf.item(i);if(Ox35e[OxO4b22[17]]!=1){continue ;} ;if(Ox255.containsNode(Ox35e,true)){if(i!=0&&Ox255.containsNode(Oxf.item(i-1),false)){continue ;} ;if(i<Oxf[OxO4b22[16]]-1&&Ox255.containsNode(Oxf.item(i+1),false)){continue ;} ;if(Element_IsBlockControl(Ox35e)){return OxO4b22[10];} ;return OxO4b22[6];} ;} ;return OxO4b22[6];} ;function Element_IsBlockControl(element){var name=element[OxO4b22[18]];if(name==OxO4b22[19]){return true;} ;if(name==OxO4b22[20]){return true;} ;if(name==OxO4b22[21]){return true;} ;if(name==OxO4b22[22]){return true;} ;if(name==OxO4b22[23]){return true;} ;if(name==OxO4b22[24]){return true;} ;var Ox224=element[OxO4b22[26]][OxO4b22[25]];if(Ox224==OxO4b22[27]||Ox224==OxO4b22[28]){return true;} ;return false;} ;function Window_GetDialogTop(Ox2bf){return Ox2bf[OxO4b22[29]];} ;function Frame_GetContentWindow(Ox462){if(Ox462[OxO4b22[30]]){return Ox462[OxO4b22[30]];} ;if(Ox462[OxO4b22[31]]){if(Ox462[OxO4b22[31]][OxO4b22[32]]){return Ox462[OxO4b22[31]][OxO4b22[32]];} ;} ;var Ox2bf;if(Ox462[OxO4b22[33]]){Ox2bf=window[OxO4b22[34]][Ox462[OxO4b22[33]]];if(Ox2bf){return Ox2bf;} ;} ;var len=window[OxO4b22[34]][OxO4b22[16]];for(var i=0;i<len;i++){Ox2bf=window[OxO4b22[34]][i];if(Ox2bf[OxO4b22[35]]==Ox462){return Ox2bf;} ;if(Ox2bf[OxO4b22[3]]==Ox462[OxO4b22[31]]){return Ox2bf;} ;} ;Debug_Todo(OxO4b22[36]);} ;var iframe=Window_GetElement(window,OxO4b22[37],true);var iframe_win=Frame_GetContentWindow(iframe);var obj=Window_GetDialogArguments(window);var editor=obj[OxO4b22[38]];var editwin=obj[OxO4b22[9]];var editdoc=obj[OxO4b22[3]];var oImg=obj[OxO4b22[39]];var oMap=null;var aMapName= new Array();var aLeft= new Array();var aTop= new Array();var aWidth= new Array();var aHeight= new Array();var aHref= new Array();var aTarget= new Array();var aTitle= new Array();var aCoords= new Array();window[OxO4b22[40]]=function window_onload(){var src;src=oImg.getAttribute(OxO4b22[41])+OxO4b22[42];if(oImg.getAttribute(OxO4b22[43])){src=oImg.getAttribute(OxO4b22[43])+OxO4b22[42];} ;oImg[OxO4b22[41]]=src;if(Browser_IsWinIE()){iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[44]]=true;} else {iframe_win[OxO4b22[3]][OxO4b22[45]]=OxO4b22[46];iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[44]]=true;} ;iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[47]];iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[48]]=OxO4b22[49];iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[50]]=OxO4b22[49];iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[51]]=OxO4b22[52];iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[53]]=OxO4b22[54];oImg[OxO4b22[55]]=OxO4b22[46];if(Browser_IsWinIE()){iframe_win[OxO4b22[3]].execCommand(OxO4b22[56],true,true);iframe_win[OxO4b22[3]].execCommand(OxO4b22[57],true,true);} ;iframe_win.focus();if(Browser_IsWinIE()){iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[58]]=oImg[OxO4b22[59]];} else {iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[58]]=outerHTML(oImg);} ;var Ox470=editdoc[OxO4b22[7]].getElementsByTagName(OxO4b22[60]);for(var i=0;i<Ox470[OxO4b22[16]];i++){aMapName[i]=Ox470[i][OxO4b22[61]].toUpperCase();} ;var Ox471=oImg[OxO4b22[62]];if(Ox471!=OxO4b22[42]){Ox471=Ox471.toUpperCase();for(var i=0;i<Ox470[OxO4b22[16]];i++){if((OxO4b22[63]+aMapName[i])==Ox471){oMap=Ox470[i];} ;} ;} ;if(oMap){for(var i=0;i<oMap[OxO4b22[64]][OxO4b22[16]];i++){aHref[i]=oMap[OxO4b22[64]][i][OxO4b22[65]];aTarget[i]=oMap[OxO4b22[64]][i][OxO4b22[66]];aTitle[i]=oMap[OxO4b22[64]][i][OxO4b22[67]];aCoords[i]=oMap[OxO4b22[64]][i][OxO4b22[68]];var Ox1e=aCoords[i].split(OxO4b22[69]);aLeft[i]=parseInt(Ox1e[0]);aTop[i]=parseInt(Ox1e[1]);aWidth[i]=parseInt(Ox1e[2])-aLeft[i];aHeight[i]=parseInt(Ox1e[3])-aTop[i];iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[58]]+=OxO4b22[70]+i+OxO4b22[71]+AddLinktoImageMap+OxO4b22[72]+aLeft[i]+OxO4b22[73]+aTop[i]+OxO4b22[74]+aWidth[i]+OxO4b22[75]+aHeight[i]+OxO4b22[76]+(i+1)+OxO4b22[77];} ;} ;} ;function SearchSelectionElement(Ox473){var body=iframe_win[OxO4b22[3]][OxO4b22[7]];for(var Ox26e=Window_GetSelectionElement(iframe_win);Element_Contains(body,Ox26e);Ox26e=Ox26e[OxO4b22[1]]){if(Ox26e[OxO4b22[18]]==Ox473){return Ox26e;} ;} ;return null;} ;function Addlink(){var img=SearchSelectionElement(OxO4b22[22]);if(!img){return ;} ;function Ox477(arr){if(arr){aHref[Ox479]=arr[0];aTarget[Ox479]=arr[1];aTitle[Ox479]=arr[2];} ;} ;var Ox478=img[OxO4b22[33]];var Ox479=parseInt(Ox478.substr(7));var obj={editor:editor,href:aHref[Ox479],target:aTarget[Ox479],title:aTitle[Ox479]};editor.SetNextDialogWindow(window);editor.ShowDialog(Ox477,OxO4b22[78]+query_string,obj,OxO4b22[79]);} ;function do_Close(){Window_SetDialogReturnValue(window,null);Window_CloseDialog(window);} ;function Zoom_In(){if(iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]!=0){iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]*=1.2;} else {iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]=1.2;} ;} ;function Zoom_Out(){if(iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]!=0){iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]*=0.8;} else {iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]=0.8;} ;} ;function BestFit(){if(!oImg){return ;} ;var Ox47d=280;var Ox268=290;iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]=1/Math.max(oImg[OxO4b22[81]]/Ox268,oImg[OxO4b22[82]]/Ox47d);} ;function Actualsize(){iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[26]][OxO4b22[80]]=1;} ;function newMap(){var Ox233=aHref[OxO4b22[16]];var Ox480=(oImg[OxO4b22[81]]-20)*0.5;var Ox454=(oImg[OxO4b22[82]]-20)*0.5;aHref[Ox233]=OxO4b22[42];aTarget[Ox233]=OxO4b22[42];aTitle[Ox233]=OxO4b22[42];iframe_win[OxO4b22[3]][OxO4b22[7]][OxO4b22[58]]+=OxO4b22[70]+Ox233+OxO4b22[83]+AddLinktoImageMap+OxO4b22[84]+(Ox233+1)+OxO4b22[85]+Ox480+OxO4b22[86]+Ox454+OxO4b22[77];iframe_win.scrollBy(0,0);iframe_win.focus();} ;function do_insert(){var Ox1f=false;for(var i=0;i<aHref[OxO4b22[16]];i++){var obj=Window_GetElement(iframe_win,OxO4b22[87]+i,false);if(obj){Ox1f=true;} ;} ;if(Ox1f){var Ox39d=OxO4b22[42];for(var i=0;i<aHref[OxO4b22[16]];i++){var obj=Window_GetElement(iframe_win,OxO4b22[87]+i,false);if(obj){var Ox481=parseInt(obj[OxO4b22[26]].left);var Ox482=parseInt(obj[OxO4b22[26]].top);var Ox483=parseInt(obj[OxO4b22[26]].width);var Ox484=parseInt(obj[OxO4b22[26]].height);var Ox485=Ox481+Ox483;var Ox486=Ox482+Ox484;Ox39d+=OxO4b22[88]+Ox481+OxO4b22[69]+Ox482+OxO4b22[69]+Ox485+OxO4b22[69]+Ox486+OxO4b22[89];if(aHref[i]!=OxO4b22[42]){Ox39d+=OxO4b22[90]+aHref[i]+OxO4b22[91];} ;if((aTarget[i]!=OxO4b22[42])&&aTarget[i]){Ox39d+=OxO4b22[92]+aTarget[i]+OxO4b22[91];} ;if(aTitle[i]!=OxO4b22[42]&&aTitle[i]!=null){Ox39d+=OxO4b22[93]+aTitle[i]+OxO4b22[91];} ;Ox39d+=OxO4b22[94];} ;} ;if(oMap){oMap[OxO4b22[58]]=Ox39d;} else {var Ox471=getAutoMapName();oImg[OxO4b22[62]]=OxO4b22[63]+Ox471;editor.ExecCommand(OxO4b22[95],false,OxO4b22[96]+Ox471+OxO4b22[77]+Ox39d+OxO4b22[97]);} ;} else {if(oMap){if(Browser_IsWinIE()){oMap[OxO4b22[59]]=OxO4b22[42];} ;} ;oImg[OxO4b22[62]]=OxO4b22[42];} ;oImg[OxO4b22[55]]=OxO4b22[98];oImg.removeAttribute(OxO4b22[55]);if(!Browser_IsWinIE()){editor.InsertElement(oImg);} ;Window_CloseDialog(window);} ;function getAutoMapName(){for(var i=1;true;i++){var Ox1ea=OxO4b22[99]+i;if(isValidMapName(Ox1ea)){return Ox1ea;} ;} ;} ;function isValidMapName(Oxe){Oxe=Oxe.toUpperCase();for(var i=0;i<aMapName[OxO4b22[16]];i++){if(aMapName[i]==Oxe){return false;} ;} ;return true;} ;function do_Close(){oImg.removeAttribute(OxO4b22[55]);Window_CloseDialog(window);} ;if(!Browser_IsWinIE()){Window_GetElement(window,OxO4b22[101],true)[OxO4b22[26]][OxO4b22[100]]=OxO4b22[102];Window_GetElement(window,OxO4b22[103],true)[OxO4b22[26]][OxO4b22[100]]=OxO4b22[102];Window_GetElement(window,OxO4b22[104],true)[OxO4b22[26]][OxO4b22[100]]=OxO4b22[102];Window_GetElement(window,OxO4b22[105],true)[OxO4b22[26]][OxO4b22[100]]=OxO4b22[102];} ;