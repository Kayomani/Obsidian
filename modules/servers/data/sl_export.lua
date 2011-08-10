-- Title: "ServerList Export for Lannage" 
-- Description: "This plugin exports the current server list to an HTML or XML file in the given interval." 
-- Interface: 1000 
-- Type: xy 
-- Version: 1.0.0.0 
-- Author: "Olaf Reusch Modified by Kayomani" 
-- URL: http://www.hlsw.org 

optionDialog = LuaDialog() 
pathLabel = LuaLabel() 
pathEdit = LuaEdit()
intervalLabel = LuaLabel()
intervalTimeLabel = LuaLabel()
intervalEdit = LuaEdit()
typeLabel = LuaLabel()
typeComboBox = LuaComboBox()
okButton = LuaButton() 
cancelButton = LuaButton() 

-- Is called, if someone clicked on the settings button 
function OnSettings() 
	-- Get the option value and show it in the edit box 
    pathEdit:SetText(Misc.GetString("export_path"))
    intervalEdit:SetText(Misc.GetString("export_interval"))
    
    if ( Misc.GetString("export_type") == "HTML" ) then
    	typeComboBox:SetCurSel(0)
    else 
    	typeComboBox:SetCurSel(1)
    end
    -- Show the Option dialog 
    optionDialog:ShowDialog() 
end

-- Is triggered if 'ok'-button is clicked 
okButton.Clicked = function() 
    -- Get the strings from the Edit controls and save it 
    Misc.SetString("export_path", pathEdit:GetText()) 
    Misc.SetString("export_interval", intervalEdit:GetText())
    Misc.SetString("export_type", typeComboBox:GetItemText(typeComboBox:GetCurSel()))
    -- closed the dialog 
    optionDialog:HideDialog()    
end 

-- Is triggered if 'cancel'-button is clicked 
cancelButton.Clicked = function() 
    -- closed the dialog 
    optionDialog:HideDialog() 
end

function OnEvent(event) 
    if ( event == Events.EVT_APP_INIT ) then 
        Debug.Print("LUA APP INIT - export_interval: "..Misc.GetString("export_interval")) 
        
        if(not(Misc.GetString("export_interval") == nil) and
            not(Misc.GetString("export_interval") == "undef") and
            type(tonumber(Misc.GetString("export_interval")) == "number") and
            not (Misc.GetString("export_interval") == "0")) then
            interval = Misc.GetString("export_interval") * 1000
        else
            interval = 1000
        end    
            
        -- Add an event which is called every <interval> seconds and refreshs the serverlist file
        if (Misc.GetString("export_type") == "HTML") then
            Timer.AddEvent(interval, ExportHTMLServerList, TimerEvents.LOOP) 
        else 
            Timer.AddEvent(interval, ExportXMLServerList, TimerEvents.LOOP) 
        end
        
        optionDialog:Create("Export settings", {0,0,350,450}) -- Create a LuaDialog with 100x100 pixel 
       
        pathLabel:Create(optionDialog, {10,15,145,30}) -- Create an Label on the dialog
        pathLabel:SetText("Export path:") -- Set the text of the label 
        
        pathEdit:Create(optionDialog, {110,12,500,32}) -- Create an Edit on the dialog 
        
        typeLabel:Create(optionDialog, {10,41,145,61})
        typeLabel:SetText("Export type:") 
        
        typeComboBox:Create(optionDialog, {110,40,210,60})
        typeComboBox:AddString("HTML")
       	typeComboBox:AddString("XML")
        
        intervalLabel:Create(optionDialog,  {10,65,145,95})
        intervalLabel:SetText("Refresh interval:")
        
        intervalEdit:Create(optionDialog, {110,70,210,90})
        
        intervalTimeLabel:Create(optionDialog,  {215,65,260,95})
        intervalTimeLabel:SetText("seconds")

		-- Create a button to save settings and close the dialog 
        okButton:Create(optionDialog, "OK", {10,120,100,145}) 
        cancelButton:Create(optionDialog, "Cancel", {110,120,200,145})
    end 
