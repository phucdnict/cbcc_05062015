<?php
defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
$items=$this->items;
?>
<form action="<?php echo JRoute::_('index.php?option=com_kekhaitaisan&controller=loainha'); ?>" method="post" name="adminForm" id="adminForm">
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
                <th class="title">Tên loại nhà</th>
                <th style="width:5px" class="nowrap center">Thứ tự</th>
                <th style="width:5px" class="nowrap center">Trạng thái</th>
                <th style="width:5px" class="nowrap center">id</th>
            </tr>
        </thead>
        <tbody>
	        <?php
	        $k = 0;
	        for ($i=0, $n = count( $items ); $i < $n; $i++)
	        {
	            $row = $items[$i];
				$checked 	= JHTML::_('grid.id',$i, $row->id);
	            $link 		= JRoute::_( 'index.php?option=com_kekhaitaisan&controller=loainha&task=edit&id='.$row->id );
	            $published 	= JHTML::_('jgrid.published', $row->status, $i );
	            ?>
	        <tr class="<?php echo "row$k"; ?>">
	            <td style="width: 30px;" class="center">
	                <?php echo $checked; ?>
	            </td>
	           <td>
	           		 <a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
	           </td>
	           <td class="center">
	                <?php  echo $row->orders;?>
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
	       	 $k = 1 - $k;
		    }
		    ?>
    	</tbody>
	</table>
    <input type="hidden" name="option" value="com_kekhaitaisan" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="controller" value="loainha" />
    <input type="hidden" name="view" value="loainha" />
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