<center><h1>All Regions</h1></center><br/>
<table class="listingtable">
<tr>
<th class="listingtable">RegionName</th>
<th class="listingtable">RegionID</th>
<th class="listingtable">Scope ID</th>
<th class="listingtable">Location</th>
<th class="listingtable">Size</th>
<th class="listingtable">Online</th>
<th class="listingtable">Flags</th>
<th class="listingtable">Actions</th>
</tr>
<?php
require_once("lib/types/RegionInfo.php");

$gridService = getService("Grid");
$regions = $gridService->getAllRegions();
while($region = $regions->getRegion())
{
	echo "<tr>";
	echo "<td class=\"listingtable\">".htmlentities($region->RegionName)."</td>";
	echo "<td class=\"listingtable\">".$region->Uuid."</td>";
	echo "<td class=\"listingtable\">".$region->ScopeID."</td>";
	echo "<td class=\"listingtable\">".$region->LocX.",".$region->LocY."</td>";
	echo "<td class=\"listingtable\">".$region->SizeX.",".$region->SizeY."</td>";
	if($region->Flags & RegionFlags::RegionOnline)
	{
		echo "<td class=\"listingtable\">yes</td>";
	}
	else
	{
		echo "<td class=\"listingtable\">no</td>";
	}
	echo "<td class=\"listingtable\">";
	$flagstr = "";
	if($region->Flags & RegionFlags::DefaultRegion)
		$flagstr.="DefaultRegion ";
	if($region->Flags & RegionFlags::FallbackRegion)
		$flagstr.="FallbackRegion ";
	if($region->Flags & RegionFlags::NoDirectLogin)
		$flagstr.="NoDirectLogin ";
	if($region->Flags & RegionFlags::Persistent)
		$flagstr.="Persistent ";
	if($region->Flags & RegionFlags::LockedOut)
		$flagstr.="LockedOut ";
	if($region->Flags & RegionFlags::NoMove)
		$flagstr.="NoMove ";
	if($region->Flags & RegionFlags::Reservation)
		$flagstr.="Reservation ";
	if($region->Flags & RegionFlags::Authenticate)
		$flagstr.="Authenticate ";
	if($region->Flags & RegionFlags::Hyperlink)
		$flagstr.="Hyperlink ";
	if($region->Flags & RegionFlags::DefaultHGRegion)
		$flagstr.="DefaultHGRegion ";
	if(($region->Flags & RegionFlags::RegionOnline) == $region->Flags)
		$flagstr = "&lt;none&gt;";
	echo trim($flagstr);
	echo "</td>";
	echo "<td>";
?>
<form action="/admin/" method="GET">
<input type="hidden" name="page" value="show_region"/>
<input type="hidden" name="regionid" value="<?php echo $region->Uuid; ?>"/>
<input type="submit" name="Show" value="Show"/>
</form>
<?php
	echo "</td>";
	echo "</tr>";
}
?>
</table>