end 

function ExportHTMLServerList()
    Debug.Print("Exporting HTML...") 

    -- Open the demo html file for writing
	file = io.open(Misc.GetString("export_path"), "w") 
	
	-- Get current serverlist
	currentServerList = ServerList.GetCurrent()
	
    -- Write the html head
	file:write("<html>\r\n\t<head>\t\t<title>"..currentServerList:GetName().." ("..currentServerList:GetCount()..")</title>\r\n\t</head>")
    file:write("<body>\r\n\t<ul>")
   
	-- Loop trough the server of the serverlist | SO = > ServerOject
	for key, currentServer in pairs(currentServerList:GetServer()) do 
	    -- Write server related stuff to the html file
	    file:write("\t\t<li>"..currentServer:GetAddr().." - "..currentServer:GetHostName().."</li>\r\n") 
	end
		
	file:write("\t</ul>\t</body></html>") -- Write the html tail
	-- Close the file
	file:close() 
end

function MakeSafe(string)
  string = string.gsub(string, "[^\x1F-\x7E]", "")
  string = string.gsub(string, ">", "")
  string = string.gsub(string, "<", "")
  return string
end

function ExportXMLServerList()
    Debug.Print("Exporting XML...") 
    -- Open the demo html file for writing
    file = io.open(Misc.GetString("export_path"), "w") 
    
    -- Get current serverlist
    currentServerList = ServerList.GetCurrent()
    
    file:write("<serverlist\n")
    -- Write the server list data 
    file:write("\tname=\""..currentServerList:GetName().."\"\n")
    file:write("\tservercount=\""..currentServerList:GetCount().."\">\n")
    -- Loop trough the server of the serverlist | SO = > ServerOject
    for key, currentServer in pairs(currentServerList:GetServer()) do 
        -- Write game server related stuff
      if ( not currentServer:GetTimeout()) then
        file:write("\t<server>\n") 
        file:write("\t\t<address>"..currentServer:GetAddr().."</address>\n")
        
        file:write("\t\t<name>"..MakeSafe(currentServer:GetHostName()).."</name>\n") 	
        file:write("\t\t<ping>0</ping>\n")
        file:write("\t\t<qport>"..currentServer:GetQueryPort().."</qport>\n") 
        file:write("\t\t<cport>"..currentServer:GetConnectPort().."</cport>\n") 	
 
        file:write("\t\t<playercount>"..currentServer:GetPlayerCount().."</playercount>\n")
        file:write("\t\t<maxplayers>"..currentServer:GetPlayerMax().."</maxplayers>\n")
        file:write("\t\t<game>"..currentServer:GetGameType().."</game>\n")
        file:write("\t\t<map>"..currentServer:GetMapName().."</map>\n")
        file:write("\t\t<players>\n");
          for i=1,currentServer:GetPlayerCount() do 
            file:write("\t\t\t<player>\n");
             file:write("\t\t\t\t<name>"..MakeSafe(currentServer:GetPlayerName(i)).."</name>\n")
             file:write("\t\t\t\t<time>"..currentServer:GetPlayerTime(i).."</time>\n")
             file:write("\t\t\t\t<frags>0</frags>\n")
            file:write("\t\t\t</player>\n");          
          end
        file:write("\t\t</players>\n");
        file:write("\t\t<rules>\n");
          for i=1,currentServer:GetRulesCount()-1 do 
            file:write("\t\t\t<rule>\n");
             file:write("\t\t\t\t<prop>"..currentServer:GetRuleKey(i).."</prop>\n")
             file:write("\t\t\t\t<value>"..currentServer:GetRuleValue(i).."</value>\n")
            file:write("\t\t\t</rule>\n");          
          end
        file:write("\t\t</rules>\n");
        file:write("\t</server>\n")
    	end
    end
    file:write("</serverlist>") 
    -- Close the file
    file:close() 
end