var OxOb926=["zoomcount","wheelDelta","zoom","style","0%","top","value","","onload","uploader1","browse_Frame","height","250px","contentWindow","btn_CreateDir","btn_zoom_in","btn_zoom_out","btn_bestfit","btn_Actualsize","divpreview","img_demo","Align","Border","bordercolor","bordercolor_Preview","inp_width","imgLock","inp_height","constrain_prop","HSpace","VSpace","TargetUrl","AlternateText","inp_id","longDesc","fieldsetUpload","Button1","Button2","img","editor","src","src_cetemp","width","id","vspace","hspace","border","borderColor"," ","backgroundColor","align","alt","file","complete","../Images/1x1.gif","?","\x26time=","?time=","0","onmousewheel","Edit","longdesc","Code","parentNode","=\x22","\x22","checked","../Images/locked.gif","length","onclick","display","none","wrapupPrompt","iepromptfield","body","div","IEPromptBox","promptBlackout","1px solid #b0bec7","#f0f0f0","position","absolute","330px","zIndex","100","\x3Cdiv style=\x22width: 100%; padding-top:3px;background-color: #DCE7EB; font-family: verdana; font-size: 10pt; font-weight: bold; height: 22px; text-align:center; background:url(../Images/formbg2.gif) repeat-x left top;\x22\x3E","\x3C/div\x3E","\x3Cdiv style=\x22padding: 10px\x22\x3E","\x3CBR\x3E\x3CBR\x3E","\x3Cform action=\x22\x22 onsubmit=\x22return wrapupPrompt()\x22\x3E","\x3Cinput id=\x22iepromptfield\x22 name=\x22iepromptdata\x22 type=text size=46 value=\x22","\x22\x3E","\x3Cbr\x3E\x3Cbr\x3E\x3Ccenter\x3E","\x3Cinput type=\x22submit\x22 value=\x22\x26nbsp;\x26nbsp;\x26nbsp;","\x26nbsp;\x26nbsp;\x26nbsp;\x22\x3E","\x26nbsp;\x26nbsp;\x26nbsp;\x26nbsp;\x26nbsp;\x26nbsp;","\x3Cinput type=\x22button\x22 onclick=\x22wrapupPrompt(true)\x22 value=\x22\x26nbsp;","\x26nbsp;\x22\x3E","\x3C/form\x3E\x3C/div\x3E","innerHTML","100px","left","offsetWidth","px","block","onmouseover","CuteEditor_ColorPicker_ButtonOver(this)"];function OnImageMouseWheel(){var Ox44c=Event_GetEvent();var img=Event_GetSrcElement(Ox44c);var Ox506=img[OxOb926[0]]||3;if(Ox44c[OxOb926[1]]>=106){Ox506++;} else {if(Ox44c[OxOb926[1]]<=-106){Ox506--;} ;} ;img[OxOb926[0]]=Ox506;img[OxOb926[3]][OxOb926[2]]=Ox506+OxOb926[4];return false;} ;function Window_GetDialogTop(Ox2bf){return Ox2bf[OxOb926[5]];} ;function row_click(Ox4c4){TargetUrl[OxOb926[6]]=Ox4c4;Actualsize();} ;function do_preview(){} ;function reset_hiddens(){if(TargetUrl[OxOb926[6]]!=OxOb926[7]&&TargetUrl[OxOb926[6]]!=null){do_preview();} ;} ;Event_Attach(window,OxOb926[8],reset_hiddens);function RequireFileBrowseScript(){} ;function Actualsize(){} ;RequireFileBrowseScript();var uploader1=Window_GetElement(window,OxOb926[9],true);var browse_Frame=Window_GetElement(window,OxOb926[10],true);if(!Browser_IsWinIE()){browse_Frame[OxOb926[3]][OxOb926[11]]=OxOb926[12];} ;browse_Frame=browse_Frame[OxOb926[13]];var btn_CreateDir=Window_GetElement(window,OxOb926[14],true);var btn_zoom_in=Window_GetElement(window,OxOb926[15],true);var btn_zoom_out=Window_GetElement(window,OxOb926[16],true);var btn_bestfit=Window_GetElement(window,OxOb926[17],true);var btn_Actualsize=Window_GetElement(window,OxOb926[18],true);var divpreview=Window_GetElement(window,OxOb926[19],true);var img_demo=Window_GetElement(window,OxOb926[20],true);var Align=Window_GetElement(window,OxOb926[21],true);var Border=Window_GetElement(window,OxOb926[22],true);var bordercolor=Window_GetElement(window,OxOb926[23],true);var bordercolor_Preview=Window_GetElement(window,OxOb926[24],true);var inp_width=Window_GetElement(window,OxOb926[25],true);var imgLock=Window_GetElement(window,OxOb926[26],true);var inp_height=Window_GetElement(window,OxOb926[27],true);var constrain_prop=Window_GetElement(window,OxOb926[28],true);var HSpace=Window_GetElement(window,OxOb926[29],true);var VSpace=Window_GetElement(window,OxOb926[30],true);var TargetUrl=Window_GetElement(window,OxOb926[31],true);var AlternateText=Window_GetElement(window,OxOb926[32],true);var inp_id=Window_GetElement(window,OxOb926[33],true);var longDesc=Window_GetElement(window,OxOb926[34],true);var fieldsetUpload=Window_GetElement(window,OxOb926[35],true);var Button1=Window_GetElement(window,OxOb926[36],true);var Button2=Window_GetElement(window,OxOb926[37],true);var btn_zoom_in=Window_GetElement(window,OxOb926[15],true);var btn_zoom_out=Window_GetElement(window,OxOb926[16],true);var btn_Actualsize=Window_GetElement(window,OxOb926[18],true);var btn_bestfit=Window_GetElement(window,OxOb926[17],true);var CreateDir=Window_GetElement(window,OxOb926[14],true);var obj=Window_GetDialogArguments(window);var element=obj[OxOb926[38]];var editor=obj[OxOb926[39]];var src=OxOb926[7];if(element.getAttribute(OxOb926[40])){src=element.getAttribute(OxOb926[40]);} ;if(element.getAttribute(OxOb926[41])){src=element.getAttribute(OxOb926[41]);} ;if(element&&src){TargetUrl[OxOb926[6]]=src;} ;inp_width[OxOb926[6]]=element[OxOb926[42]]||OxOb926[7];inp_height[OxOb926[6]]=element[OxOb926[11]]||OxOb926[7];inp_id[OxOb926[6]]=element[OxOb926[43]]||OxOb926[7];if(element[OxOb926[44]]<=0){VSpace[OxOb926[6]]=OxOb926[7];} else {VSpace[OxOb926[6]]=element[OxOb926[44]];} ;if(element[OxOb926[45]]<=0){HSpace[OxOb926[6]]=OxOb926[7];} else {HSpace[OxOb926[6]]=element[OxOb926[45]];} ;Border[OxOb926[6]]=element[OxOb926[46]]||OxOb926[7];if(Browser_IsWinIE()){bordercolor[OxOb926[6]]=element[OxOb926[3]][OxOb926[47]];} else {var arr=revertColor(element[OxOb926[3]].borderColor).split(OxOb926[48]);bordercolor[OxOb926[6]]=arr[0];} ;bordercolor[OxOb926[3]][OxOb926[49]]=bordercolor[OxOb926[6]]||OxOb926[7];bordercolor_Preview[OxOb926[3]][OxOb926[49]]=bordercolor[OxOb926[6]]||OxOb926[7];Align[OxOb926[6]]=element[OxOb926[50]]||OxOb926[7];AlternateText[OxOb926[6]]=element[OxOb926[51]]||OxOb926[7];longDesc[OxOb926[6]]=element[OxOb926[34]]||OxOb926[7];var sCheckFlag=OxOb926[52];function ResetFields(){TargetUrl[OxOb926[6]]=OxOb926[7];inp_width[OxOb926[6]]=OxOb926[7];inp_height[OxOb926[6]]=OxOb926[7];inp_id[OxOb926[6]]=OxOb926[7];VSpace[OxOb926[6]]=OxOb926[7];HSpace[OxOb926[6]]=OxOb926[7];Border[OxOb926[6]]=OxOb926[7];bordercolor[OxOb926[6]]=OxOb926[7];bordercolor[OxOb926[3]][OxOb926[49]]=OxOb926[7];Align[OxOb926[6]]=OxOb926[7];AlternateText[OxOb926[6]]=OxOb926[7];longDesc[OxOb926[6]]=OxOb926[7];} ;function do_preview(){var Ox350=TargetUrl[OxOb926[6]];if(Ox350==null){TargetUrl[OxOb926[6]]=OxOb926[7];Ox350==OxOb926[7];} ;if(Ox350!=null&&Ox350!=OxOb926[7]){var Ox514;var Ox515;var Ox514= new Image();Ox514[OxOb926[40]]=Ox350;function Ox516(){if(Ox514[OxOb926[53]]){window.clearInterval(Ox515);var Ox517= new Date();var Ox518=Ox517.getTime();if(Ox350==OxOb926[7]){Ox350=OxOb926[54];} ;if(Ox350.indexOf(OxOb926[55])!=-1){Ox350=Ox350+OxOb926[56]+Ox518;} else {Ox350=Ox350+OxOb926[57]+Ox518;} ;if(inp_width[OxOb926[6]]==OxOb926[58]||inp_width[OxOb926[6]]==OxOb926[7]){inp_width[OxOb926[6]]=Ox514[OxOb926[42]];inp_height[OxOb926[6]]=Ox514[OxOb926[11]];} ;img_demo[OxOb926[40]]=Ox350;if(Browser_IsWinIE()){Event_Attach(img_demo,OxOb926[59],OnImageMouseWheel);} ;img_demo[OxOb926[51]]=AlternateText[OxOb926[6]];img_demo[OxOb926[50]]=Align[OxOb926[6]];img_demo[OxOb926[42]]=inp_width[OxOb926[6]];img_demo[OxOb926[11]]=inp_height[OxOb926[6]];img_demo[OxOb926[44]]=VSpace[OxOb926[6]];img_demo[OxOb926[45]]=HSpace[OxOb926[6]];if(parseInt(Border.value)>0){img_demo[OxOb926[46]]=Border[OxOb926[6]];} ;if(bordercolor[OxOb926[6]]!=OxOb926[7]){img_demo[OxOb926[3]][OxOb926[47]]=bordercolor[OxOb926[6]];} ;Ox350=Ox350.toLowerCase();} ;} ;Ox515=window.setInterval(Ox516,100);} ;} ;function do_insert(){var img=element;img[OxOb926[40]]=TargetUrl[OxOb926[6]];if(editor.GetActiveTab()==OxOb926[60]){img.setAttribute(OxOb926[41],TargetUrl.value);} ;img[OxOb926[42]]=inp_width[OxOb926[6]];img[OxOb926[11]]=inp_height[OxOb926[6]];if(img[OxOb926[3]][OxOb926[42]]||img[OxOb926[3]][OxOb926[11]]){img[OxOb926[3]][OxOb926[42]]=inp_width[OxOb926[6]];img[OxOb926[3]][OxOb926[11]]=inp_height[OxOb926[6]];} ;img[OxOb926[44]]=VSpace[OxOb926[6]];img[OxOb926[45]]=HSpace[OxOb926[6]];img[OxOb926[46]]=Border[OxOb926[6]];var Ox492=/[^a-z\d]/i;if(Ox492.test(inp_id.value)){alert(ValidID);return ;} ;img[OxOb926[43]]=inp_id[OxOb926[6]];try{img[OxOb926[3]][OxOb926[47]]=bordercolor[OxOb926[6]];} catch(er){alert(ValidColor);return false;} ;img[OxOb926[50]]=Align[OxOb926[6]];img[OxOb926[51]]=AlternateText[OxOb926[6]]||OxOb926[7];img[OxOb926[34]]=longDesc[OxOb926[6]];if(TargetUrl[OxOb926[6]]==OxOb926[7]){alert(SelectImagetoInsert);return false;} ;if(img[OxOb926[42]]==0){img.removeAttribute(OxOb926[42]);} ;if(img[OxOb926[11]]==0){img.removeAttribute(OxOb926[11]);} ;if(img[OxOb926[61]]==OxOb926[7]||img[OxOb926[61]]==null){img.removeAttribute(OxOb926[61]);} ;if(img[OxOb926[34]]==OxOb926[7]||img[OxOb926[34]]==null){img.removeAttribute(OxOb926[34]);} ;if(img[OxOb926[45]]==OxOb926[7]){img.removeAttribute(OxOb926[45]);} ;if(img[OxOb926[44]]==OxOb926[7]){img.removeAttribute(OxOb926[44]);} ;if(img[OxOb926[43]]==OxOb926[7]){img.removeAttribute(OxOb926[43]);} ;if(img[OxOb926[46]]==OxOb926[7]){img.removeAttribute(OxOb926[46]);} ;if(img[OxOb926[50]]==OxOb926[7]){img.removeAttribute(OxOb926[50]);} ;if(editor.GetActiveTab()==OxOb926[62]){if(Browser_IsWinIE()){editor.PasteHTML(img.outerHTML);} else {editor.PasteHTML(outerHTML(img));} ;} else {if(!img[OxOb926[63]]){editor.InsertElement(img);} ;} ;Window_CloseDialog(window);} ;function attr(name,Ox23f){if(!Ox23f||Ox23f==OxOb926[7]){return OxOb926[7];} ;return OxOb926[48]+name+OxOb926[64]+Ox23f+OxOb926[65];} ;function do_Close(){Window_CloseDialog(window);} ;function Zoom_In(){if(Browser_IsWinIE()){if(divpreview[OxOb926[3]][OxOb926[2]]!=0){divpreview[OxOb926[3]][OxOb926[2]]*=1.2;} else {divpreview[OxOb926[3]][OxOb926[2]]=1.2;} ;} ;} ;function Zoom_Out(){if(Browser_IsWinIE()){if(divpreview[OxOb926[3]][OxOb926[2]]!=0){divpreview[OxOb926[3]][OxOb926[2]]*=0.8;} else {divpreview[OxOb926[3]][OxOb926[2]]=0.8;} ;} ;} ;function BestFit(){var img=img_demo;if(!img){return ;} ;var Ox47d=280;var Ox268=290;if(Browser_IsWinIE()){divpreview[OxOb926[3]][OxOb926[2]]=1/Math.max(img[OxOb926[42]]/Ox268,img[OxOb926[11]]/Ox47d);} ;} ;function Actualsize(){inp_width[OxOb926[6]]=OxOb926[7];inp_height[OxOb926[6]]=OxOb926[7];do_preview();if(Browser_IsWinIE()){divpreview[OxOb926[3]][OxOb926[2]]=1;} ;} ;function toggleConstrains(){if(constrain_prop[OxOb926[66]]){imgLock[OxOb926[40]]=OxOb926[67];checkConstrains(OxOb926[42]);} else {imgLock[OxOb926[40]]=OxOb926[54];} ;} ;var checkingConstrains=false;function checkConstrains(Ox51c){if(checkingConstrains){return ;} ;checkingConstrains=true;try{if(constrain_prop[OxOb926[66]]){var Ox503= new Image();Ox503[OxOb926[40]]=TargetUrl[OxOb926[6]];var Ox51d=Ox503[OxOb926[42]];var Ox51e=Ox503[OxOb926[11]];if((Ox51d>0)&&(Ox51e>0)){var Ox268=inp_width[OxOb926[6]];var Ox47d=inp_height[OxOb926[6]];if(Ox51c==OxOb926[42]){if(Ox268[OxOb926[68]]==0||isNaN(Ox268)){inp_width[OxOb926[6]]=OxOb926[7];inp_height[OxOb926[6]]=OxOb926[7];} else {Ox47d=parseInt(Ox268*Ox51e/Ox51d);inp_height[OxOb926[6]]=Ox47d;} ;} ;if(Ox51c==OxOb926[11]){if(Ox47d[OxOb926[68]]==0||isNaN(Ox47d)){inp_width[OxOb926[6]]=OxOb926[7];inp_height[OxOb926[6]]=OxOb926[7];} else {Ox268=parseInt(Ox47d*Ox51d/Ox51e);inp_width[OxOb926[6]]=Ox268;} ;} ;} ;} ;do_preview();} finally{checkingConstrains=false;} ;} ;function ImageEditor(){} ;bordercolor[OxOb926[69]]=bordercolor_Preview[OxOb926[69]]=function bordercolor_onclick(){SelectColor(bordercolor,bordercolor_Preview);} ;if(!Browser_IsWinIE()){btn_zoom_in[OxOb926[3]][OxOb926[70]]=btn_zoom_out[OxOb926[3]][OxOb926[70]]=btn_bestfit[OxOb926[3]][OxOb926[70]]=btn_Actualsize[OxOb926[3]][OxOb926[70]]=OxOb926[71];} ;if(Browser_IsIE7()){var _dialogPromptID=null;function IEprompt(Ox337,Ox338,Ox339){that=this;this[OxOb926[72]]=function (Ox33a){val=document.getElementById(OxOb926[73])[OxOb926[6]];_dialogPromptID[OxOb926[3]][OxOb926[70]]=OxOb926[71];document.getElementById(OxOb926[73])[OxOb926[6]]=OxOb926[7];if(Ox33a){val=OxOb926[7];} ;Ox337(val);return false;} ;if(Ox339==undefined){Ox339=OxOb926[7];} ;if(_dialogPromptID==null){var Ox33b=document.getElementsByTagName(OxOb926[74])[0];tnode=document.createElement(OxOb926[75]);tnode[OxOb926[43]]=OxOb926[76];Ox33b.appendChild(tnode);_dialogPromptID=document.getElementById(OxOb926[76]);tnode=document.createElement(OxOb926[75]);tnode[OxOb926[43]]=OxOb926[77];Ox33b.appendChild(tnode);_dialogPromptID[OxOb926[3]][OxOb926[46]]=OxOb926[78];_dialogPromptID[OxOb926[3]][OxOb926[49]]=OxOb926[79];_dialogPromptID[OxOb926[3]][OxOb926[80]]=OxOb926[81];_dialogPromptID[OxOb926[3]][OxOb926[42]]=OxOb926[82];_dialogPromptID[OxOb926[3]][OxOb926[83]]=OxOb926[84];} ;var Ox33c=OxOb926[85]+InputRequired+OxOb926[86];Ox33c+=OxOb926[87]+Ox338+OxOb926[88];Ox33c+=OxOb926[89];Ox33c+=OxOb926[90]+Ox339+OxOb926[91];Ox33c+=OxOb926[92];Ox33c+=OxOb926[93]+OK+OxOb926[94];Ox33c+=OxOb926[95];Ox33c+=OxOb926[96]+Cancel+OxOb926[97];Ox33c+=OxOb926[98];_dialogPromptID[OxOb926[99]]=Ox33c;_dialogPromptID[OxOb926[3]][OxOb926[5]]=OxOb926[100];_dialogPromptID[OxOb926[3]][OxOb926[101]]=parseInt((document[OxOb926[74]][OxOb926[102]]-315)/2)+OxOb926[103];_dialogPromptID[OxOb926[3]][OxOb926[70]]=OxOb926[104];var Ox33d=document.getElementById(OxOb926[73]);try{var Ox33e=Ox33d.createTextRange();Ox33e.collapse(false);Ox33e.select();} catch(x){Ox33d.focus();} ;} ;} ;if(CreateDir){CreateDir[OxOb926[105]]= new Function(OxOb926[106]);} ;if(btn_zoom_in){btn_zoom_in[OxOb926[105]]= new Function(OxOb926[106]);} ;if(btn_zoom_out){btn_zoom_out[OxOb926[105]]= new Function(OxOb926[106]);} ;if(btn_Actualsize){btn_Actualsize[OxOb926[105]]= new Function(OxOb926[106]);} ;if(btn_bestfit){btn_bestfit[OxOb926[105]]= new Function(OxOb926[106]);} ;