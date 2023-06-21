<?php

if ( is_user_logged_in() && !current_user_can( 'moderate_comments' ) ) exit;

function populate_table() {
    global $table_prefix, $wpdb;

    $fetchSql = "SELECT * from wp_safe_comments_blocklist;";
    $results = $wpdb->get_results($fetchSql);

    $html = "";

    foreach($results as $row) {
        $html .= "<tr>";
        $html .= "<td><input type='hidden' name='user_id[]' value='".$row->id."'/>".$row->id."</td>";
        $html .= "<td><input type='hidden' name='emails[]' value='".$row->email."'/>".$row->email."</td>";
        $html .= "</tr>";
    }

    return $html;
}

?>