var OxOdee8=["inp_width","inp_height","sel_align","sel_valign","inp_bgColor","inp_borderColor","inp_borderColorLight","inp_borderColorDark","inp_class","inp_id","inp_tooltip","sel_noWrap","sel_CellScope","value","bgColor","backgroundColor","style","","id","borderColor","borderColorLight","borderColorDark","className","width","height","align","vAlign","title","noWrap","scope","ValidNumber","ValidID","class","valign","onclick"];var inp_width=Window_GetElement(window,OxOdee8[0],true);var inp_height=Window_GetElement(window,OxOdee8[1],true);var sel_align=Window_GetElement(window,OxOdee8[2],true);var sel_valign=Window_GetElement(window,OxOdee8[3],true);var inp_bgColor=Window_GetElement(window,OxOdee8[4],true);var inp_borderColor=Window_GetElement(window,OxOdee8[5],true);var inp_borderColorLight=Window_GetElement(window,OxOdee8[6],true);var inp_borderColorDark=Window_GetElement(window,OxOdee8[7],true);var inp_class=Window_GetElement(window,OxOdee8[8],true);var inp_id=Window_GetElement(window,OxOdee8[9],true);var inp_tooltip=Window_GetElement(window,OxOdee8[10],true);var sel_noWrap=Window_GetElement(window,OxOdee8[11],true);var sel_CellScope=Window_GetElement(window,OxOdee8[12],true);SyncToView=function SyncToView_Td(){inp_bgColor[OxOdee8[13]]=element.getAttribute(OxOdee8[14])||element[OxOdee8[16]][OxOdee8[15]]||OxOdee8[17];inp_id[OxOdee8[13]]=element.getAttribute(OxOdee8[18])||OxOdee8[17];inp_bgColor[OxOdee8[16]][OxOdee8[15]]=inp_bgColor[OxOdee8[13]];inp_borderColor[OxOdee8[13]]=element.getAttribute(OxOdee8[19])||OxOdee8[17];inp_borderColor[OxOdee8[16]][OxOdee8[15]]=inp_borderColor[OxOdee8[13]];inp_borderColorLight[OxOdee8[13]]=element.getAttribute(OxOdee8[20])||OxOdee8[17];inp_borderColorLight[OxOdee8[16]][OxOdee8[15]]=inp_borderColorLight[OxOdee8[13]];inp_borderColorDark[OxOdee8[13]]=element.getAttribute(OxOdee8[21])||OxOdee8[17];inp_borderColorDark[OxOdee8[16]][OxOdee8[15]]=inp_borderColorDark[OxOdee8[13]];inp_class[OxOdee8[13]]=element[OxOdee8[22]];inp_width[OxOdee8[13]]=element.getAttribute(OxOdee8[23])||element[OxOdee8[16]][OxOdee8[23]]||OxOdee8[17];inp_height[OxOdee8[13]]=element.getAttribute(OxOdee8[24])||element[OxOdee8[16]][OxOdee8[24]]||OxOdee8[17];sel_align[OxOdee8[13]]=element.getAttribute(OxOdee8[25])||OxOdee8[17];sel_valign[OxOdee8[13]]=element.getAttribute(OxOdee8[26])||OxOdee8[17];inp_tooltip[OxOdee8[13]]=element.getAttribute(OxOdee8[27])||OxOdee8[17];sel_noWrap[OxOdee8[13]]=element.getAttribute(OxOdee8[28])||OxOdee8[17];sel_CellScope[OxOdee8[13]]=element.getAttribute(OxOdee8[29])||OxOdee8[17];} ;SyncTo=function SyncTo_Td(element){if(inp_bgColor[OxOdee8[13]]){if(element[OxOdee8[16]][OxOdee8[15]]){element[OxOdee8[16]][OxOdee8[15]]=inp_bgColor[OxOdee8[13]];} else {element[OxOdee8[14]]=inp_bgColor[OxOdee8[13]];} ;} else {element.removeAttribute(OxOdee8[14]);} ;element[OxOdee8[19]]=inp_borderColor[OxOdee8[13]];element[OxOdee8[20]]=inp_borderColorLight[OxOdee8[13]];element[OxOdee8[21]]=inp_borderColorDark[OxOdee8[13]];element[OxOdee8[22]]=inp_class[OxOdee8[13]];if(element[OxOdee8[16]][OxOdee8[23]]||element[OxOdee8[16]][OxOdee8[24]]){try{element[OxOdee8[16]][OxOdee8[23]]=inp_width[OxOdee8[13]];element[OxOdee8[16]][OxOdee8[24]]=inp_height[OxOdee8[13]];} catch(er){alert(CE_GetStr(OxOdee8[30]));} ;} else {try{element[OxOdee8[23]]=inp_width[OxOdee8[13]];element[OxOdee8[24]]=inp_height[OxOdee8[13]];} catch(er){alert(CE_GetStr(OxOdee8[30]));} ;} ;var Ox492=/[^a-z\d]/i;if(Ox492.test(inp_id.value)){alert(CE_GetStr(OxOdee8[31]));return ;} ;element[OxOdee8[25]]=sel_align[OxOdee8[13]];element[OxOdee8[18]]=inp_id[OxOdee8[13]];element[OxOdee8[26]]=sel_valign[OxOdee8[13]];element[OxOdee8[28]]=sel_noWrap[OxOdee8[13]];element[OxOdee8[27]]=inp_tooltip[OxOdee8[13]];element[OxOdee8[29]]=sel_CellScope[OxOdee8[13]];if(element[OxOdee8[18]]==OxOdee8[17]){element.removeAttribute(OxOdee8[18]);} ;if(element[OxOdee8[29]]==OxOdee8[17]){element.removeAttribute(OxOdee8[29]);} ;if(element[OxOdee8[28]]==OxOdee8[17]){element.removeAttribute(OxOdee8[28]);} ;if(element[OxOdee8[14]]==OxOdee8[17]){element.removeAttribute(OxOdee8[14]);} ;if(element[OxOdee8[19]]==OxOdee8[17]){element.removeAttribute(OxOdee8[19]);} ;if(element[OxOdee8[20]]==OxOdee8[17]){element.removeAttribute(OxOdee8[20]);} ;if(element[OxOdee8[7]]==OxOdee8[17]){element.removeAttribute(OxOdee8[7]);} ;if(element[OxOdee8[22]]==OxOdee8[17]){element.removeAttribute(OxOdee8[22]);} ;if(element[OxOdee8[22]]==OxOdee8[17]){element.removeAttribute(OxOdee8[32]);} ;if(element[OxOdee8[25]]==OxOdee8[17]){element.removeAttribute(OxOdee8[25]);} ;if(element[OxOdee8[26]]==OxOdee8[17]){element.removeAttribute(OxOdee8[33]);} ;if(element[OxOdee8[27]]==OxOdee8[17]){element.removeAttribute(OxOdee8[27]);} ;if(element[OxOdee8[23]]==OxOdee8[17]){element.removeAttribute(OxOdee8[23]);} ;if(element[OxOdee8[24]]==OxOdee8[17]){element.removeAttribute(OxOdee8[24]);} ;} ;inp_borderColor[OxOdee8[34]]=function inp_borderColor_onclick(){SelectColor(inp_borderColor);} ;inp_bgColor[OxOdee8[34]]=function inp_bgColor_onclick(){SelectColor(inp_bgColor);} ;inp_borderColorLight[OxOdee8[34]]=function inp_borderColorLight_onclick(){SelectColor(inp_borderColorLight);} ;inp_borderColorDark[OxOdee8[34]]=function inp_borderColorDark_onclick(){SelectColor(inp_borderColorDark);} ;