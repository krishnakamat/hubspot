if(typeof _STNS!="undefined")
{
	function stGetMessage(s,a)
	{
		var _r=_STNS;
			if(_STNS._aStData[0])
			{
				switch(s)
				{
					case "CUR_SIZE":
						var e=_r.fdmGetEleById(_STNS._aStData[0].sUid);
						if(e)
							stSendMessage("CUR_SIZE["+e.offsetWidth+","+e.offsetHeight+"]");
						else
							stSendMessage("CUR_SIZE[0,0]");
						break;
				}
			}
	};
	function stSendMessage(s)
	{
		location.assign("DMM:"+s);
	};
}