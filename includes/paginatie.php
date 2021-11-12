<ul class="pagination">
	<?php  if($page_no > 1){ echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=1'>Prima</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a class='page-link' <?php if($page_no > 1){ echo "href='" . $link_paginatie . "page_no=$previous_page'"; } ?>>«</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li class='page-item'><a class='page-link'>...</a></li>";
		echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$second_last'>$second_last</a></li>";
		echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li class='page-item'><a class='page-link'>...</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$second_last'>$second_last</a></li>";
	   echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=1'>1</a></li>";
		echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=2'>2</a></li>";
        echo "<li class='page-item'><a class='page-link'>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='page-item active'><a class='page-link'>$counter</a></li>";	
				}else{
           echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a class='page-link' <?php if($page_no < $total_no_of_pages) { echo "href='" . $link_paginatie . "page_no=$next_page'"; } ?>>»</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li class='page-item'><a class='page-link' href='" . $link_paginatie . "page_no=$total_no_of_pages'>Ultima &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>
