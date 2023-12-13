<?php
?>



// make a ajax request to test if the ajax is working
<script>
    $.ajax({
        url: 'yourFileName',
        type: 'POST',
        data: {
            'test': 'test'
        },
        success: function (data) {
            console.log(data);
        }
    });
</script>

