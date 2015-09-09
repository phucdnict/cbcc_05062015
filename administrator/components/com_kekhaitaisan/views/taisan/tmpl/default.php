<?php
defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
$items=$this->items;
$model  = Core::model('Kekhaitaisan/KktsTaisan');
$ds = $model->danhsachTaisan();
?>
<form action="<?php echo JRoute::_('index.php?option=com_kekhaitaisan&controller=taisan'); ?>" method="post" name="adminForm" id="adminForm">
	<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
			<div id="j-main-container">
		<?php endif;?>
		
	<div style="clear:both;padding:5px"></div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="nowrap center">
                    <input type="checkbox" name="toggle" value="" onclick="checkAll();" />
                </th>
                <th class="title">Tên loại tài sản</th>
                <th style="width:5px" class="nowrap center">Thứ tự</th>
                <th style="width:5px" class="nowrap center">Type</th>
                <th style="width:5px" class="nowrap center">Parent</th>
                <th style="width:5px" class="nowrap center">Trạng thái</th>
                <th style="width:5px" class="nowrap center">id</th>
            </tr>
        </thead>
        <tbody>
	        <?php
	        $stt=0;
	        for($i=0; $i< sizeof($ds);$i++){
				$row = $ds[$i];
				$checked 	= JHTML::_('grid.id',$i, $row->id);
				$link 		= JRoute::_( 'index.php?option=com_kekhaitaisan&controller=taisan&task=edit&id='.$row->id );
				$published 	= JHTML::_('jgrid.published', $row->status, $stt );
// 	        	echo ' <tr><td><a href="index.php?option=com_kekhaitaisan&controller=taisan&task=edit&id='.$row->id.'">-*- '.$row->tenloaitaisan.'</a></td></tr>';
	        	?>
	        	<tr class="<?php echo "row$stt"; ?>">
		            <td style="width: 30px;" class="center">
		                <?php echo $checked; ?>
		            </td>
		           <td>
		           		 <a href="<?php echo $link; ?>">--<?php echo $row->tenloaitaisan; ?></a>
		           </td>
		           <td class="center">
		                <?php  echo $row->orders;?>
		            </td>
		            <td class="center">
		                <?php  if($row->type==1) echo "Nhà"; elseif ($row->type==2) echo "Đất"; else echo "Khác"?>
		            </td>
		            <td class="center">
		                <?php  echo $row->parent_id;?>
		            </td>
		           <td class="center hidden-phone">
						<span class="editlinktip hasTip" >
						<?php echo $published;?>
						</span>
					</td>
					<td class="center">
		                <?php  echo $row->id;?>
		            </td>
		        </tr>
	        	<?php 
	        	
	        	$child = $model->getChild($ds[$i]->id);
	        	for ($j=0;$j<sizeof($child);$j++){
					$rows = $child[$j];
					$checked 	= JHTML::_('grid.id',$j, $rows->id);
					$link 		= JRoute::_( 'index.php?option=com_kekhaitaisan&controller=taisan&task=edit&id='.$rows->id );
					$published 	= JHTML::_('jgrid.published', $rows->status, $stt );
					?>
 				 <tr class="<?php echo "row$stt"; ?>">
		            <td style="width: 30px;" class="center">
		                <?php echo $checked; ?>
		            </td>
		           <td>
		           		 <a href="<?php echo $link; ?>">------<?php echo $rows->tenloaitaisan; ?></a>
		           </td>
		           <td class="center">
		                <?php  echo $rows->orders;?>
		            </td>
		            <td class="center">
		                <?php  if($rows->type==1) echo "Nhà"; elseif ($rows->type==2) echo "Đất"; else echo "Khác"?>
		            </td>
		            <td class="center">
		                <?php  echo $rows->parent_id;?>
		            </td>
		           <td class="center hidden-phone">
						<span class="editlinktip hasTip" >
						<?php echo $published;?>
						</span>
					</td>
					<td class="center">
		                <?php  echo $rows->id;?>
		            </td>
		        </tr>
			<?php 
			$stt++;
	        	}
	       	 $stt++;
		    }
		    ?>
    	</tbody>
	</table>
    <input type="hidden" name="option" value="com_kekhaitaisan" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="taisan" />
    <input type="hidden" name="view" value="taisan" />
    </div>
    </div>
</form>
<script>
function checkAll(){
	var checkboxes = document.getElementsByTagName('input'), val = null;    
    for (var i = 0; i < checkboxes.length; i++)
    {
        if (checkboxes[i].type == 'checkbox')
        {
            if (val === null) val = checkboxes[i].checked;
            checkboxes[i].checked = val;
        };
    };
};
</script>