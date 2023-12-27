<?php
if( have_rows('attachments') ):
	echo '<div class="attachments">';
	echo '<table><tr><th>'._el('Title').'</th><th>'._el("Download").'</th></tr>';
    while ( have_rows('attachments') ) : the_row();
        echo '<tr><td>'.get_sub_field('title').'</td><td><a href="'.get_sub_field('attachment').'" class="pdf-down" target="_blank">'._el("Download").'</a></td><tr>';
    endwhile;
    echo '</table>';
    echo '</div>';
endif;
?>