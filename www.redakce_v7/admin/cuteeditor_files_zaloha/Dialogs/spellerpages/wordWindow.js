var OxOd286=["_forms","_getWordObject","_wordInputStr","_adjustIndexes","_isWordChar","_lastPos","wordChar","windowType","wordWindow","originalSpellings","suggestions","checkWordBgColor","pink","normWordBgColor","white","text","","textInputs","indexes","resetForm","totalMisspellings","totalWords","totalPreviousWords","getTextVal","setFocus","removeFocus","setText","writeBody","printForHtml","length","value","type","backgroundColor","style","size","document","\x3Cform name=\x22textInput","\x22\x3E","\x3Cdiv class=\x22plainText\x22\x3E","\x3C/div\x3E","\x3C/form\x3E","forms","elements","\x3Cinput readonly ","class=\x22blend\x22 type=\x22text\x22 value=\x22","\x22 size=\x22"];function wordWindow(){this[OxOd286[0]]=[];this[OxOd286[1]]=_getWordObject;this[OxOd286[2]]=_wordInputStr;this[OxOd286[3]]=_adjustIndexes;this[OxOd286[4]]=_isWordChar;this[OxOd286[5]]=_lastPos;this[OxOd286[6]]=/[a-zA-Z]/;this[OxOd286[7]]=OxOd286[8];this[OxOd286[9]]= new Array();this[OxOd286[10]]= new Array();this[OxOd286[11]]=OxOd286[12];this[OxOd286[13]]=OxOd286[14];this[OxOd286[15]]=OxOd286[16];this[OxOd286[17]]= new Array();this[OxOd286[18]]= new Array();this[OxOd286[19]]=resetForm;this[OxOd286[20]]=totalMisspellings;this[OxOd286[21]]=totalWords;this[OxOd286[22]]=totalPreviousWords;this[OxOd286[23]]=getTextVal;this[OxOd286[24]]=setFocus;this[OxOd286[25]]=removeFocus;this[OxOd286[26]]=setText;this[OxOd286[27]]=writeBody;this[OxOd286[28]]=printForHtml;} ;function resetForm(){if(this[OxOd286[0]]){for(var i=0;i<this[OxOd286[0]][OxOd286[29]];i++){this[OxOd286[0]][i].reset();} ;} ;return true;} ;function totalMisspellings(){var Ox218=0;for(var i=0;i<this[OxOd286[17]][OxOd286[29]];i++){Ox218+=this.totalWords(i);} ;return Ox218;} ;function totalWords(Ox21a){return this[OxOd286[9]][Ox21a][OxOd286[29]];} ;function totalPreviousWords(Ox21a,Ox21c){var Ox218=0;for(var i=0;i<=Ox21a;i++){for(var Ox1e2=0;Ox1e2<this.totalWords(i);Ox1e2++){if(i==Ox21a&&Ox1e2==Ox21c){break ;} else {Ox218++;} ;} ;} ;return Ox218;} ;function getTextVal(Ox21a,Ox21c){var Ox21e=this._getWordObject(Ox21a,Ox21c);if(Ox21e){return Ox21e[OxOd286[30]];} ;} ;function setFocus(Ox21a,Ox21c){var Ox21e=this._getWordObject(Ox21a,Ox21c);if(Ox21e){if(Ox21e[OxOd286[31]]==OxOd286[15]){Ox21e.focus();Ox21e[OxOd286[33]][OxOd286[32]]=this[OxOd286[11]];} ;} ;} ;function removeFocus(Ox21a,Ox21c){var Ox21e=this._getWordObject(Ox21a,Ox21c);if(Ox21e){if(Ox21e[OxOd286[31]]==OxOd286[15]){Ox21e.blur();Ox21e[OxOd286[33]][OxOd286[32]]=this[OxOd286[13]];} ;} ;} ;function setText(Ox21a,Ox21c,Ox212){var Ox21e=this._getWordObject(Ox21a,Ox21c);var Ox222;var Ox223;if(Ox21e){var Ox224=this[OxOd286[18]][Ox21a][Ox21c];var Ox225=Ox21e[OxOd286[30]];Ox222=this[OxOd286[17]][Ox21a].substring(0,Ox224);Ox223=this[OxOd286[17]][Ox21a].substring(Ox224+Ox225[OxOd286[29]],this[OxOd286[17]][Ox21a].length);this[OxOd286[17]][Ox21a]=Ox222+Ox212+Ox223;var Ox226=Ox212[OxOd286[29]]-Ox225[OxOd286[29]];this._adjustIndexes(Ox21a,Ox21c,Ox226);Ox21e[OxOd286[34]]=Ox212[OxOd286[29]];Ox21e[OxOd286[30]]=Ox212;this.removeFocus(Ox21a,Ox21c);} ;} ;function writeBody(){var Ox228=window[OxOd286[35]];var Ox229=false;Ox228.open();for(var Ox22a=0;Ox22a<this[OxOd286[17]][OxOd286[29]];Ox22a++){var Ox22b=0;var Ox22c=0;Ox228.writeln(OxOd286[36]+Ox22a+OxOd286[37]);var Ox22d=this[OxOd286[17]][Ox22a];this[OxOd286[18]][Ox22a]=[];if(Ox22d){var Ox22e=this[OxOd286[9]][Ox22a];if(!Ox22e){break ;} ;Ox228.writeln(OxOd286[38]);for(var i=0;i<Ox22e[OxOd286[29]];i++){do{Ox22c=Ox22d.indexOf(Ox22e[i],Ox22b);Ox22b=Ox22c+Ox22e[i][OxOd286[29]];if(Ox22c==-1){break ;} ;var Ox22f=Ox22d.charAt(Ox22c-1);var Ox230=Ox22d.charAt(Ox22b);} while(this._isWordChar(Ox22f)||this._isWordChar(Ox230));;this[OxOd286[18]][Ox22a][i]=Ox22c;for(var Ox1e2=this._lastPos(Ox22a,i);Ox1e2<Ox22c;Ox1e2++){Ox228.write(this.printForHtml(Ox22d.charAt(Ox1e2)));} ;Ox228.write(this._wordInputStr(Ox22e[i]));if(i==Ox22e[OxOd286[29]]-1){Ox228.write(printForHtml(Ox22d.substr(Ox22b)));} ;} ;Ox228.writeln(OxOd286[39]);} ;Ox228.writeln(OxOd286[40]);} ;this[OxOd286[0]]=Ox228[OxOd286[41]];Ox228.close();} ;function _lastPos(Ox22a,Ox202){if(Ox202>0){return this[OxOd286[18]][Ox22a][Ox202-1]+this[OxOd286[9]][Ox22a][Ox202-1][OxOd286[29]];} else {return 0;} ;} ;function printForHtml(Ox233){return Ox233;} ;function _isWordChar(Ox235){if(Ox235.search(this.wordChar)==-1){return false;} else {return true;} ;} ;function _getWordObject(Ox21a,Ox21c){if(this[OxOd286[0]][Ox21a]){if(this[OxOd286[0]][Ox21a][OxOd286[42]][Ox21c]){return this[OxOd286[0]][Ox21a][OxOd286[42]][Ox21c];} ;} ;return null;} ;function _wordInputStr(Ox21e){var Oxe=OxOd286[43];Oxe+=OxOd286[44]+Ox21e+OxOd286[45]+Ox21e[OxOd286[29]]+OxOd286[37];return Oxe;} ;function _adjustIndexes(Ox21a,Ox21c,Ox226){for(var i=Ox21c+1;i<this[OxOd286[9]][Ox21a][OxOd286[29]];i++){this[OxOd286[18]][Ox21a][i]=this[OxOd286[18]][Ox21a][i]+Ox226;} ;} ;