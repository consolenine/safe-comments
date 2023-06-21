<div class="wrap">
    <h2 class="border border-1">Safe Comments - Dashboard</h2>
    <hr/>
    <form id="safe-comment-form">
    <button id="safe-comments-add-blocked" type="button" style="padding: 8px 12px; background: #A4CC00; border: 0; border-radius: 5px; margin: 10px 5px;">Add</button>
        <table id="safe-comments-blocked-users" style="width: 50%; max-width: 800px; max-height: 600px; overflow: auto; border: 1px solid #BDBDBD; text-align: center;">
                <tr>
                    <th>S. No</th>
                    <th>Email Address</th>
                </tr>
                <?php echo populate_table();?>
        </table>
        <h4>Add Custom Message</h4>
        <input name="custom_message" type="text"/>
    </form>
</div>
<script>
    (function($) {
        $( document ).ready( function() {
            $( "#safe-comments-add-blocked" ).on( 'click', function() {
                $( "#safe-comments-blocked-users tbody" ).append(
                    `
                    <tr>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    `
                );
            })
        });
    })(jQuery);
</script>