var OxO52b3=["inp_src","btnbrowse","AlternateText","inp_id","longDesc","Align","optNotSet","optLeft","optRight","optTexttop","optAbsMiddle","optBaseline","optAbsBottom","optBottom","optMiddle","optTop","Border","bordercolor","bordercolor_Preview","inp_width","imgLock","inp_height","constrain_prop","HSpace","VSpace","outer","img_demo","onclick","src","width","height","value","cssText","style","","src_cetemp","id","vspace","hspace","border","borderColor"," ","backgroundColor","align","alt","ValidNumber","ValidID","longdesc","checked","../Images/locked.gif","../Images/1x1.gif","length"];var inp_src=Window_GetElement(window,OxO52b3[0],true);var btnbrowse=Window_GetElement(window,OxO52b3[1],true);var AlternateText=Window_GetElement(window,OxO52b3[2],true);var inp_id=Window_GetElement(window,OxO52b3[3],true);var longDesc=Window_GetElement(window,OxO52b3[4],true);var Align=Window_GetElement(window,OxO52b3[5],true);var optNotSet=Window_GetElement(window,OxO52b3[6],true);var optLeft=Window_GetElement(window,OxO52b3[7],true);var optRight=Window_GetElement(window,OxO52b3[8],true);var optTexttop=Window_GetElement(window,OxO52b3[9],true);var optAbsMiddle=Window_GetElement(window,OxO52b3[10],true);var optBaseline=Window_GetElement(window,OxO52b3[11],true);var optAbsBottom=Window_GetElement(window,OxO52b3[12],true);var optBottom=Window_GetElement(window,OxO52b3[13],true);var optMiddle=Window_GetElement(window,OxO52b3[14],true);var optTop=Window_GetElement(window,OxO52b3[15],true);var Border=Window_GetElement(window,OxO52b3[16],true);var bordercolor=Window_GetElement(window,OxO52b3[17],true);var bordercolor_Preview=Window_GetElement(window,OxO52b3[18],true);var inp_width=Window_GetElement(window,OxO52b3[19],true);var imgLock=Window_GetElement(window,OxO52b3[20],true);var inp_height=Window_GetElement(window,OxO52b3[21],true);var constrain_prop=Window_GetElement(window,OxO52b3[22],true);var HSpace=Window_GetElement(window,OxO52b3[23],true);var VSpace=Window_GetElement(window,OxO52b3[24],true);var outer=Window_GetElement(window,OxO52b3[25],true);var img_demo=Window_GetElement(window,OxO52b3[26],true);btnbrowse[OxO52b3[27]]=function btnbrowse_onclick(){function Ox477(Ox25c){if(Ox25c){function Actualsize(){var Ox503= new Image();Ox503[OxO52b3[28]]=Ox25c;if(Ox503[OxO52b3[29]]>0&&Ox503[OxO52b3[30]]>0){inp_width[OxO52b3[31]]=Ox503[OxO52b3[29]];inp_height[OxO52b3[31]]=Ox503[OxO52b3[30]];FireUIChanged();} else {setTimeout(Actualsize,400);} ;} ;inp_src[OxO52b3[31]]=Ox25c;setTimeout(Actualsize,400);} ;} ;editor.SetNextDialogWindow(window);if(Browser_IsSafari()){editor.ShowSelectImageDialog(Ox477,inp_src.value,inp_src);} else {editor.ShowSelectImageDialog(Ox477,inp_src.value);} ;} ;UpdateState=function UpdateState_Image(){img_demo[OxO52b3[33]][OxO52b3[32]]=element[OxO52b3[33]][OxO52b3[32]];if(Browser_IsWinIE()){img_demo.mergeAttributes(element);} ;if(element[OxO52b3[28]]){img_demo[OxO52b3[28]]=element[OxO52b3[28]];} else {img_demo.removeAttribute(OxO52b3[28]);} ;} ;SyncToView=function SyncToView_Image(){var src;src=element.getAttribute(OxO52b3[28])+OxO52b3[34];if(element.getAttribute(OxO52b3[35])){src=element.getAttribute(OxO52b3[35])+OxO52b3[34];} ;inp_src[OxO52b3[31]]=src;inp_width[OxO52b3[31]]=element[OxO52b3[29]];inp_height[OxO52b3[31]]=element[OxO52b3[30]];inp_id[OxO52b3[31]]=element[OxO52b3[36]];if(element[OxO52b3[37]]<=0){VSpace[OxO52b3[31]]=OxO52b3[34];} else {VSpace[OxO52b3[31]]=element[OxO52b3[37]];} ;if(element[OxO52b3[38]]<=0){HSpace[OxO52b3[31]]=OxO52b3[34];} else {HSpace[OxO52b3[31]]=element[OxO52b3[38]];} ;Border[OxO52b3[31]]=element[OxO52b3[39]];if(Browser_IsWinIE()){bordercolor[OxO52b3[31]]=element[OxO52b3[33]][OxO52b3[40]];} else {var arr=revertColor(element[OxO52b3[33]].borderColor).split(OxO52b3[41]);bordercolor[OxO52b3[31]]=arr[0];} ;bordercolor[OxO52b3[33]][OxO52b3[42]]=bordercolor[OxO52b3[31]]||OxO52b3[34];bordercolor[OxO52b3[33]][OxO52b3[42]]=bordercolor[OxO52b3[31]];bordercolor_Preview[OxO52b3[33]][OxO52b3[42]]=bordercolor[OxO52b3[31]];Align[OxO52b3[31]]=element[OxO52b3[43]];AlternateText[OxO52b3[31]]=element[OxO52b3[44]];longDesc[OxO52b3[31]]=element[OxO52b3[4]];} ;SyncTo=function SyncTo_Image(element){element[OxO52b3[28]]=inp_src[OxO52b3[31]];element.setAttribute(OxO52b3[35],inp_src.value);element[OxO52b3[39]]=Border[OxO52b3[31]];element[OxO52b3[38]]=HSpace[OxO52b3[31]];element[OxO52b3[37]]=VSpace[OxO52b3[31]];try{element[OxO52b3[29]]=inp_width[OxO52b3[31]];element[OxO52b3[30]]=inp_height[OxO52b3[31]];} catch(er){alert(CE_GetStr(OxO52b3[45]));return false;} ;if(element[OxO52b3[33]][OxO52b3[29]]||element[OxO52b3[33]][OxO52b3[30]]){try{element[OxO52b3[33]][OxO52b3[29]]=inp_width[OxO52b3[31]];element[OxO52b3[33]][OxO52b3[30]]=inp_height[OxO52b3[31]];} catch(er){alert(CE_GetStr(OxO52b3[45]));return false;} ;} ;var Ox492=/[^a-z\d]/i;if(Ox492.test(inp_id.value)){alert(CE_GetStr(OxO52b3[46]));return ;} ;element[OxO52b3[36]]=inp_id[OxO52b3[31]];element[OxO52b3[43]]=Align[OxO52b3[31]];element[OxO52b3[44]]=AlternateText[OxO52b3[31]];element[OxO52b3[4]]=longDesc[OxO52b3[31]];element[OxO52b3[33]][OxO52b3[40]]=bordercolor[OxO52b3[31]];if(element[OxO52b3[47]]==OxO52b3[34]||element[OxO52b3[47]]==null){element.removeAttribute(OxO52b3[47]);} ;if(element[OxO52b3[4]]==OxO52b3[34]||element[OxO52b3[4]]==null){element.removeAttribute(OxO52b3[4]);} ;if(element[OxO52b3[29]]==0){element.removeAttribute(OxO52b3[29]);} ;if(element[OxO52b3[30]]==0){element.removeAttribute(OxO52b3[30]);} ;if(element[OxO52b3[38]]==OxO52b3[34]){element.removeAttribute(OxO52b3[38]);} ;if(element[OxO52b3[37]]==OxO52b3[34]){element.removeAttribute(OxO52b3[37]);} ;if(element[OxO52b3[36]]==OxO52b3[34]){element.removeAttribute(OxO52b3[36]);} ;if(element[OxO52b3[43]]==OxO52b3[34]){element.removeAttribute(OxO52b3[43]);} ;if(element[OxO52b3[39]]==OxO52b3[34]){element.removeAttribute(OxO52b3[39]);} ;} ;function toggleConstrains(){if(constrain_prop[OxO52b3[48]]){imgLock[OxO52b3[28]]=OxO52b3[49];checkConstrains(OxO52b3[29]);} else {imgLock[OxO52b3[28]]=OxO52b3[50];} ;} ;var checkingConstrains=false;function checkConstrains(Ox51c){if(checkingConstrains){return ;} ;checkingConstrains=true;try{var Ox2b4,Ox454;if(constrain_prop[OxO52b3[48]]){var Ox503= new Image();Ox503[OxO52b3[28]]=inp_src[OxO52b3[31]];var Ox51d=Ox503[OxO52b3[29]];var Ox51e=Ox503[OxO52b3[30]];if((Ox51d>0)&&(Ox51e>0)){var Ox268=inp_width[OxO52b3[31]];var Ox47d=inp_height[OxO52b3[31]];if(Ox51c==OxO52b3[29]){if(Ox268[OxO52b3[51]]==0||isNaN(Ox268)){inp_width[OxO52b3[31]]=OxO52b3[34];inp_height[OxO52b3[31]]=OxO52b3[34];} else {Ox47d=parseInt(Ox268*Ox51e/Ox51d);inp_height[OxO52b3[31]]=Ox47d;} ;} ;if(Ox51c==OxO52b3[30]){if(Ox47d[OxO52b3[51]]==0||isNaN(Ox47d)){inp_width[OxO52b3[31]]=OxO52b3[34];inp_height[OxO52b3[31]]=OxO52b3[34];} else {Ox268=parseInt(Ox47d*Ox51d/Ox51e);inp_width[OxO52b3[31]]=Ox268;} ;} ;} ;} ;} finally{checkingConstrains=false;} ;} ;bordercolor[OxO52b3[27]]=bordercolor_Preview[OxO52b3[27]]=function bordercolor_onclick(){SelectColor(bordercolor,bordercolor_Preview);} ;