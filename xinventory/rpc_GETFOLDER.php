<?php
/******************************************************************************
 * phpGridServer
 *
 * GNU LESSER GENERAL PUBLIC LICENSE
 * Version 2.1, February 1999
 *
 */

if(!isset($_RPC_REQUEST->ID))
{
	http_response_code("400");
	exit;
}

if(!UUID::IsUUID($_RPC_REQUEST->ID))
{
	http_response_code("400");
	exit;
}

$sessionID = null;
if(isset($_RPC_REQUEST->SESSIONID))
{
	if(!UUID::IsUUID($_RPC_REQUEST->SESSIONID))
	{
		http_response_code("400");
		exit;
	}
	setRpcSessionID($_RPC_REQUEST->SESSIONID);
}

header("Content-Type: text/xml");
try
{
	$principalID = $inventoryService->getPrincipalIDForFolder($_RPC_REQUEST->ID);
	$folder = $inventoryService->getFolder($principalID, $_RPC_REQUEST->ID);
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	echo "<ServerResponse>";
	echo $folder->toXML("folder", " type=\"List\"");
	echo "</ServerResponse>";
}
catch(Exception $e)
{
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?><ServerResponse/>";
}
